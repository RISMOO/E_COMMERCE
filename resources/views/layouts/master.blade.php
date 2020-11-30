
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('img/shop.png')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Application E-commerce en Laravel par rismo">
    <meta name="author" content="Rismo">
    <meta name="generator" content="Jekyll v4.1.1">
    @yield('extra-meta')
    <title>Shop</title>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('extra-script')<!--stripe-->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">

<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
<meta name="author" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->

  </head>
  <body>
      <div id="app">
    <div class="container">




  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
      <a class="text-muted" href="{{route('cart.index')}}"><i class="fas fa-shopping-cart"></i> Panier <span class="badge badge-pill badge-danger">{{Cart::count()}} </span></a>
      </div>
      <div class="col-4 text-center">


        <a class="blog-header-logo text-dark" href="{{route('products.index')}}"><img src="{{asset('img/shop.png')}}" width="35" height="35" alt="A 50x50 image">Shop</a>

      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
       @include('partials.search')


       @include('partials.auth')

      </div>
    </div>
  </header>


  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <!--on va boucler sur notre nav categories-->

        @foreach(App\category::all() as $category)<!--on appelle notre model categoty -->
    <a class="p-2 text-muted" href="{{route('products.index',['categorie'=>$category->slug])}}">{{$category->name}}</a><!--la route avec une key dsans lurl slug-->

      @endforeach
    </nav>
  </div>
@if (session('success'))<!-- si la session contient un message -->
<div class="alert alert-success">
{{session('success')}}
</div>
@endif

@if (session('error'))<!-- si la session contient un message -->
<div class="alert alert-danger">
{{session('error')}}
</div>
@endif

@if (count($errors) > 0 )<!-- si la session contient un message -->
<div class="alert alert-danger">
<ul class="mb-0 mt-0">

    @foreach ($errors->all() as $error)
<li>{{$error}}</li>
    @endforeach
</ul>
</div>
@endif


@if(request()->input())
<h6><span class="text-danger font-size-26 font-weight-300">{{$products->total()}}</span> résultat(s) pour la recherche "{{request()->q}}"</h6><!--recherches articles-->
@endif

  <div class="row mb-2">
 @yield('content')

  </div>
</div>


<footer class="blog-footer">
  <p>E-commerce<i class="fas fa-shopping-cart"></i> <a href="https://rismo.fr/"><img src="{{asset('img/logo.jpg')}}"width="40" height="40" ></a> by rismo</a>.</p>
  <p>
    <a href="#">Revenir en haut</a>
  </p>
</footer>

@yield('extra-js')<!--js- stripe-->
</div>
</div>
</body>
</html>
