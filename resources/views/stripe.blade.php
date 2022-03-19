<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="{{('js/custom/stripe.js')}}"></script>
</head>
<body>
    <div style="width: 20%; align:center">
        <div id="payment-element"></div>
    {{-- <form id="payment-form">
        <div id="payment-element">
        </div>
        <button id="submit">Submit</button>
        <div id="error-message">
        </div>
      </form> --}}
    </div>
      <script>
        // (async () => {
        //     const response = await fetch('/get-intent');
        //     // console.log(response);
        //     // console.log(await response);
        //     // const {client_secret: clientSecret} = await response.json();
        //     // Render the Payment Element using the clientSecret
        // })();
    </script>
    {{-- <script src="{{('js/custom/checkout.js')}}"></script> --}}
</body>
</html>