@extends('layouts.AdminLTE.index')
@section('title', 'Asociados')
@section('header', 'Asociados')
@section('content')
<style>
    body{
    margin-top:20px;
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

div.avatar {
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 30px;
    width: 30px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 90%;
    background-size: 100% auto;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}

.container-input {
    text-align: center;
    background: #282828;
    border-top: 5px solid #ccc;
    padding: 50px 0;
    border-radius: 6px;
    width: 50%;
    margin: 0 auto;
    margin-bottom: 20px;
}

.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
}

.inputfile + label {
    max-width: 80%;
    font-size: 1.25rem;
    font-weight: 700;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    padding: 0.625rem 1.25rem;
}

.inputfile + label svg {
    width: 1em;
    height: 1em;
    vertical-align: middle;
    fill: currentColor;
    margin-top: -0.25em;
    margin-right: 0.25em;
}

.iborrainputfile {
	font-size:16px; 
	font-weight:normal;
	font-family: 'Lato';
}

/* style 1 */

.inputfile-1 + label {
    color: #fff;
    background-color: #ccc;
}

.inputfile-1:focus + label,
.inputfile-1.has-focus + label,
.inputfile-1 + label:hover {
    background-color: #cccc;
}

/* style 2 */

.inputfile-2 + label {
    color: #ccc;
    border: 2px solid currentColor;
}

.inputfile-2:focus + label,
.inputfile-2.has-focus + label,
.inputfile-2 + label:hover {
    color: #cccc;
}

/* style 3 */

.inputfile-3 + label {
    color: #fff;
}

.inputfile-3:focus + label,
.inputfile-3.has-focus + label,
.inputfile-3 + label:hover {
    color: #ccc;
}

/* style 4 */

.inputfile-4 + label {
    color: #fff;
}

.inputfile-4:focus + label,
.inputfile-4.has-focus + label,
.inputfile-4 + label:hover {
    color: #ccc;
}

/* style 5 */

.inputfile-5 + label {
    color: #ccc;
}

.inputfile-5:focus + label,
.inputfile-5.has-focus + label,
.inputfile-5 + label:hover {
    color: #cccc;
}

.inputfile-5 + label figure {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #ccc;
    display: block;
    padding: 20px;
    margin: 0 auto 10px;
}

.inputfile-5:focus + label figure,
.inputfile-5.has-focus + label figure,
.inputfile-5 + label:hover figure {
    background-color: #cccc;
}

.inputfile-5 + label svg {
    width: 100%;
    height: 100%;
    fill: #fff;
}

/* style 6 */

.inputfile-6 + label {
    color: #ccc;
}

.inputfile-6:focus + label,
.inputfile-6.has-focus + label,
.inputfile-6 + label:hover {
    color: #cccc;
}

.inputfile-6 + label figure {
    width: 100px;
    height: 135px;
    background-color: #ccc;
    display: block;
    position: relative;
    padding: 30px;
    margin: 0 auto 10px;
}

.inputfile-6:focus + label figure,
.inputfile-6.has-focus + label figure,
.inputfile-6 + label:hover figure {
    background-color: #cccc;
}

.inputfile-6 + label figure::before,
.inputfile-6 + label figure::after {
    width: 0;
    height: 0;
    content: '';
    position: absolute;
    top: 0;
    right: 0;
}

.inputfile-6 + label figure::before {
    border-top: 20px solid #282828;
    border-left: 20px solid transparent;
}

.inputfile-6 + label figure::after {
    border-bottom: 20px solid #cccc;
    border-right: 20px solid transparent;
}

.inputfile-6:focus + label figure::after,
.inputfile-6.has-focus + label figure::after,
.inputfile-6 + label:hover figure::after {
    border-bottom-color: #ccc;
}

.inputfile-6 + label svg {
    width: 100%;
    height: 100%;
    fill: #fff;
}

/* style 7 */

.inputfile-7 + label {
    color: #ccc;
}

.inputfile-7 + label {
    border: 1px solid #ccc;
    font-size: 1rem;
    background-color: #fff;
    padding: 0;
}

.inputfile-7:focus + label,
.inputfile-7.has-focus + label,
.inputfile-7 + label:hover {
    border-color: #cccc;
}

.inputfile-7 + label span,
.inputfile-7 + label strong {
    padding: 0.625rem 1.25rem;
}

.inputfile-7 + label span {
    width: 200px;
    min-height: 1em;
    display: inline-block;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    vertical-align: top;
}

