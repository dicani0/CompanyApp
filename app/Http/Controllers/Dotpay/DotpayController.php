<?php

namespace App\Http\Controllers\Dotpay;

use App\Http\Controllers\Controller;
use App\Models\Dotpay\Payment;
use App\Models\User;
use Carbon\Carbon;
use Evilnet\Dotpay\DotpayManager;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DotpayController extends Controller
{

    private $dotpayManager;

    public function __construct(DotpayManager $dotpayManager)
    {
        $this->dotpayManager = $dotpayManager;
    }

    // Tutaj uderzy Dotpay z danymi o tym w jakim stanie jest transakcja. Zwrócenie OK jest wymagane by dotpay przyjął, że serwer odpowiada poprawnie

    public function callback()
    {
        if (config('dotpay.api.api_version') !== 'dev') {
            $response = $this->dotpayManager->callback(request()->all());

            $payment = Payment::find($response['payment_id']);
        } else {
            $payment = Payment::all()->last();
        }

        $payment->update([
            'finished' => 1,
        ]);

        $user = User::find($payment->user_id);
        $user->getCart()->closeCart();
        $user->funding->add($payment->amount);
        //Do whatever you want with this

        return new Response('OK');
    }

    public function pay($amount)
    {
        $data = [
            'amount' => $amount,
            'currency' => 'PLN',
            'description' => 'Payment for internal_id order',
            'control' => '12345', //ID that dotpay will pong you in the answer
            'language' => 'pl',
            'ch_lock' => '1',
            'url' => config('dotpay.options.url'),
            'urlc' => config('dotpay.options.curl'),
            'expiration_datetime' => '2021-12-01T16:48:00',
            'payer' => [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+48123123123'
            ],
            'recipient' => config('dotpay.options.recipient')

        ];

        Payment::create([
            'user_id' => Auth::user()->id,
            'amount' => '100',
            'currency' => 'PLN',
            'description' => 'Payment for internal_id order',
            'control' => '12345', //ID that dotpay will pong you in the answer
            'language' => 'pl',
            'ch_lock' => '1',
            'expiration_datetime' => Carbon::now()->addDay(),
            'finished' => 0
        ]);

        return redirect()->to($this->dotpayManager->createPayment($data));
    }

    public function afterPay()
    {
        if (config('dotpay.api.api_version') === 'dev') {
            $this->callback();
        }
        flash('Credits added to your balance!');
        return redirect()->route('order.history');
    }
}
