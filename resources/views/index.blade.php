@extends('layouts.main')
@section('content')

<div class="row px-3 p-md-0">
    @foreach ($candies as $candy)
        <div class="col-6 col-sm-4 col-lg-3">
            <div class="card">
                <img src="{{ asset('storage/' . $candy->image_path) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $candy->name }}</h5>
                    <p class="card-text">{{ $candy->price }}</p>
                    <p class="card-text">stock : {{ $candy->stock }}</p>
                    <a href="/candy/{{ $candy->id }}" class="btn btn-primary">Check</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection