@extends('layouts.main')
@section('content')
<div class="card border rounded shadow">
    <div class="card-body">
        <form id="pay-form" action="/pay" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror" required>
                </div>
                <div class="col-md-12">
                    <label for="note" class="form-label">Note</label>
                    <textarea name="note" id="note" cols="30" rows="5" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Pay</button>
            </div>
        </form>
    </div>
</div>
@endsection