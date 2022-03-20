<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stripe\Customer;
use stripe\Charge;
// use stripe\Charge;

class PaymentController extends Controller
{
    public function stripe(){
        return view('stripe');
    }

    public function createPaymentIntent() {
        try {
            // Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            $stripe = new \Stripe\StripeClient('sk_test_51KG6MrCOATZUk3VubIQde0q05gSvtwAn9FcbaDM1PUgEOjVNsqGdtJqL4LBHR7LMk0S3d80Zjeoc4Vty3gzWILuC00g2oJEFr6');

            $intent = $stripe->paymentIntents->create([
                'amount' => 10000,
                'currency' => 'inr',
                'payment_method_types' => ['card'],
                // 'automatic_payment_methods' => ['enabled' => true], // the PaymentIntent is created using the payment methods you configured in the Stripe Dashboard
                // 'payment_method_types' => [
                //     'bancontact',
                //     'card',
                //     'eps',
                //     'giropay',
                //     'ideal',
                //     'p24',
                //     'sepa_debit',
                //     'sofort',
                // ],
            ]);
            // dd('ddd', $intent);
            echo json_encode(array('client_secret' => $intent->client_secret));
            // return response()->json([ 'intent' => $intent ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
