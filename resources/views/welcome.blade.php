<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{asset('img/caddie.png')}}" />
        <title>Shop</title>
        <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
            <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}})">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/MagnificPopup/magnific-popup.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
                <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">



        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body>



            <section class="section-slide" height="100vh">
                <div class="wrap-slick1" height="100vh">
                    <div class="slick1">
                        <div class="item-slick1" width="100vh" height="100vh" style="background-image: url(img/costumes.jpg);">
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                    <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                        <span class="ltext-101 cl2 respon2">
                                            <img src="{{asset('img/haute.png')}}" width="100" height="100" >
                                        </span>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                        <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1 text-light">
                                            Produit de Haute qualité
                                        </h2>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                        <a href="{{route('products.index')}}" class="flex-c-m stext-101 cl0 size-101 bg1 text-dark bor1 hov-btn1 boutton p-lr-15 trans-04">
                                              Decouvrir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item-slick1" style="background-image: url(img/sold5.jpg);">
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                    <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                        <span class="ltext-101 cl2 respon2">

                                            <img src="{{asset('img/ris.png')}}" width="100" height="100" >
                                        </span>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                                        <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1 text-light">

                                            Soldes permanents
                                        </h2>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                        <a href="{{route('products.index')}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 text-dark hov-btn1 p-lr-15 trans-04">
                                           Decouvrir

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item-slick1" style="background-image: url(img/safe.jpg);">
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                    <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                                        <span class="ltext-101 cl2 respon2 text-dark">

                                            <img src="{{asset('img/safe4.png')}}" width="100" height="100" >
                                        </span>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                                        <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1 text-light">
                                            Paiement Sécurisé
                                        </h2>
                                    </div>

                                    <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                        <a href="{{route('products.index')}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 text-dark p-lr-15 trans-04">
                                          Decouvrir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>





     <script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>

	<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>


    </body>
</html>
