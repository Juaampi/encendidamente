@extends('layouts.app')

@section('content')


<div class="loader">    
	
</div>

<style>
  .loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('img/loading.gif') 50% 50% no-repeat rgb(0, 0, 0);      
}
</style>

<script type="text/javascript">
$(".loader").delay(200).fadeOut(1500);
</script>

<style>
	.swiper-container{width: 100%; height: 100%;}
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
	.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
	width:100%;
}
.texto-encima{
    position: absolute;
    top: 10px;
    left: 10px;
}
.centrado{
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
	font-family: 'Amatic SC', cursive;
	color: white; 
	font-size: 50px;
	text-shadow: 2px 2px 2px black;
	width: 100%;
}

	.scene {
  position: absolute;
  width: 100%;
  height: 70%;
  top: 20vh;
  left: 0;
  min-height: 360px;
}
.parallax {
  position: relative;
  overflow: hidden;
  height: 100%;
  width: 100%;
}
.parallax:after {
  content: "";
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.2) 90%);
}


.ml2 .letter {
  display: inline-block;
  line-height: 1em;
}

.ml3 .letter {
  display: inline-block;
  line-height: 1em;
  color:#e56396;
}


  </style>

		<div class="contenedor">
			<img src="img/header.jpg" class="img-header" style="width:100%">
			<div   class="centrado">				
					  <p>
						<span class="ml2 header-encendida" >ENCENDIDA</span><span class="ml3 header-encendida" >MENTE</span>
					</p>				  				
			</div>
		  </div>
			 
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
 
	<script>

// Wrap every letter in a span
var textWrapper = document.querySelector('.ml2');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml2 .letter',
    scale: [4,1],
    opacity: [0,1],
    translateZ: 0,
    easing: "easeOutExpo",
    duration: 1500,
    delay: (el, i) => 70*i
  }).add({
    targets: '.ml2',
    opacity: 0,
    duration: 2000,
    easing: "easeOutExpo",
    delay: 2000
  });

  var textWrapper2 = document.querySelector('.ml3');
