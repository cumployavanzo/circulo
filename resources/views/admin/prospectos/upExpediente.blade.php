<!-- <html lang="en"><head itemscope="" itemtype="http://schema.org/WebSite"> -->
<!DOCTYPE html>
<html lang="en">
	<title itemprop="name">Cumplo y Avanzo</title>
	<meta name="_token" content="{{ csrf_token() }}">

	<!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="Preview Bootstrap snippets. Gradients dashboard cards. Copy and paste the html, css and js code for save time, build your app faster and responsive"><meta name="keywords" content="bootdey, bootstrap, theme, templates, snippets, bootstrap framework, bootstrap snippets, free items, html, css, js"><meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"><meta name="viewport" content="width=device-width"><link rel="shortcut icon" type="image/x-icon" href="https://www.bootdey.com/img/favicon.ico"><link rel="apple-touch-icon" sizes="135x140" href="https://www.bootdey.com/img/bootdey_135x140.png"><link rel="apple-touch-icon" sizes="76x76" href="https://www.bootdey.com/img/bootdey_76x76.png"><link rel="canonical" href="https://www.bootdey.com/snippets/preview/Gradients-dashboard-cards?full-screen=true" itemprop="url"><meta property="twitter:account_id" content="2433978487"><meta name="twitter:card" content="summary"><meta name="twitter:card" content="summary_large_image"><meta name="twitter:site" content="@bootdey"><meta name="twitter:creator" content="@bootdey"><meta name="twitter:title" content="Preview Bootstrap  snippets. Gradients dashboard cards"><meta name="twitter:description" content="Preview Bootstrap snippets. Gradients dashboard cards. Copy and paste the html, css and js code for save time, build your app faster and responsive"><meta name="twitter:image" content="https://www.bootdey.com/files/SnippetsImages/bootstrap-snippets-812.png"><meta name="twitter:url" content="https://www.bootdey.com/snippets/preview/Gradients-dashboard-cards?full-screen=true"><meta property="og:title" content="Preview Bootstrap  snippets. Gradients dashboard cards"><meta property="og:url" content="https://www.bootdey.com/snippets/preview/Gradients-dashboard-cards?full-screen=true"><meta property="og:image" content="https://www.bootdey.com/files/SnippetsImages/bootstrap-snippets-812.png"><meta property="og:description" content="Preview Bootstrap snippets. Gradients dashboard cards. Copy and paste the html, css and js code for save time, build your app faster and responsive"><link rel="alternate" type="application/rss+xml" title="Latest snippets resources templates and utilities for bootstrap from bootdey.com:" href="https://bootdey.com/rss"><link rel="author" href="https://plus.google.com/u/1/106310663276114892188"><link rel="publisher" href="https://plus.google.com/+Bootdey-bootstrap/posts"><meta name="msvalidate.01" content="23285BE3183727A550D31CAE95A790AB"> <script src="/cache-js/cache-1635427806-97135bbb13d92c11d6b2a92f6a36685a.js" type="text/javascript"></script> </head> -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<body><div id="snippetContent"><link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"> <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> <script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
	<div class="row">
      	<div class="col-12 mt-3 mb-1">
			<h4 class="text-uppercase">Carga tus documentos</h4>
			<p>Selecciona tus archivos para cargarlos.</p>
      	</div>
    </div>
	<div class="navbar_ bg-white b-b flex-row"><div class="d-flex_ p-2 text-left flex justify-content-center"> 
		<a href="http://cfowolf.test/encuesta-prospecto" class="btn btn-info">Solicitud</a> 
		<a href="https://www.facebook.com/cumployavanzomx" class="btn btn-info">Facebook</a> 
		<a href="https://api.whatsapp.com/send?phone=5215626931955&text=%C2%A1Hola!%20En%20Cumplo%20y%20Avanzo%20te%20damos%20la%20bienvenida%20a%20nuestro%20servicio%20de%20WhatsApp.%20%20%0A%0A%C2%BFC%C3%B3mo%20podr%C3%ADamos%20apoyarte%3F%0ASi%20tienes%20alguna%20duda%2C%20comp%C3%A1rtenos%20tu%20nombre%E2%9C%A8%20%0A%0AConsulta%20nuestro%20aviso%20de%20privacidad%20https%3A%2F%2Fcumployavanzo.com.mx%2Faviso-de-privacidad%0A%0AO%20nuestra%20p%C3%A1gina%3A%20http%3A%2F%2Fwww.cumployavanzo.com.mx" class="btn btn-info">WhatsApp</a> 
		<a href="https://www.cumployavanzo.com.mx/" class="btn btn-success">Salir</a> 
	</div>
	<div class="row">
	@if(empty($cliente->ine_anverso))
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">INE Anverso</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarForm"  enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" id="idCliente" name="idCliente" value="61">

					<div class="avatar pull-left" style="background-image: url(http://cfowolf.com/img/ine_anverso.jpeg)"></div>
						
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
		@else
			<div class="col-xl-3 col-sm-6 col-md-offset-2">
				<div class="card bg-c-pink order-card py-5 px-4"><img src="{{ asset('img/ine_anverso.jpeg') }}" alt="" width="100" height="250" class="img-fluid mb-3 img-thumbnail shadow-sm"><br>
					<h5 class="mb-0">INE Anverso</h5><span class="small text-uppercase">Carga - Completada</span>
				</div>
			</div>
		@endif

		@if(empty($cliente->ine_reverso))

		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-green order-card">
				<div class="card-block">
					<h6 class="m-b-20">INE Reverso</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarFormIneRev"  enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" id="idCliente" name="idCliente" value="61">
					<div class="avatar pull-left" style="background-image: url(http://cfowolf.com/img/ine_reverso.jpeg)"></div>
					<div>
						<input type="file" name="ine_reverso" id="ine_reverso" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="ine_reverso">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" id="avatar_ineRev" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
						</form>

					</div>	
				</div>
			</div>
		</div>	
		@else
			<div class="col-xl-3 col-sm-6 col-md-offset-2">
				<div class="card bg-c-pink order-card py-5 px-4"><img src="{{ asset('img/ine_reverso.jpeg') }}" alt="" width="100" height="250" class="img-fluid mb-3 img-thumbnail shadow-sm"><br>
					<h5 class="mb-0">INE Anverso</h5><span class="small text-uppercase">Carga - Completada</span>
				</div>
			</div>
		@endif

		@if(empty($cliente->foto_conIne))

		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">Foto con INE</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarFormIneFoto"  enctype="multipart/form-data">
					<input type="hidden" id="idCliente" name="idCliente" value="61">

					{{ csrf_field() }}
					<div class="avatar pull-left" style="background-image: url(http://cfowolf.com/img/foto_ine.png)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="foto_ine" id="foto_ine" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="foto_ine">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" id="avatar_ineFoto" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
						</form>
					</div>	
				</div>
			</div>
		</div>
		@else
			<div class="col-xl-3 col-sm-6 col-md-offset-2">
				<div class="card bg-c-pink order-card py-5 px-4"><img src="{{ asset('img/foto_ine.png') }}" alt="" width="100" height="250" class="img-fluid mb-3 img-thumbnail shadow-sm"><br>
					<h5 class="mb-0">Foto con INE</h5><span class="small text-uppercase">Carga - Completada</span>
				</div>
			</div>
		@endif


		@if(empty($cliente->curp))

		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-green order-card">
				<div class="card-block">
					<h6 class="m-b-20">Curp</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarFormCurp"  enctype="multipart/form-data">
					<input type="hidden" id="idCliente" name="idCliente" value="61">
					{{ csrf_field() }}
					<div class="avatar pull-left" style="background-image: url(http://cfowolf.com/img/curp.png)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="curp" id="curp" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="curp">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" id="avatar_curp" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
						</form>
					</div>	
				</div>
			</div>
		</div>
		@else
			<div class="col-xl-3 col-sm-6 col-md-offset-2">
				<div class="card bg-c-pink order-card py-5 px-4"><img src="{{ asset('img/curp.png') }}" alt="" width="100" height="250" class="img-fluid mb-3 img-thumbnail shadow-sm"><br>
					<h5 class="mb-0">CURP</h5><span class="small text-uppercase">Carga - Completada</span>
				</div>
			</div>
		@endif


		@if(empty($cliente->comprobante_domici))
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">Comprobante de Domicilio</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarFormRecibo"  enctype="multipart/form-data">
					<input type="hidden" id="idCliente" name="idCliente" value="61">
					{{ csrf_field() }}
					<div class="avatar pull-left" style="background-image: url(http://cfowolf.com/img/recibo_luz.jpeg)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="comprobante_domicilio" id="comprobante_domicilio" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="comprobante_domicilio">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" id="avatar_recibo"  width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div> 
			</div>
		</div>
		@else
			<div class="col-xl-3 col-sm-6 col-md-offset-2">
				<div class="card bg-c-pink order-card py-5 px-4"><img src="{{ asset('img/recibo_luz.jpeg') }}" alt="" width="100" height="250" class="img-fluid mb-3 img-thumbnail shadow-sm"><br>
					<h5 class="mb-0">Comprobante de Domicilio</h5><span class="small text-uppercase">Carga - Completada</span>
				</div>
			</div>
		@endif

		@if(empty($cliente->comprobante_ingresos))
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-green order-card">
				<div class="card-block">
					<h6 class="m-b-20">Comprobante de Ingresos</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarFormIngreso"  enctype="multipart/form-data">
					<input type="hidden" id="idCliente" name="idCliente" value="61">
					{{ csrf_field() }}
					<div class="avatar pull-left" style="background-image: url(http://cfowolf.com/img/ingresos.png)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="comprobante_ingresos" id="comprobante_ingresos" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="comprobante_ingresos">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile"  id="avatar_ingreso" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		@else
			<div class="col-xl-3 col-sm-6 col-md-offset-2">
				<div class="card bg-c-pink order-card py-5 px-4"><img src="{{ asset('img/ingresos.png') }}" alt="" width="100" height="250" class="img-fluid mb-3 img-thumbnail shadow-sm"><br>
					<h5 class="mb-0">Comprobante de Ingresos</h5><span class="small text-uppercase">Carga - Completada</span>
				</div>
			</div>
		@endif
		
		@if(empty($cliente->estado_cuenta))
		<div class="col-md-4 col-xl-3">
			<div class="card bg-c-pink order-card">
				<div class="card-block">
					<h6 class="m-b-20">Estado de Cuenta Bancario</h6>
					<form action="{{ url('perfil/foto') }}" method="post" id="avatarFormCuenta"  enctype="multipart/form-data">
					<input type="hidden" id="idCliente" name="idCliente" value="61">
					{{ csrf_field() }}
					<div class="avatar pull-left" style="background-image: url(http://cfowolf.com/img/estado_cuenta.png)"></div>
					<!-- <h2 class="text-right"><i class="fa fa-rocket f-left"></i></h2><br> -->
					<div>
						<input type="file" name="estado_cuenta" id="estado_cuenta" class="inputfile inputfile-5" data-multiple-caption="{count} archivos seleccionados" multiple />
						<label for="estado_cuenta">
						<figure>
							<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" id="avatar_cuenta" width="20" height="17" viewBox="0 0 20 17">
								<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
						</figure>
						<span class="iborrainputfile">Seleccionar archivo</span>
						</label>
					</div>	
				</div>
			</div>
		</div>
		@else
			<div class="col-xl-3 col-sm-6 col-md-offset-2">
				<div class="card bg-c-pink order-card py-5 px-4"><img src="{{ asset('img/estado_cuenta.png') }}" alt="" width="100" height="250" class="img-fluid mb-3 img-thumbnail shadow-sm"><br>
					<h5 class="mb-0">Estado de Cuenta</h5><span class="small text-uppercase">Carga - Completada</span>
				</div>
			</div>
		@endif
		
		

		
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

