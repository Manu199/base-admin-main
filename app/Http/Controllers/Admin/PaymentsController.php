<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsor;
use Braintree\Transaction;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function index(Request $request){

    }
    public function process(Request $request){
        $payload = $request->input('payload');
        $nonce = $payload['nonce'];

        $amount = $request->input('amount');
        $idSponsor = $request->input('idSponsor');
        $idApartment = $request->input('idApartment');

        $status = Transaction::sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        // ******************************
        // $status->customData = $payload;

        // Se il pagamento ha successo allora posso modificare i dati nel mio db
        if($status->success){
            // controllare se nella mia tabella Apartment/sponsor, se c'è una sposorizazione attiva if(now >= dataExpired || no dataExpired)
            // apartment_sponsor->where
            $latestExpirationDate = DB::table('apartment_sponsor')
            ->where('apartment_id', $idApartment)
            // ->orderBy('expiration_date', 'desc') /* se uso il sync, nn ho bisogno dell'orderBy */
            ->value('expiration_date');

            $apartment = Apartment::find($idApartment);
            $sponsor = Sponsor::find($idSponsor);

            if (strtotime($latestExpirationDate) <= time() || !$latestExpirationDate) {
                // Data scaduta o nessuna data di scadenza presente
                // Calcola la nuova data di scadenza come (data corrente + durata del sponsor)
                $expirationDate = time() + ($sponsor->duration * 3600);
            } else {
                // Data di scadenza presente e non scaduta
                // Calcola la nuova data di scadenza come (data di scadenza attuale + durata del sponsor)
                $expirationDate = strtotime($latestExpirationDate) + ($sponsor->duration * 3600);
            }
            // Esegui il sync con la nuova data di scadenza
            $apartment->sponsors()->sync([$idSponsor => ['expiration_date' => date('Y-m-d H:i:s', $expirationDate)]]);
        }

        return response()->json($status);
    }
}
