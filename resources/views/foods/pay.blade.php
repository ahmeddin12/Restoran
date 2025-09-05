@extends('layouts.app')
@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top:-25px">
  <div class="container text-center my-5 pt-5 pb-4">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Pay with Paypal</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pay with Paypal</a></li>
      </ol>
    </nav>
  </div>
</div>


<div class="container">
  <!-- Replace "test" with your own sandbox Business account app client ID -->
  <script src="https://www.paypal.com/sdk/js?client-id=AUVcoGwbd8GplzUgD6VUS_C0YyKYwhasFC7JNSQKf3fHjqsao9zchgwQQTCcakjUFtVzr9Dic4NBs0vZ&currency=USD"></script>
  <!-- Set up a container element for the button -->
  <div id="paypal-button-container"></div>
  <script>
    paypal.Buttons({
      // Sets up the transaction when a payment button is clicked
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '100' // Can also reference a variable or function
            }
          }]
        });
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {

          window.location.href = 'http://127.0.0.1:8000/foods/cart';
        });
      }
    }).render('#paypal-button-container');
  </script>

</div>





@endsection