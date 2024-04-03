<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Braintree\Gateway;

class PaymentController extends Controller
{   
    public function index()
    {
        return view('admin.payments.index');
    }
    public function checkout()
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        // Genera un token di pagamento da inviare al frontend
        $clientToken = $gateway->clientToken()->generate();

        return view('checkout', compact('clientToken'));
    }

    public function processPayment(Request $request)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return 'Pagamento completato con successo!';
        } else {
            return 'Errore durante il pagamento: ' . $result->message;
        }
    }

//     public function generateClientToken()
// {
//     $gateway = new Gateway([
//         'environment' => env('BRAINTREE_ENV'),
//         'merchantId' => env('BRAINTREE_MERCHANT_ID'),
//         'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
//         'privateKey' => env('BRAINTREE_PRIVATE_KEY')
//     ]);

//     $clientToken = $gateway->clientToken()->generate([
//         'customerId' => $customerId // Se necessario
//     ]);

//     return response()->json(['clientToken' => $clientToken]);
// }
}
