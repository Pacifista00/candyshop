<?php

namespace App\Http\Controllers;

use App\Models\Candy;
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
        $candy = Candy::find($request->candy_id);
        $orderId = mt_rand(100000, 999999);

        $params = array(
            'transaction_details' => array(
                'order_id'   => $orderId,
                'name'   => $request->name,
                'email'  => $request->email,
                'gross_amount' => $request->amount*$candy->price,
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
            'total_price' => $request->amount*$candy->price,
            'status' => 'pending',
            'snap_token' => $snapToken,
            'candy_id' => $candy->id,
        ]);

        return view('checkout', [
            'snapToken' => $snapToken,
            'transaction' => $newTransaction,
            'candy' => $candy,
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
                    echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;

                    $transactionData = Transaction::where('order_id', $order_id)->first();
                    $candy = Candy::find($transactionData->candy_id);
                    $candy->update([
                        'stock' => $candy->stock-$transactionData->amount
                    ]);
                    $transactionData->update([
                        'status' => 'success'
                    ]);
                }
            }
        }else if ($transaction == 'settlement'){
            echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
        }else if($transaction == 'pending'){
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        }else if ($transaction == 'deny') {
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }else if ($transaction == 'expire') {
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        }else if ($transaction == 'cancel') {
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }
    public function invoice($id){
        return view('invoice',[
            'transaction' => Transaction::find($id)
        ]);
    }
}
