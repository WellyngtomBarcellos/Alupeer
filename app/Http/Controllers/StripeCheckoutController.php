<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use Illuminate\Support\Facades\Auth;

class StripeCheckoutController extends Controller
{
    protected $stripe;


    /*-------------------------------------------
    |
    | Retorna a view de carteira
    |
    |------------------------------------------*/
    public function index(){
        return view('checkout');
    }






    /*-------------------------------------------
    |
    | SEI NAO KKKKKKKKKK ISSO NAO FOI EU QUE FIZ
    |
    |------------------------------------------*/
    public function __construct(StripeClient $stripe)
    {
        $this->stripe = $stripe;
    }







    /*-------------------------------------------
    |
    | Cria um gatway para o pagamento
    |
    |------------------------------------------*/
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->input('amount');

        if (!is_numeric($amount) || $amount <= 0) {
            return response()->json(['error' => 'Invalid amount'], 400);
        }

        $amountInCents = $amount * 100;
        $user = Auth::user();
        $checkout_session = Session::create([
            'payment_method_types' => ['card', 'boleto'],

            'line_items' => [[
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => 'Adicionar Saldo',
                    ],
                    'unit_amount' => $amountInCents,
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',
            'success_url' => route('wallet'),
            'cancel_url' => route('wallet'),
            'metadata' => ['user_id' => $user->id],
        ]);

        return response()->json(['sessionId' => $checkout_session->id]);
    }







    /*-------------------------------------------
    |
    | Retorna a confimação de pagamento e adiciona
    | o saldo
    |
    |------------------------------------------*/
    public function handleWebhook(Request $request)
    {

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (SignatureVerificationException $e) {
            return response()->json(['error' => 'Webhook signature verification failed.'], 400);
        }
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $userId = $session->metadata->user_id;
                $amountPaid = $session->amount_total / 100;
                $user = User::find($userId);
                if ($user) {
                    $user->saldo += $amountPaid;
                    $user->save();
                }
                break;
            default:
                break;
        }
        return response()->json(['status' => 'success']);
    }
}