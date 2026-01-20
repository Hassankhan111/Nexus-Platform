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
        <h1 class="mb-3">Payments Details</h1>
        <form id="payment-form">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Description</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="load-data">
                </tbody>
            </table>


        </form>
    </div>



@endsection