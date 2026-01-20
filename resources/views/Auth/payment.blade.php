@extends('layout.main')
@section('title', 'Create Payments')

<style>
.card-element {
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    margin-bottom: 12px;
}
.stripe-errors {
    color: red;
    margin-bottom: 12px;
}
#payment-loading {
    display: none;
}
</style>

@section('main-content')
<div class="container py-5">
    <h1 class="mb-3">Make Payments</h1>
    <form id="payment-form">
        @csrf
        <input type="hidden" id="user_id" value="">

        <div class="mb-3">
            <label for="amount">Amount (USD)</label>
            <input type="number" id="amount" class="form-control" placeholder="50" required>
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <input type="text" id="description" class="form-control" placeholder="Payment for service">
        </div>

        <div class="mb-3">
            <label>Card Information</label>
            <div id="card-element" class="card-element"></div>
            <div id="card-errors" class="stripe-errors"></div>
        </div>

        <button type="submit" class="btn btn-primary w-100" id="pay-button">Pay Now</button>

        <div id="payment-loading" class="text-center mt-3">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-2">Processing your payment...</p>
        </div>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', async function () {  // ✅ added async
    const token = localStorage.getItem("api_token");
    let id = null;

    if (token) {
        try {
            const res = await fetch("/api/user", {
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            const response = await res.json();
            if (response.success && response.data) {
                id = response.data.id;
                document.getElementById('user_id').value = id;
            }
        } catch (err) {
            console.error("Error fetching user:", err);
        }
    }

    // Stripe setup
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    const cardErrors = document.getElementById('card-errors');
    const payButton = document.getElementById('pay-button');
    const loadingArea = document.getElementById('payment-loading');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        cardErrors.textContent = '';
        payButton.disabled = true;
        loadingArea.style.display = 'block';

        // Create PaymentMethod
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: card
        });

        if (error) {
            console.error("Stripe PaymentMethod Error:", error);
            cardErrors.textContent = error.message;
            payButton.disabled = false;
            loadingArea.style.display = 'none';
            return;
        }

        // Get input values
        const userId = document.getElementById('user_id').value;
        const amount = parseFloat(document.getElementById('amount').value);
        const description = document.getElementById('description').value || 'Payment';

        //console.log("Payment Data:", { userId, amount, description, paymentMethodId: paymentMethod.id });

        // Send to backend
        try {
            const res = await fetch('/api/payments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: JSON.stringify({
                    user_id: userId,
                    amount: amount,
                    description: description,
                    payment_method: paymentMethod.id
                })
            });

            const data = await res.json();
            //console.log('Stripe Response:', data);

            if (data.status === true) {
                alert('Payment successful!');
                window.location.href = data.redirect_url;
                form.reset();
                card.clear();
            } else {
                alert('Payment failed: ' + (data.message || 'Unknown error'));
            }

        } catch (err) {
            //console.error('Fetch error:', err);
            alert('Payment failed! Please check console.');
        }

        payButton.disabled = false;
        loadingArea.style.display = 'none';
    });
});
</script>
@endsection
