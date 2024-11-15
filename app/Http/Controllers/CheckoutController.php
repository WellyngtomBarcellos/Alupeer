<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function view()
    {
        return view('acheckout');
    }
    public function successCallback($id, $saldo)
    {
        $user = User::find($id);
        $user->saldo = $saldo;
        $user->save();
        echo $user->saldo;
    }

    public function createPreference(Request $request)
    {
        $id = Auth::id();
        $response = Http::withToken(env('MERCADOPAGO_ACCESS_TOKEN'))->post('https://api.mercadopago.com/checkout/preferences', [
            'items' => [
                [
                    'id' => 'Sound system',
                    'title' => 'Dummy Title',
                    'description' => 'Dummy description',
                    'picture_url' => 'https://www.myapp.com/myimage.jpg',
                    'category_id' => 'car_electronics',
                    'quantity' => 1,
                    'currency_id' => 'BRL',
                    'unit_price' => 0.01
                ]
            ],
            'back_urls' => [
                'success' => 'https://alupeer.com/MercadoPago/Callback/Success/{id}/{saldo}',
                'pending' => '',
                'failure' => ''
            ]
        ]);

        if ($response->successful()) {
            return response()->json(['init_point' => $response->json('init_point')]);
        } else {
            return response()->json(['error' => 'Erro ao criar a preferência de pagamento.'], 500);
        }
    }
}
