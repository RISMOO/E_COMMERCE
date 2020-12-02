@extends('layouts.master')

@section('content')


  @foreach ($products as $product)
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
        <small class="d-inline-block mb-2 text-success">
            @foreach($product->categories as $category)
            {{$category->name}}{{ $loop->last ? '' : ', '}}
            @endforeach
        </small>
          <h5 class="mb-0">{{ $product->title }}</h5>
          <p class="mb-auto text-muted text-success">{{ $product->subtitle }}</p>
          <strong class="mb-auto text-secondary font-weight-bold"><h1>{{ $product->getPrice()}}€</h1></strong>
          <a href="{{ route('products.show',$product->slug) }}" class="stretched-link btn btn-light"><img src="{{asset('img/loupe.png')}}" alt="A 50x50 image"> Voir le produit </a>
        </div>
        <div class="col-auto d-none d-lg-block">


          <img src="{{asset('storage/'. $product->image) }}" alt="" width="180" class="img-responsive rounded border-right border-success m-2">


        </div>
      </div>
    </div>
  @endforeach

<!--pour eviter de pezrdre le slug dans lurl-->
<h5 class="text-danger"> {{ $products->appends(request()->except('page'))->links() }}.</h5>
@endsection
