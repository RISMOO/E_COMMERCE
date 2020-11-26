@extends('layouts.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')
<div class="col-md-12">

    <a href="{{ route('cart.index') }}" class="btn btn-sm btn-secondary mt-3">Revenir au panier</a>
    <h1 class="mb-5">

        Page de paiement</h1>
        <div class="row">
       <div class="col-md-6">

        <form action="{{ route('checkout.store') }}" id="payment-form" method="POST">
            @csrf
            <div id="card-element">
              <!-- Elements will create input elements here -->
            </div>

            <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert"></div>

            <button class="btn btn-success mt-4" id="submit"><i class="far fa-credit-card"></i> Régler maintenant<span class="text-dark font-weight-bold"> ( {{getPrice2(Cart::total())}} € )</span></button>
          </form>


       </div>

        </div>
    </h1>
</div>
@stop

@section('extra-js')

<script>//SCRIPT.JS STRIPE
document.getElementsByClassName('blog-header')[0].classList.add("d-none");
    document.getElementsByClassName('nav-scroller')[0].classList.add("d-none");

var stripe = Stripe('pk_test_51HqC2FAWXp5BVHyztMXvFIk43OLNcZ4AeP5tn3hvci8Iv452cCk9LwxJUDRuhwttaUJfO1394bernZWfLUe4yPwb00SdqFfuTe');
var elements = stripe.elements();

//STYLE CLIENT.JS STRIPE
var style = {
    base: {
      color: "#32325d",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4"
      }
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a"
    }
  };
//VAR CARD CLIENT.JS STRIPE
var card = elements.create("card", { style: style });
card.mount("#card-element");
//JAVASCRIPT//GESTION ERREUR

card.on('change', ({error}) => {
  let displayError = document.getElementById('card-errors');
  if (error) {
      displayError.classList.add('alert','alert-warning')
    displayError.textContent = error.message;
  } else {
    displayError.classList.remove('alert','alert-warning')
    displayError.textContent = '';
  }
});
///CLIENT.JS

var form = document.getElementById('payment-form');
var button=document.getElementById('submit');

button.addEventListener('click', function(ev) {
  ev.preventDefault();
  button.disabled=true;
  stripe.confirmCardPayment("{{$clientSecret}}", {
    payment_method: {
      card: card

    }
  }).then(function(result) {
    if (result.error) {
      // Show error to your customer (e.g., insufficient funds)
      button.disabled=false;
      console.log(result.error.message);
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
      var paymentIntent=result.paymentIntent;//objet de notre commande
      var token= document.querySelector('meta[name="csrf-token"]').getAttribute('content')//recupere sur https://laravel.com/docs/8.x/csrf on change le jquery en document.queryselector
       //on recupere le contenu du token
      var form=document.getElementById('payment-form');//on recupere lid de notre formulaire
      var url=form.action;//on recuoere lurl de l'action de notre formulaire
      var redirect='/merci';

//////////////////REQUETE AJAX///////////////////////////////
                       fetch(
                          url,//url
                         {
                            headers:{
                               "Content-Type":"application/json",
                                "Accept":"application/json ,text-plain,*/*",
                                "X-Requested-With":"XMLHttpRequest",
                                "X-CSRF-TOKEN":token
                           },

                            method:'post',

                            body: JSON.stringify({
                                //stringify converti une valeur javascript en json
                              paymentIntent:paymentIntent

                            })

                            }

                               //si on a un retour positif fonction data
                       ).then((data)=>{
                           console.log(data);
                           form.reset();
                         window.location.href = redirect;
                       }).catch((error)=> {

                        console.log(error)
                       })


      }
    }
  });
});


//dans   notre fonction store de notre checkoutController
</script>

@endsection