textWrapper2.innerHTML = textWrapper2.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml3 .letter',
    scale: [4,1],
    opacity: [0,1],
    translateZ: 0,
    easing: "easeOutExpo",
    duration: 1500,
    delay: (el, i) => 70*i
  }).add({
    targets: '.ml3',
    opacity: 0,
    duration: 2000,
    easing: "easeOutExpo",
    delay: 2000
  });
	</script>

     
    <section >	  	
		
		<hr style="width: 70%; margin:auto;margin-top:30px;margin-bottom: 30px">

		<div class="row mt-4 headline">            
			<p style="font-family: 'Dancing Script', cursive;font-size: 40px;text-align: center; color: #e56396">Gourmet</p>			 					
					<div class="col-md-12 col-12 mt-2" style="margin-right: -10px;">
						<div class="swiper-overflow-container">						  
						  <div class="swiper-container s2">
							  <div class="swiper-wrapper">

								@foreach($productos as $product)
									@if($product->categoria->nombre == "Gourmet")
										
										<div class="swiper-slide">											
											<div class="card" loading="lazy">												
												@if($product->img1)
													<img data-swiper-parallax="-10" data-swiper-parallax-opacity="0.10" data-swiper-parallax-duration="1200" style="width:100%;" src="/img-products/{{$product->img1}}"/>
												@endif
												<div class="card-body" style="background: black;">
													<p data-swiper-parallax-opacity="0.10" data-swiper-parallax="-100"  data-swiper-parallax-duration="800" class="text-product-title"><a style="color: white;font-size: 15px;" href="/producto?product_id={{$product->id}}">{{$product->nombre}}</a> @if($product->descuento_porcentaje != 0)<small class="badge badge-light badge-sm" style="font-size: 11px;color: black">{{$product->descuento_porcentaje}}% OFF</small> @endif</p>
													<p data-swiper-parallax-opacity="0.10" data-swiper-parallax="-200"  data-swiper-parallax-duration="800" class="text-product-price" style="color: white;">													
														@if($product->descuento_porcentaje != 0)					
															<?php $porcentaje = 0; $monto = 0;
															$porcentaje = $product->monto*$product->descuento_porcentaje; 
															$porcentaje = $porcentaje / 100;
															$monto = $product->monto - $porcentaje; 											
															?>
															<span style="color: #white; font-size: 12px;"><s>${{$product->monto * $product->tipo_cambio->valor}}</s></span>
															<span class="text-product-price" style="color: white;">${{$monto * $product->tipo_cambio->valor}}<span>		
															@else
															<span class="text-product-price" style="color: white;">${{$product->monto * $product->tipo_cambio->valor}}<span>					
														@endif
													</p>
													<a class="btn btn-light btn-sm mt-2" href="/producto?product_id={{$product->id}}">Ver producto</a>
												</div>
											</div>
										</div>

									@endif
								@endforeach
	 
							  </div>
							  <!-- Add Pagination -->
							  <div class="swiper-pagination2"></div>	
							  <div class="swiper-button-next" style="color: #e56396;"></div>
							  <div class="swiper-button-prev" style="color: #e56396;"></div>					
							</div>  					
						 					
												  
						</div>
					</div>			  							
		  	</div>		




		  <div class="row mt-4 headline">            
			<p style="font-family: 'Dancing Script', cursive;font-size: 40px;text-align: center; color: #e56396">Formitas</p>			 					
					<div class="col-md-12 col-12 mt-2" style="margin-right: -10px;">
						<div class="swiper-overflow-container">						  
						  <div class="swiper-container s2">
							  <div class="swiper-wrapper">

								@foreach($productos as $product)
									@if($product->categoria->nombre == "Formitas")
										
									<div class="swiper-slide">											
										<div class="card" loading="lazy">												
											@if($product->img1)
												<img data-swiper-parallax="-10" data-swiper-parallax-opacity="0.10" data-swiper-parallax-duration="1200" style="width:100%;" src="/img-products/{{$product->img1}}"/>
											@endif
											<div class="card-body" style="background: black;">
												<p data-swiper-parallax-opacity="0.10" data-swiper-parallax="-100"  data-swiper-parallax-duration="800" class="text-product-title"><a style="color: white;font-size: 15px;" href="/producto?product_id={{$product->id}}">{{$product->nombre}}</a> @if($product->descuento_porcentaje != 0)<small class="badge badge-light badge-sm" style="font-size: 11px;color: black">{{$product->descuento_porcentaje}}% OFF</small> @endif</p>
												<p data-swiper-parallax-opacity="0.10" data-swiper-parallax="-200"  data-swiper-parallax-duration="800" class="text-product-price" style="color: white;">													
													@if($product->descuento_porcentaje != 0)					
														<?php $porcentaje = 0; $monto = 0;
														$porcentaje = $product->monto*$product->descuento_porcentaje; 
														$porcentaje = $porcentaje / 100;
														$monto = $product->monto - $porcentaje; 											
														?>
														<span style="color: #white; font-size: 12px;"><s>${{$product->monto * $product->tipo_cambio->valor}}</s></span>
														<span class="text-product-price" style="color: white;">${{$monto * $product->tipo_cambio->valor}}<span>		
														@else
														<span class="text-product-price" style="color: white;">${{$product->monto * $product->tipo_cambio->valor}}<span>					
													@endif
												</p>
												<a class="btn btn-light btn-sm mt-2" href="/producto?product_id={{$product->id}}">Ver producto</a>
											</div>
										</div>
									</div>

									@endif
								@endforeach
	 
							  </div>
							  <!-- Add Pagination -->
							  <div class="swiper-pagination2"></div>	
							  <div class="swiper-button-next" style="color: #e56396;"></div>
							  <div class="swiper-button-prev" style="color: #e56396;"></div>					
							</div>  					
						 					
												  
						</div>
					</div>			  							
		  	</div>		



			  <div class="row mt-4 mb-4 headline">  				
         
				<p style="font-family: 'Dancing Script', cursive;font-size: 40px;text-align: center; color: #e56396">Recipientes</p>			 					
						<div class="col-md-4 col-12 mt-2" style="margin-right: -10px;">
							<div class="swiper-overflow-container">						  
							  <div class="swiper-container s2">
								  <div class="swiper-wrapper">
	
									@foreach($productos as $product)
										@if($product->categoria->nombre == "Recipientes")
											
										<div class="swiper-slide">											
											<div class="card" loading="lazy">												
												@if($product->img1)
													<img data-swiper-parallax="-10" data-swiper-parallax-opacity="0.10" data-swiper-parallax-duration="1200" style="width:100%;" src="/img-products/{{$product->img1}}"/>
												@endif
												<div class="card-body" style="background: black;">
													<p data-swiper-parallax-opacity="0.10" data-swiper-parallax="-100"  data-swiper-parallax-duration="800" class="text-product-title"><a style="color: white;font-size: 15px;" href="/producto?product_id={{$product->id}}">{{$product->nombre}}</a> @if($product->descuento_porcentaje != 0)<small class="badge badge-light badge-sm" style="font-size: 11px;color: black">{{$product->descuento_porcentaje}}% OFF</small> @endif</p>
													<p data-swiper-parallax-opacity="0.10" data-swiper-parallax="-200"  data-swiper-parallax-duration="800" class="text-product-price" style="color: white;">													
														@if($product->descuento_porcentaje != 0)					
															<?php $porcentaje = 0; $monto = 0;
															$porcentaje = $product->monto*$product->descuento_porcentaje; 
															$porcentaje = $porcentaje / 100;
															$monto = $product->monto - $porcentaje; 											
															?>
															<span style="color: #white; font-size: 12px;"><s>${{$product->monto * $product->tipo_cambio->valor}}</s></span>
															<span class="text-product-price" style="color: white;">${{$monto * $product->tipo_cambio->valor}}<span>		
															@else
															<span class="text-product-price" style="color: white;">${{$product->monto * $product->tipo_cambio->valor}}<span>					
														@endif
													</p>
													<div class="card-footer">
														<a class="col-3 btn btn-light btn-sm mt-2 card-link" href="/producto?product_id={{$product->id}}">Ver</a>
														<div class="col-3">
															<form action="/alcarro" method="POST"> 
																<input type="hidden" value="{{$product->id}}" name="product_id">                               
																<input type="hidden" name="_token" value="{{ csrf_token() }}">                           
																<input style="font-size: 10px;" id="btn-add" type="submit" class="btn btn-light mt-3 card-link" value="Agregar al carrito">
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>

	
										@endif
									@endforeach
		 
								  </div>
								  <!-- Add Pagination -->
								  <div class="swiper-pagination2"></div>	
								  <div class="swiper-button-next" style="color: #e56396;"></div>
								  <div class="swiper-button-prev" style="color: #e56396;"></div>					
								</div>  					
												 
													  
							</div>
						</div>			  							
				  </div>		


		  <p class="mt-5 text-center"><a href="/productos" class="mt-3 text-center text-secondary">Ver todos</a>  </p>
	  </div>
	  
  </section>

@endsection