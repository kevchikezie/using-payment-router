<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kevchikezie\PaymentRouter\PaymentRouter;

class PaymentRoutingController extends Controller
{
    protected $paymentRouter;

    public function __construct(PaymentRouter $paymentRouter)
    {
        $this->paymentRouter = $paymentRouter;
    }

    public function processPayment(Request $request)
    {
        $paymentDetails = [
            'amount' => $request->input('amount'),
            'card_number' => $request->input('card_number'),
            'transaction_id' => time() . rand(1000, 9999),
            'currency' => $request->input('currency'),
        ];

        try {
            $processor = $this->paymentRouter->route($paymentDetails);
            $data = $processor->processPayment($paymentDetails);

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
