@extends('layouts.master')

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

@if (Cart::count() > 0)
<div class="px-4 px-lg-0">
    <!-- For demo purpose -->
    <div class="pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-4">

            <!-- Shopping cart table -->
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Produit</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Prix</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Quantité</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Supprimer</div>
                    </th>
                  </tr>
                </thead>
                <tbody>
@foreach (Cart::content() as $product)
<tr>
    <th scope="row" class="border-0">
      <div class="p-2">
        <div class="ml-3 d-inline-block align-middle">
            <img src="{{asset('storage/'. $product->model->image)}}" alt="" width="70" class="img-fluid rounded shadow-sm">
         <h5 class="mb-0"> <a href="{{ route('products.show', $product->model->slug) }}" class="text-dark d-inline-block align-middle">{{$product->model->title}}</a></h5>
        <div>
      </div>
    </th>
     <td class="border-0 align-middle"><strong>{{getPrice2($product->subtotal())}}</strong></td>
       <td class="border-0 align-middle">
          <select name="qty" id="qty" data-id="{{$product->rowId}}" data-stock="{{$product->model->stock}}" class="custom-select"><!--data-id=rowId/REQUETE AJAX correspond au produit enregistré dans notre panier-->
        <!--data-stock-/REQUETE AJAX-->
     @for( $i = 1 ; $i <=6; $i++)
     <option value="{{  $i }}" {{ $i == $product->qty ? 'selected': '' }} >
        {{$i}}</option>
     @endfor
    </select>
  </td>
    <td class="border-0 align-middle">
<form action="{{route('cart.destroy',$product->rowId)}}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-sm btn-outline-danger ml-3"><img src="{{asset('img/drop.png')}}" alt="A 50x50 image"> </button>

</form>

                     </td>
                   </tr>
              @endforeach

                </tbody>
              </table>
            </div>
            <!-- End -->
          </div>
        </div>
        <div class="row py-5 p-4 bg-white rounded shadow-sm">
          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"><img src="{{asset('img/coupon.png')}}" width="25" height="25" alt="A 50x50 image"> Code coupon</div>

           @if(!request()->session()->has('coupon'))<!--si dans la requete j'ai une session qui a un coupon-->
           <!--son la session n'as pas de coupon-->
           <div class="p-4">
            <form action="{{route('cart.store.coupon')}}" method="POST">
              <p class="font-italic mb-4">Si vous avez un coupon,entrez le dans le champ ci-dessus</p>
              <div class="input-group mb-4 border rounded-pill p-2">
                @csrf
                <input type="text" placeholder="Entrez votre code ici" name="code" aria-describedby="button-addon3" class="form-control border-0">
                <div class="input-group-append border-0">
                  <button id="button-addon3" type="submit" class="btn btn-success px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
                </div>
              </div>
               </form>
              </div>
             @else
         @endif
        </div>




          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Details de la commande</div>
            <div class="p-4">
              <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
              <ul class="list-unstyled mb-4">
            <!-- 1 Da ns notre terminal fichier de config de notre github hardevine :php artisan vendor:publish --provider="Gloudemans\Shoppingcart\ShoppingcartServiceProvider" --tag="config"
                2 on a donc un card.php dans notre dossier config
               3 On modifie notre fichier card.php
               4.dans mon fichier commposer.json apres autoload je rajoute :
                "files":[
                "app/Helpers.php"
                  ],
                4 dans mon terminal :composer dump-autoload
               5 Dans app on creer un fichier Helpers.php(Par conséquent, les helpers de Laravel sont des fonctions prêtes à l'emploi pouvant être appelés n'importe où au sein de votre application.)
            -->
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous-total</strong><strong>{{ getPrice2(Cart::subtotal())}} €</strong></li><!--fonction getprice helpers'-->
              @if(request()->session()->has('coupon'))
        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Coupon <span class="text-success"><span class="badge badge-pill badge-success">{{request()->session()->get('coupon')['code']}}</span>

        <form action="{{route('cart.destroy.coupon')}}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')<!--on supprime notre coupon-->
        <button type="submit" class="btn btn-sm btn-outline-danger ml-3"><img src="{{asset('img/drop.png')}}" alt="A 50x50 image"> </button>

        </form>
            <!--la cle code--></strong><strong><span class="text-success">{{getPrice2(request()->session()->get('coupon')['remise'])}}</span> €</strong></li>
            <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Nouveau sous-total</strong><strong>
                {{ getPrice2(Cart::subtotal() - request()->session()->get('coupon')['remise'])}}<!--nouveau calcul calcul avec remise--> €</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Taxe</strong><strong>

                    {{getPrice2((Cart::subtotal() - request()->session()->get('coupon')['remise']) * (config('cart.tax') /100)) }} €</strong></li><!--la clé taxe de notre fichier config/tax-->

            <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Nouveau total</strong> <h5 class="font-weight-bold total">
                {{ getPrice2(Cart::subtotal() - request()->session()->get('coupon')['remise'] + (Cart::subtotal() - request()->session()->get('coupon')['remise']) * (config('cart.tax') /100)) }}

                €</h5></li>
            @else
                                                                                                                        <!--on recupere le code controllerCart-->
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Taxe</strong><strong>{{ getPrice2(Cart::tax())}} €</strong></li>

                 <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong> <h5 class="font-weight-bold total">{{ getPrice2(Cart::total())}} €</h5></li>

                @endif
              </ul><a href="{{route('checkout.index')}}" class="btn btn-success rounded-pill py-2 btn-block" ><img src="{{asset('img/pay.png')}}">Proceder au paiement<img src="{{asset('img/pay.png')}}"> </a>

              <!--stripe.com -->
              <!-- composer require stripe/stripe-php installation de strippe-->

            </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@else
<div class="col-md-12">
    <div class="jumbotron text-center">

       <h2 class="text-muted"> Bonjour</h2>  <h3 class="text-success text-capitalize"> {{Auth::user()->name}}</h3>
    <h2 class="text-muted">Votre panier est vide</h2>
<p class="mt-4">Mais vous pouvez visiter la <a href="{{route('products.index')}}"><img src="{{asset('img/home.png')}}" width="30" height="30" alt="A 50x50 image"></a>
</p>
    </div>
</div>
@endif

@endsection

@section('extra-js')

<script>
var selects=document.querySelectorAll('#qty');

//on transforme notre selects en tableau et on boucle sur notre element
Array.from(selects).forEach((element) =>{
      element.addEventListener('change',function(){
      //on recupere le rowId
      var rowId=this.getAttribute('data-id');
      var stock=this.getAttribute('data-stock');//on injecte la variable dans le body ajax-->
      var token= document.querySelector('meta[name="csrf-token"]').getAttribute('content');//on recupere le token et la section extra-meta


      //////////////////REQUETE AJAX///////////////////////////////
      fetch (
                          `/panier/${rowId}`,//cette route appelle la fonction update
                         {
                            headers:{
                               "Content-Type":"application/json",
                                "Accept":"application/json ,text-plain,*/*",
                                "X-Requested-With":"XMLHttpRequest",
                                "X-CSRF-TOKEN":token
                           },

                            method:'put',

                            body: JSON.stringify({
                                //stringify converti une valeur javascript en json
                            qty:this.value,
                            stock:stock //dans mon controller je vcais récupetrer mes données avec la clé stock

                            })

                            }

                               //si on a un retour positif fonction data
                       ).then((data)=>{
                           console.log(data);

                         location.reload();
                       }).catch((error)=> {

                        console.log(error)
                       })




  });
});



</script>

@endsection