<style type="text/css">body{
    margin-top:20px;
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

div.avatar {
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 60px;
    width: 40px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
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
/**********End File Inputs**********/
</style> 
<script type="text/javascript">
	

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



$(function () {
    var $avatarImage, $avatarInput, $avatarForm;

    $avatarImage = $('#avatarImage');
    $avatarInput = $('#ine_anverso');
    $avatarForm = $('#avatarForm');
    

    $avatarInput.on('change', function () {


		var formData = new FormData();
		formData.append('ine_anverso', $avatarInput[0].files[0]);

		$.ajax({
			url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
			method: $avatarForm.attr('method'),
			data: formData,
			processData: false,
			contentType: false
		}).done(function (data) {
			if (data.success)
				$avatarImage.attr('src', data.path);
        		window.location.reload()

		}).fail(function () {
			alert('La imagen subida no tiene un formato correcto');
		});

    });
});

$(function () {
    var $avatarIneRev, $avatarInputRev, $avatarFormRev;

    $avatarIneRev = $('#avatar_ineRev');
    $avatarInputRev = $('#ine_reverso');
    $avatarFormRev = $('#avatarFormIneRev');
    

    $avatarInputRev.on('change', function () {


		var formData = new FormData();
		formData.append('ine_reverso', $avatarInputRev[0].files[0]);

		$.ajax({
			url: $avatarFormRev.attr('action') + '?' + $avatarFormRev.serialize(),
			method: $avatarFormRev.attr('method'),
			data: formData,
			processData: false,
			contentType: false
		}).done(function (data) {
			if (data.success)
				$avatarIneRev.attr('src', data.path);
        		window.location.reload()

		}).fail(function () {
			alert('La imagen subida no tiene un formato correcto');
		});

    });
});

$(function () {
    var $avatarIneFoto, $avatarInputFoto, $avatarFormIneFoto;

    $avatarIneFoto = $('#avatar_ineFoto');
    $avatarInputFoto = $('#foto_ine');
    $avatarFormIneFoto = $('#avatarFormIneFoto');
    

    $avatarInputFoto.on('change', function () {


		var formData = new FormData();
		formData.append('foto_ine', $avatarInputFoto[0].files[0]);

		$.ajax({
			url: $avatarFormIneFoto.attr('action') + '?' + $avatarFormIneFoto.serialize(),
			method: $avatarFormIneFoto.attr('method'),
			data: formData,
			processData: false,
			contentType: false
		}).done(function (data) {
			if (data.success)
				$avatarIneFoto.attr('src', data.path);
        		window.location.reload()

		}).fail(function () {
			alert('La imagen subida no tiene un formato correcto');
		});

    });
});

$(function () {
    var $avatarCurp, $avatarInputCurp, $avatarFormCurp;

    $avatarCurp = $('#avatar_curp');
    $avatarInputCurp = $('#curp');
    $avatarFormCurp = $('#avatarFormCurp');
    

    $avatarInputCurp.on('change', function () {


		var formData = new FormData();
		formData.append('curp', $avatarInputCurp[0].files[0]);

		$.ajax({
			url: $avatarFormCurp.attr('action') + '?' + $avatarFormCurp.serialize(),
			method: $avatarFormCurp.attr('method'),
			data: formData,
			processData: false,
			contentType: false
		}).done(function (data) {
			if (data.success)
				$avatarCurp.attr('src', data.path);
        		window.location.reload()

		}).fail(function () {
			alert('La imagen subida no tiene un formato correcto');
		});

    });
});

$(function () {
    var $avatarRecibo, $avatarInputRecibo, $avatarFormRecibo;

    $avatarRecibo = $('#avatar_recibo');
    $avatarInputRecibo = $('#comprobante_domicilio');
    $avatarFormRecibo = $('#avatarFormRecibo');
    

    $avatarInputRecibo.on('change', function () {


		var formData = new FormData();
		formData.append('comprobante_domicilio', $avatarInputRecibo[0].files[0]);

		$.ajax({
			url: $avatarFormRecibo.attr('action') + '?' + $avatarFormRecibo.serialize(),
			method: $avatarFormRecibo.attr('method'),
			data: formData,
			processData: false,
			contentType: false
		}).done(function (data) {
			if (data.success)
				$avatarRecibo.attr('src', data.path);
        		window.location.reload()

		}).fail(function () {
			alert('La imagen subida no tiene un formato correcto');
		});

    });
});

$(function () {
    var $avatarIngreso, $avatarInputIngreso, $avatarFormIngreso;

    $avatarIngreso = $('#avatar_ingreso');
    $avatarInputIngreso = $('#comprobante_ingresos');
    $avatarFormIngreso = $('#avatarFormIngreso');
    

    $avatarInputIngreso.on('change', function () {


		var formData = new FormData();
		formData.append('comprobante_ingresos', $avatarInputIngreso[0].files[0]);

		$.ajax({
			url: $avatarFormIngreso.attr('action') + '?' + $avatarFormIngreso.serialize(),
			method: $avatarFormIngreso.attr('method'),
			data: formData,
			processData: false,
			contentType: false
		}).done(function (data) {
			if (data.success)
				$avatarIngreso.attr('src', data.path);
        		window.location.reload()

		}).fail(function () {
			alert('La imagen subida no tiene un formato correcto');
		});

    });
});

$(function () {
    var $avatarCuenta, $avatarInputCuenta, $avatarFormCuenta;

    $avatarCuenta = $('#avatar_cuenta');
    $avatarInputCuenta = $('#estado_cuenta');
    $avatarFormCuenta = $('#avatarFormCuenta');
    

    $avatarInputCuenta.on('change', function () {


		var formData = new FormData();
		formData.append('estado_cuenta', $avatarInputCuenta[0].files[0]);

		$.ajax({
			url: $avatarFormCuenta.attr('action') + '?' + $avatarFormCuenta.serialize(),
			method: $avatarFormCuenta.attr('method'),
			data: formData,
			processData: false,
			contentType: false
		}).done(function (data) {
			if (data.success)
				$avatarCuenta.attr('src', data.path);
        		window.location.reload()

		}).fail(function () {
			alert('La imagen subida no tiene un formato correcto');
		});

    });
});

</script> 
</div> 

</body>
</html>