<?php

namespace App\Http\Controllers;
use Mollie\Laravel\Facades\Mollie;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
        public function preparePayment($price)
        {
            $randomString = Str::random(32);

            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $price // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Order #12345",
                "redirectUrl" => 'http://localhost:8080/',
                "webhookUrl" => 'https://c0400f7d2b99.ngrok.io',
                "metadata" => [
                    "order_id" => $randomString,
                ],
            ]);

            $payment = Mollie::api()->payments->get($payment->id);

            $payment->redirectUrl = 'http://localhost:8080/payment/' ."?orderID={$randomString}" . "&paymentID={$payment->id}";
            
            $payment->metadata = ["order_id" => $randomString];
            
            $payment->update();

            $payment = Mollie::api()->payments->get($payment->id);


            // redirect customer to Mollie checkout page
            // return redirect($payment->getCheckoutUrl(), 303);
            return $payment->getCheckoutUrl();
            
        }
        public function refundPayment($paymentId, $refundPrice) {

            $payment = Mollie::api()->payments->get($paymentId);
            $refund = $payment->refund([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $refundPrice
                ]
            ]);

            return response()->json($refund);

        }

        public function getRefund($paymentId, $refundId){
            $refund = $mollie->payments->get($paymentId)->getRefund($refundId);

            return response()->json($refund);
        }
        /**
         * After the customer has completed the transaction,
         * you can fetch, check and process the payment.
         * This logic typically goes into the controller handling the inbound webhook request.
         * See the webhook docs in /docs and on mollie.com for more information.
         */
        public function handleWebhookNotification(Request $request) {
            $paymentId = $request->input('id');
            $payment = Mollie::api()->payments->get($paymentId);

            return response()->json($payment);
 
        }

}
