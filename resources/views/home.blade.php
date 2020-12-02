@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bonjour <h2 class="text-success text-capitalize">{{Auth::user()->name}}</h2>Historique de vos commandes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                       @foreach (Auth()->user()->orders as $order)<!--relationship //on boucle sur les commandes-->
                              <div class="card">
                                  <div class="card-header">
                                     Commande passée le {{ Carbon\Carbon::parse($order->payment_created_at)->format('d/m/Y à H:i')}}
                                     d'un montant de <strong class="text-success">{{getPrice2($order->amount)}} €</strong> <!--carbon herite de la class datetime-->

                                  </div>

                                  <div class="card-body">
                                      <h6>Liste des produits</h6>
                                      @foreach (unserialize($order->products) as $product)<!-- on la chaine de caractere de notre base de donné en tableau -->
                                  <div>Nom du produit:{{$product[0]}}</div><!--array-->
                                  <div>Prix: {{getPrice2($product[1])}}</div>
                                  <div>Quantité:{{$product[2]}}</div>

                                      @endforeach


                                  </div>

                              </div>
                       @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
