@extends('layouts.main')
@section('content')
<div class="card border rounded shadow">
    <div class="card-body">
       
            <div class="col-12">
                <button class="btn btn-primary" id="pay-button">Pay</button>
            </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>

<script type="text/javascript">
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    window.snap.pay('<?=$snapToken?>', {
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