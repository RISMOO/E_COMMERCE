@extends('layouts.master')


@section('content')
<div class="col-12">
    <div class="jumbotron text-center m-1">
<h1 class="text-center">Merci,Votre commande a bien été prise en compte</h1>
<a href="{{route('products.index')}}" class="btn btn-info mb-4 mt-4"><i class="fas fa-shopping-basket"></i> Retourner a la boutique</a>

<p class="text-muted">Un problème ? <a href="mailto:tysef@live.fr">Contactez-nous</a>

</div>
</div>
@endsection
