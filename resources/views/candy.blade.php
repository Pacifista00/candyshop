@extends('layouts.main')
@section('content')
<div class="container">
    <div class="card border rounded shadow mt-3 bg-dark text-light">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img src="{{ asset('storage/' . $candy->image_path) }}" class="card-img-top img-detail-candy" alt="Foto Produk">
                    </div>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <div class="card bg-dark text-light border-secondary">
                        <div class="card-body">
                            <h2 class="card-title text-warning">{{ $candy->name }}</h2>
                            <p class="card-text m-0"><strong>Price :</strong> Rp. {{ number_format($candy->price, 0, ',', '.') }}</p>
                            <p class="card-text"><strong>Stock :</strong> {{ $candy->stock }}</p>
                            <h5>Fill in the form below to purchase</h5>
                            <form id="pay-form" action="/pay" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <input type="hidden" name="candy_id" value="{{ $candy->id }}">
                                    <div class="col-md-6 mb-2">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Your Name" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Your Email" required>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-warning" type="submit">Checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection