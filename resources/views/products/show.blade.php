@extends('layouts.master')

@section('content')
  <div class="col-md-12">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-400 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success"> @foreach ($product->categories as $category)
            {{ $category->name }}{{ $loop->last ? '' : ', '}}
        @endforeach</strong>
        <h5 class="mb-0">{{ $product->title }}</h5>
        <hr>
        <p class="mb-auto text-muted">{!! $product->description !!}</p><!--prend en charge le html-->
        <strong class="mb-auto font-weight-normal text-secondary font-size-16"><h2>{{ $product->getPrice()}}€ </h2></strong>
        <form action="{{ route('cart.store') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="btn btn-dark ">Ajouter au panier</button>
        </form>
      </div>
      <div class="col-auto d-none d-lg-block mt-4">



        <img src="{{asset('storage/'. $product->image) }}" alt="" width="150" class="img-responsive rounded m-3">
      </div>

  </div>

@endsection
<!--installation de notre panier avec la librairie LaravelShoppingcart//panier
    https://github.com/hardevine/LaravelShoppingcart
-->
