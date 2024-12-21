@extends('layouts.main')
@section('content')
@include('partials.jumbotron')
<div class="container">
    <div class="row px-3 p-md-0">
        @foreach ($candies as $candy)
        <div class="col-6 col-sm-4 col-lg-3">
            <div class="card bg-transparent border-secondary text-light" 
            {{ $candy->stock == 0 ? "style='cursor: not-allowed; opacity: 0.5'" : "" }}>
                <img src="{{ asset('storage/' . $candy->image_path) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-warning">{{ $candy->name }}</h5>
                    <p class="card-text m-0">Rp. {{ number_format($candy->price, 0, ',', '.') }}</p>
                    <small class="card-text">Stock : {{ $candy->stock }}</small>
                    <a href="/candy/{{ $candy->id }}" 
                    class="btn btn-warning d-block mt-2 {{ $candy->stock == 0 ? 'disabled' : '' }}" 
                    {{ $candy->stock == 0 ? 'tabindex="-1" aria-disabled="true"' : '' }}>Check</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection