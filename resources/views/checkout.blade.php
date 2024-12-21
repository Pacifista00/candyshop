@extends('layouts.main')
@section('content')
<div class="container d-flex justify-content-center">
  <div class="card mt-3 border rounded shadow bg-dark text-light" style="width: 24rem;">
    <div class="card-body">
      <h5 class="card-title">Order detail</h5>
      <hr>
      <p class="card-text m-0"><strong>Name : </strong>{{ $candy->name }}</p>
      <p class="card-text m-0"><strong>Amount : </strong>{{ $transaction->amount }}</p>
      <p class="card-text m-0"><strong>Total price : </strong> Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
      <div class="col-12">
        <button class="btn btn-warning mt-2" id="pay-button">Pay</button>
      </div>
    </div>
  </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>

<script type="text/javascript">
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    window.snap.pay('{{$snapToken}}', {
      onSuccess: function (result) {
        // alert("payment success!"); console.log(result);
        window.location.href = '/invoice/{{$transaction->id}}';
      },
      onPending: function (result) {
        // alert("wating your payment!"); console.log(result);
      },
      onError: function (result) {
        // alert("payment failed!"); console.log(result);
      },
      onClose: function () {
        // alert('you closed the popup without finishing the payment');
      }
    });
  });
</script>
@endsection