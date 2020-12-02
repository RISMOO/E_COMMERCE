@extends('layouts.master')

@section('content')
  <div class="col-md-12">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-400 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <muted class="d-inline-block mb-2 text-primary">

        @foreach ($product->categories as $category)
            {{ $category->name }}{{ $loop->last ? '' : ', '}}
        @endforeach
        </muted>
        <h5 class="mb-3">{{ $product->title }}
            <div class="badge badge-pill text-success badge-light">{{$stock}}</div>

        </h5>


           <p class="mb-auto text-muted">{!! $product->description !!}</p><!--prend en charge le html-->
            <strong class="mb-auto font-weight-normal text-secondary font-size-16"><h2>{{ $product->getPrice()}}€ </h2></strong>
            @if($stock=="Produit disponible")

              <form action="{{ route('cart.store') }}" method="POST">
           @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="btn btn-light "><img src="{{asset('img/caddie.png')}}" alt="A 50x50 image"> Ajouter au panier</button>
        </form>
        @endif
      </div>
     <div class="col-auto d-none d-lg-block mt-4 text-center">

         <img src="{{asset('storage/'. $product->image) }}" id="mainImage" alt="" width="150" height="100" class="img-responsive img-thumbnail rounded m-3">
        @if($product->images)
          <div class="text-center">
           <img src="{{asset('storage/'. $product->image) }}" alt="" width="70" height="50" class="img-responsive img-thumbnail rounded ">
        @foreach (json_decode($product->images, true) as $image)<!--on a va l'interrpreter comme un tableau car image est une chaine de caractere-->
        <!--on boucle sur nos vignettes images-->
          <img src="{{asset('storage/'. $image) }}" alt="" width="70" height="50" class="img-responsive img-thumbnail rounded m-3">
        @endforeach
      </div>
        @endif

      </div>
    </div>
  </div>

@endsection
<!--installation de notre panier avec la librairie LaravelShoppingcart//panier
    https://github.com/hardevine/LaravelShoppingcart
-->
@section('extra-js')
<script>
let mainImage= document.querySelector('#mainImage');//recupere me mainImage

let thumbnails=document.querySelectorAll('.img-thumbnail');//recupere moi tous les elements qui ont la clss img-thumbnail

//on rajouter un evenement au click sur nos vignettes
thumbnails.forEach((element)=>element.addEventListener('click',changeImage));//fonction changerImage

//on boucle sur nos vignettre et au click on change l'image

function changeImage(e){//evenement en parametre cette fonction changera la source de l'image principale par la vignette qui aura ete clicqué
mainImage.src=this.src;//fera refereence a l'evnement sur lequel j'ai cliqué

}

</script>


@endsection
