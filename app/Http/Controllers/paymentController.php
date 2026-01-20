<?php

namespace App\Http\Controllers;

use App\Models\Pyment;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Create Payment
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'currency' => 'nullable|string|max:3',
            'description' => 'nullable|string',
            'payment_method' => 'required|string', // Stripe Payment Method ID
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Always convert amount to cents
            $amount = (int) ($request->amount * 100);

            // Create Stripe PaymentIntent
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => $request->currency ?? 'usd',
                'payment_method' => $request->payment_method,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'description' => $request->description ?? 'Nexus Platform Payment',


            ]);

            // Handle requires_action (3D Secure)
            if ($paymentIntent->status === 'requires_action') {
                return response()->json([
                    'status' => false,
                    'message' => 'Authentication required',
                    'payment_intent' => $paymentIntent
                ]);
            }

            // Save successful payment
            $payment = Pyment::create([
                'user_id' => $request->user_id,
                'stripe_payment_id' => $paymentIntent->id,
                'amount' => $amount,
                'currency' => $request->currency ?? 'usd',
                'status' => $paymentIntent->status,
                'description' => $request->description,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'Payment successful',
                'payment' => $payment,
                'redirect_url' => route('showpayments', $request->user_id)
            ]);

        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getError()->message,
            ], 400);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'stripe_error' => $e->getError()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show all payments for a user
     */
    public function index($userId)
    {
        $payments = Pyment::where('user_id', $userId)
            ->orderBy('user_id', 'DESC')
            ->get();

        return response()->json([
            'status' => true,
            'payments' => $payments,
        ]);
    }
}
