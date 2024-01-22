<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Transaction;

class PaymentsController extends Controller
{
    public function index(Request $request){

    }
    public function process(Request $request){
        $payload = $request->input('payload', false);
        $amount = $request->input('amount');
        $idSponsor = $request->input('idSponsor');
        $idApartment = $request->input('idApartment');
        $nonce = $payload['nonce'];

        // controllare se nella mia tabella Apartment/sponsor, se c'è una sposorizazione attiva if(now >= dataExpired || no dataExpired)


        // vero
        // attach nella tabella Apartment/sponsor, aggiungere calc dataExpired = now + durata

        // falso
        // attach ... aggiungendo dataExpired+= durata

        $status = Transaction::sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => True
        ]
        ]);

        return response()->json($status);
    }
}
