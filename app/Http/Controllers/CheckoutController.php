<?php

namespace App\Http\Controllers;

use App\Repos\CartRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentMethod;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $cartRepo = new CartRepo();
        $total = $cartRepo->totalPayment();
        /**
         * payment method should be generated from FE using stripe.js library/ here i will create a dummy one in case its not sent
         */
        Stripe::setApiKey(config('services.stripe.stripe_key'));
        if ($request->has('stripe_token')) {
            $paymentMethod = $request->get('payment_method');
        } else {
            $paymentMethod = PaymentMethod::create([
                "type" => "card",
                "card" => [
                    "number" => "4242424242424242",
                    "exp_month" => 12,
                    "exp_year" => 2022,
                    "cvc" => "123"
                ]
            ]);
        }
        Auth::user()->createOrGetStripeCustomer();
        Auth::user()->charge($total, $paymentMethod->id);
        $cartRepo->emptyCart();
        return response('success');
    }
}
