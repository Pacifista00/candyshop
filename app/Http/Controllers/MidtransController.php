<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized  = config('midtrans.isSanitized');
        Config::$is3ds        = config('midtrans.is3ds');
    }
    public function pay(Request $request){
        $orderId = mt_rand(100000, 999999);

        $params = array(
            'transaction_details' => array(
                'order_id'   => $orderId,
                'name'   => $request->name,
                'email'  => $request->email,
                'gross_amount' => $request->amount,
            ),
            'customer_details' => array(
                'name' => $request->name,
                'email' => $request->email,
            ),
        );
        $snapToken = Snap::getSnapToken($params);

        $newTransaction = Transaction::create([
            'order_id' => $orderId,
            'name'   => $request->name,
            'email'  => $request->email,
            'amount' => $request->amount,
            'status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        return view('checkout', [
            'snapToken' => $snapToken,
            'transaction' => $newTransaction,
        ]);
    }
    public function afterPayment(Request $request){

        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'accept'){
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;

                    $transactionData = Transaction::where('order_id', $order_id)->first();
                    $transactionData->update(['status' => 'success']);
                }
            }
        }else if ($transaction == 'settlement'){
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
        }else if($transaction == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        }else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        }else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }
    public function invoice($id){
        return view('invoice',[
            'transaction' => Transaction::find($id)
        ]);
    }
}