.inputfile-7 + label strong {
    height: 100%;
    color: #fff;
    background-color: #ccc;
    display: inline-block;
}

.inputfile-7:focus + label strong,
.inputfile-7.has-focus + label strong,
.inputfile-7 + label:hover strong {
    background-color: #cccc;
}

@media screen and (max-width: 50em) {
	.inputfile-7 + label strong {
		display: block;
	}
}
</style>
<div class="container">
	<div class="row">
      	<div class="col-12 mt-3 mb-1">
			<h4 class="text-uppercase">Carga tus documentos</h4>
			<p>Statistics on minimal cards.</p>
      	</div>
    </div>
	
	<div class="row">	
	<input type="hidden" id="idCliente" name="idCliente" value="1">
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">INE Anverso</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarForm"  enctype="multipart/form-data">
					
					<div class="avatar pull-left rounded-circle" style="background-image: url(http://megana.mx/prestamos/img/lobo1.jpg)"></div>
						
						<input type="file" name="ine_anverso" id="ine_anverso" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />

						<label for="ine_anverso">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" id="avatarImage" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
						</form>
				</div>
			</div>
		</div>
		<!-- <div class="col-xl-3 col-sm-6 col-md-offset-2">
			<div class="bg-c-pink rounded shadow-sm py-5 px-4"><img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
				<h5 class="mb-0">INE Anverso</h5><span class="small text-uppercase" style="color:#FFFFFF">Carga - Completada</span>
			</div>
      	</div> -->
		
		
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-green order-card">
				<div class="card-block">
					<h6 class="m-b-20">INE Reverso</h6>
					<div class="avatar pull-left" style="background-image: url(http://megana.mx/prestamos/img/lobo1.jpg)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="ine_reverso" id="ine_reverso" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="ine_reverso">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">Foto con INE</h6>
					<div class="avatar pull-left" style="background-image: url(http://megana.mx/prestamos/img/lobo1.jpg)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="foto_ine" id="foto_ine" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="foto_ine">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-green order-card">
				<div class="card-block">
					<h6 class="m-b-20">Curp</h6>
					<div class="avatar pull-left" style="background-image: url(http://megana.mx/prestamos/img/lobo1.jpg)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="curp" id="curp" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="curp">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">Comprobante de Domicilio</h6>
					<div class="avatar pull-left" style="background-image: url(http://megana.mx/prestamos/img/lobo1.jpg)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="comprobante_domicilio" id="comprobante_domicilio" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="comprobante_domicilio">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-green order-card">
				<div class="card-block">
					<h6 class="m-b-20">Comprobante de Ingresos</h6>
					<div class="avatar pull-left" style="background-image: url(http://megana.mx/prestamos/img/lobo1.jpg)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="comprobante_ingresos" id="comprobante_ingresos" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="comprobante_ingresos">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		
		
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">Estado de Cuenta Bancario</h6>
					<div class="avatar pull-left" style="background-image: url(http://megana.mx/prestamos/img/lobo1.jpg)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="estado_cuenta" id="estado_cuenta" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="estado_cuenta">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		
		

		
		<!-- <div class="col-md-4 col-xl-3">
			<div class="card bg-c-green order-card">
				<div class="card-block">
					<h6 class="m-b-20">Orders Received</h6>
					<h2 class="text-right"><i class="fa fa-credit-card f-left"></i>
					<span>486</span>
					</h2><p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
				</div>
			</div>
		</div> -->
	</div>
</div>
@endsection
@push('scripts')
<script>
    
	'use strict';

;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;

			// guardarImg();
		});
	});
}( document, window, 0 ));

// function guardarImg() {

// 	let id = document.getElementById("idCliente").value;
//         $.ajax({
// 			url: "/cargaExpediente",
// 			// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             type: 'post',
//             cache: false,
//             beforeSend(){

//             },
//             success: function(data){
//                 console.log(data)
//             }
//         });
//         window.location.reload()

	
// }

$(function () {
    var $avatarImage, $avatarInput, $avatarForm;

    $avatarImage = $('#avatarImage');
    $avatarInput = $('#ine_anverso');
    $avatarForm = $('#avatarForm');

    

    $avatarInput.on('change', function () {
		$.ajax({
			url: "/perfil/foto",
			// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            cache: false,
            beforeSend(){

            },
            success: function(data){
                console.log(data)
            }
        });
        window.location.reload()

    });
});

</script>




@endpush