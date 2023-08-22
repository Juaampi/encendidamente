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
$(".loader").delay(800).fadeOut(1500);
</script>

@if(session()->has('alert-success-add'))

<script>
  swal({
    title: "¡Producto agregado al carrito!",
    text: "Haz agregado 1 producto al carrito de compras, lo vas a visualizar en el lado inferior derecho de la pantalla. Si queres finalizar la compra o editarlo, podés clickear sobre el mismo.",
    icon: "success",
    button: "Gracias",
  });
</script>

@endif


<div class="container">
    <nav aria-label="breadcrumb" class="mb-3 bread">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Velas</a></li>
          <li class="breadcrumb-item"><a href="#">Aromáticas</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$producto->categoria->nombre}}</li>
        </ol>
      </nav>
<div class="row" style="font-family: 'Titillium Web', sans-serif">
    <div class="col-md-6" style="height: 100%">
      <div class="swiper-overflow-container">
      <div class="swiper-container s3">
        <div class="swiper-wrapper">
          @if($producto->img1)
          
          <div class="swiper-slide pswp-gallery" id="my-gallery">
        

            <a href="img-products/{{$producto->img1}}"  data-pswp-width="1875"
              data-pswp-height="2500"
              target="_blank"
              >
               <img style="width: 100%" class="zoomE" src="img-products/{{$producto->img1}}"/>
              </a>
        </div>
            
          
          @endif
          @if($producto->img2)
          <div class="swiper-slide pswp-gallery" id="my-gallery">
            <a href="img-products/{{$producto->img2}}"  data-pswp-width="1875" data-pswp-height="2500" target="_blank">
               <img style="width: 100%" class="" src="img-products/{{$producto->img2}}">
            </a>
          </div>
          @endif
          @if($producto->img3)
          <div class="swiper-slide pswp-gallery" id="my-gallery">
            <a href="img-products/{{$producto->img3}}"  data-pswp-width="1875" data-pswp-height="2500" target="_blank">
               <img style="width: 100%" class="" src="img-products/{{$producto->img3}}">
            </a>
          </div>
          @endif
          @if($producto->img4)
          <div class="swiper-slide pswp-gallery" id="my-gallery">
            <a href="img-products/{{$producto->img4}}"  data-pswp-width="1875" data-pswp-height="2500" target="_blank">
               <img style="width: 100%" class="" src="img-products/{{$producto->img4}}">
            </a>
          </div>
          @endif         
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next" style="color: black;"></div>
        <div class="swiper-button-prev" style="color: black;"></div>
      </div>   
      </div>   
    </div>
    <div class="col-md-6 mt-2">
        <div class="text-center">
          @if($producto->descuento_porcentaje != 0)					
					<?php $porcentaje = 0; $price = 0;
					$porcentaje = $producto->monto*$producto->descuento_porcentaje; 
					$porcentaje = $porcentaje / 100;
					$price = $producto->monto - $porcentaje; 											
					?>
					<span style="color: #bebebe; font-size: 12px;"><s>${{$producto->monto * $producto->tipo_cambio->valor}}</s></span>
					<span class="text-product-price">${{$price * $producto->tipo_cambio->valor}}<span>		
					@else
          <h3 class="text-product-price" style="margin-bottom: -5px;">${{$producto->monto * $producto->tipo_cambio->valor}}</h3>
					@endif
        <br>
        @if($producto->descuento_porcentaje)
        <small class="badge badge-secondary" style="font-size: 11px;">Producto con {{$producto->descuento_porcentaje}}% de descuento</small>
        @endif
        <h4 class="text-product-title mt-2" style="color: #676767">{{$producto->nombre}}</h4>
        <h6 class="text-product-description mt-3">{{$producto->descripcion}}</h6>
        <!--
        <h6 class="text-product-description mt-3">Recomendamos utilizar <a href="#">Pantalón Costumbre</a> o <a href="#">Pollera Gris</a> para completar el look.</h6>
        <h6 class="text-product-description mt-3">Contamos con la remera <a href="#">Remerón TUPAC</a>, que es del mismo estilo.</h6>        
        
        <h6 class="text-product-description mt-3 mb-3"><a href="#">VER TABLA DE TALLES</a></h6>
        -->
        <div class="row" style="font-family: 'Titillium Web', sans-serif">
          <div class="col-md-12 text-center">           
              <table class="table table-stripped mt-3 text-product-description">
                  <tbody>                     
                      <tr>
                        <th>Color</th>
                          <td>{{$producto->color->nombre}}</td>                   
                      </tr>                     
                      <tr>
                        <th>Material</th>
                          <td>
                              <span>Cera de Soja</span>                      
                          </td>                      
                      </tr>
                     
                  </tbody>
              </table>
          </div>
      </div>
    
        <form action="/alcarro" method="POST"> 
          <input type="hidden" value="{{$producto->id}}" name="product_id">                               
          <input type="hidden" name="_token" value="{{ csrf_token() }}">                           
          <input id="btn-add" type="submit" class="btn btn-secondary mt-3" value="AGREGAR AL CARRITO">
        </form>
       
        
       
       

        
        </div>     
           
    </div>
</div>


</div>


<div id="modal-zoom-img1" class="modal fade" role="dialog">
  <div class="modal-dialog" style">            
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header bg-dark">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_button">&times;</span><span class="sr-only">Close</span></button>			
    </div>
    <div class="modal-body bg-dark">        
    <img style="width: 100%; height: 100%" src="img-products/{{$producto->img1}}" />
    </div>
    
    
    </div>
  
  </div>
  </div>


<script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>

<script type="module">

import PhotoSwipeLightbox from 'https://unpkg.com/photoswipe/dist/photoswipe-lightbox.esm.js';

const lightbox = new PhotoSwipeLightbox({
  gallery: '#my-gallery',
  children: 'a',
  pswpModule: () => import('https://unpkg.com/photoswipe'),
});

lightbox.init();
</script>


  

<script>

jQuery(document).ready(function(){
  $('#select-talle').on('change', function(){
    if($('#select-talle').val() != 0 && $('#select-color').val() != 0){
        $('#btn-add').prop("disabled",false);
    }else{
      $('#btn-add').prop("disabled",true);
    }
  });
  $('#select-color').on('change', function(){
    if($('#select-talle').val() != 0 && $('#select-color').val() != 0){
        $('#btn-add').prop("disabled",false);
    }else{
      $('#btn-add').prop("disabled",true);
    }
  });
  
});
  </script>


@endsection