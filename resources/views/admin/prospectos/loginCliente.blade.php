
<head>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'>
</script>
</head>
<style>
    /*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {margin: 0;}

html {
	height: 100%;
	/*Image only BG fallback*/
	
	/*background = gradient + image pattern combo*/
	background: 
		linear-gradient(rgba(255, 87, 126, 0.35), rgba(255, 87, 126, 1));
}

body {
	font-family: montserrat, arial, verdana;
}
/*form styles*/
#msform {
	width: 400px;
	margin: 50px auto;
	text-align: center;
	position: relative;
}
#msform fieldset {
	background: white;
	border: 0 none;
	border-radius: 3px;
	box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
	padding: 20px 30px;
	box-sizing: border-box;
	width: 160%;
	margin: 0 10%;
	
	/*stacking fieldsets above each other*/
	position: relative;
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
	display: none;
}
/*inputs*/
#msform input, #msform textarea, #msform select {
	padding: 15px;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-family: montserrat;
	color: #2C3E50;
	font-size: 13px;
}
/*buttons*/
#msform .action-button {
	width: 100px;
	background: #ff517c;
	font-weight: bold;
	color: white;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px;
	margin: 10px 5px;
  text-decoration: none;
  font-size: 14px;
}
#msform .action-button:hover, #msform .action-button:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #ff517c;
}
/*headings*/
.fs-title {
	font-size: 15px;
	text-transform: uppercase;
	color: #2C3E50;
	margin-bottom: 10px;
}
.fs-subtitle {
	font-weight: normal;
	font-size: 13px;
	color: #666;
	margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
	color: white;
	text-transform: uppercase;
	font-size: 9px;
	/* width: 33.33%; */
	/* width: 13.33%; se modifica el with si se agrega mas li */
	width: 4%;  
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 200px;
	/* width: 9px; */
	line-height: 3;
	/* line-height: normal; */
	display: block;
	font-size: 10px;
	color: #333;
	background: white;
	border-radius: 3px;
	margin: 1 1 1 1;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: white;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #ff517c;
	color: white;
}


.form-list__input-inline {
    display: -ms-flexbox;
    display: flex;
   
    -ms-flex-pack: justify;
        justify-content: space-between; }
    .form-list__input-inline > * {
        margin: 10px;
      width: calc(50% - 10px - 10px); }



/* nuevas clases */

/* GRID */

.four { width: 32.26%; }


/* COLUMNS */

.col {
	display: block;
	float:left;
	margin: 0 0 0 1.6%;
}

.col:first-of-type {
  margin-left: 0;
}

.container{
  width: 100%;
  max-width: 700px;
  margin: 0 auto;
  position: relative;
}

.row{
  padding: 20px 0;
}


.wrapper{
  width: 100%;
  margin: 30px 0;
}

/* STEPS */

.steps{
  list-style-type: none;
  margin: 0;
  padding: 0;
  background-color: #fff;
  text-align: center;
}


.steps li{
  display: inline-block;
  margin: 20px;
  color: #ccc;
  padding-bottom: 5px;
}

.steps li.is-active{
  border-bottom: 1px solid #ff517c;
  color: #ff517c;
}

/* FORM */

.form-wrapper .section{
  padding: 0px 20px 30px 20px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  background-color: #fff;
  opacity: 0;
  -webkit-transform: scale(1, 0);
  -ms-transform: scale(1, 0);
  -o-transform: scale(1, 0);
  transform: scale(1, 0);
  -webkit-transform-origin: top center;
  -moz-transform-origin: top center;
  -ms-transform-origin: top center;
  -o-transform-origin: top center;
  transform-origin: top center;
  -webkit-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  text-align: center;
  position: absolute;
  width: 100%;
  min-height: 300px
}

.form-wrapper .section h3{
  margin-bottom: 30px;
}

.form-wrapper .section.is-active{
  opacity: 1;
  -webkit-transform: scale(1, 1);
  -ms-transform: scale(1, 1);
  -o-transform: scale(1, 1);
  transform: scale(1, 1);
}

.form-wrapper .button, .form-wrapper .submit{
  background-color: #ff517c;
  display: inline-block;
  padding: 8px 30px;
  color: #fff;
  cursor: pointer;
  font-size: 14px !important;
  font-family: 'Open Sans', sans-serif !important;
  position: absolute;
  right: 20px;
  bottom: 20px;
}

.form-wrapper .submit{
  border: none;
  outline: none;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

.form-wrapper input[type="text"],
.form-wrapper input[type="password"]{
  display: block;
  padding: 10px;
  margin: 10px auto;
  background-color: #f1f1f1;
  border: none;
  width: 50%;
  outline: none;
  font-size: 14px !important;
  font-family: 'Open Sans', sans-serif !important;
}

.form-wrapper input[type="radio"]{
  display: none;
}

.form-wrapper input[type="radio"] + label{
  display: block;
  border: 1px solid #ccc;
  width: 100%;
  max-width: 100%;
  padding: 1px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  cursor: pointer;
  position: relative;
}

.form-wrapper input[type="radio"] + label:before{
  content: "✔";
  position: absolute;
  right: -10px;
  top: -10px;
  width: 30px;
  height: 30px;
  line-height: 30px;
  border-radius: 100%;
  background-color: #ff517c;
  color: #fff;
  display: none;
}

.form-wrapper input[type="radio"]:checked + label:before{
  display: block;
}

.form-wrapper input[type="radio"] + label h4{
  margin: 15px;
  color: #ccc;
}

.form-wrapper input[type="radio"]:checked + label{
  border: 1px solid #ff517c;
}

.form-wrapper input[type="radio"]:checked + label h4{
  color: #ff517c;
}

</style>
<!-- multistep form -->
<body style="width: 1010px;">
@if (\Session::has('mensaje'))

<form id="msform">
  <!-- progressbar -->
  <!-- <ul id="progressbar">
    <li class="active">Account Setup</li>
    <li>Social Profiles</li>
    <li>Personal Details</li>
  </ul> -->
  <!-- fieldsets -->
  <fieldset>
    <h3>{{ session('nombre') }} {{ session('apellido_p') }} {{ session('apellido_m') }}</h3><br>
    <h3 class="fs-title">Muchas gracias por darnos tu información</h2>
    <h3 class="fs-subtitle">En breve te contactaremos a tu correo o al telefono proporcionado: </h3>
    <input type="text" value="{{ session('email') }}" disabled/>
    <input type="text" value="{{ session('telefono') }}" disabled/>
    <!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
  </fieldset>
 
 
</form>

@else

<form id="msform" method="POST" action="#" data-action="{{ route('listadoEncuestas') }}" enctype="multipart/form-data"  autocomplete="off">
@csrf
  <!-- progressbar -->
  <!-- <ul id="progressbar" style="width:160%"> se agrego 4 li mas -->
  <ul id="progressbar" style="width:160%">
    <li class="active">Inicio</li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li>Fin</li> 
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">1.- ¿Cuánto dinero necesitas?</h2>
    <h3 class="fs-subtitle">Por favor escribe cualquier monto en pesos de 1,000 a 3,000</h3>
        <input type="text" name="dinero" placeholder="" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
 
  <fieldset class="form-wrapper container">
    <h2 class="fs-title">2.- ¿A qué plazo?</h2>
    <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="plazo" id="plazo1" value="30 DIAS" required><label for="plazo1">
                <h4>30 DIAS</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="plazo" id="plazo2" value="60 DIAS"><label for="plazo2">
                <h4>60 DIAS</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="plazo" id="plazo3" value="90 DIAS"><label for="plazo3">
                <h4>90 DIAS</h4>
                </label>
            </div>  
        </div>
        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
            <input type="button" name="next" class="next action-button" value="Aceptar" />
    </fieldset>
  <fieldset>
    <h2 class="fs-title">3.- ¿Cuál es tu nombre completo?</h2>
    <h3 class="fs-subtitle">Por favor escribe todos tus nombres y apellidos como vienen en tu INE</h3>
        <input type="text" name="nombre" placeholder="Nombres"  style="text-transform:uppercase"  />
        <input type="text" name="primer_apellido" placeholder="Primer Apellido" style="text-transform:uppercase" />
        <input type="text" name="segundo_apellido" placeholder="Segundo Apellido" style="text-transform:uppercase" />
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />

  </fieldset>  

  <fieldset class="form-wrapper container">
    <h2 class="fs-title">4.- ¿Cuál es tu género?</h2>
    <h3 class="fs-subtitle"></h3>

        <div class="row cf">
            <div class="four col">
                <input type="radio" name="genero" id="generoF" value="Femenino"><label for="generoF" style="margin-left: 90px;">
                <h4>Femenino</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="genero" id="generoM" value="Masculino"><label for="generoM" style="margin-left: 100px;">
                <h4>Masculino</h4>
                </label>
            </div> 
        </div>

        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
    </fieldset>

  <fieldset>
    <h2 class="fs-title">5.- Por favor escribe tu fecha de nacimiento</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="hidden" id="edad" name="edad" value="">
        <input type="hidden" id="scoreEdad" name="scoreEdad" value="">
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class=""/>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" / onclick="calcularEdad();">
  </fieldset>
  <fieldset>
    <h2 class="fs-title">6.- ¿Cuál es tu teléfono de contacto?</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="input" name="telefono" maxlength="10" placeholder="999 999 9999"/>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">7.- Por favor danos un teléfono de emergencia</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="input" name="telefono_emergencia" maxlength="10" placeholder="999 999 9999"/>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">8.- ¿Cuál es tu correo electrónico?*</h2>
    <h3 class="fs-subtitle">Por favor verifica que esté correcto antes de pasar a la siguiente pregunta ya que será nuestro principal punto de contacto contigo.</h3>
        <input type="text" name="email" placeholder="correo@hotmail.com"/>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">9.- ¿En cuál estado de la República Mexicana radicas?</h2>
    <h3 class="fs-subtitle"></h3>
        <select type="select" id="txt_estado_nacimiento" name="txt_estado_nacimiento" required>
            <option value="">Seleccionar</option>
            <option value="AGUASCALIENTES">AGUASCALIENTES</option>
            <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
            <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
            <option value="CAMPECHE">CAMPECHE</option>
            <option value="CHIAPAS">CHIAPAS</option>
            <option value="CHIHUAHUA">CHIHUAHUA</option>
            <option value="COAHUILA">COAHUILA</option>
            <option value="COLIMA">COLIMA</option>
            <option value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
            <option value="DURANGO">DURANGO</option>
            <option value="GUANAJUATO">GUANAJUATO</option>
            <option value="GUERRERO">GUERRERO</option>
            <option value="HIDALGO">HIDALGO</option>
            <option value="JALISCO">JALISCO</option>
            <option value="MEXICO">MEXICO</option>
            <option value="MORELOS">MORELOS</option>
            <option value="MICHOACAN">MICHOACAN</option>
            <option value="NAYARIT">NAYARIT</option>
            <option value="NUEVO LEON">NUEVO LEON</option>
            <option value="OAXACA">OAXACA</option>
            <option value="PUEBLA">PUEBLA</option>
            <option value="QUERETARO">QUERETARO</option>
            <option value="QUINTANA ROO">QUINTANA ROO</option>
            <option value="SAN LUIS POTOSI">SAN LUIS POTOSI</option>
            <option value="SINALOA">SINALOA</option>
            <option value="SONORA">SONORA</option>
            <option value="TABASCO">TABASCO</option>
            <option value="TAMAULIPAS">TAMAULIPAS</option>
            <option value="TLAXCALA">TLAXCALA</option>
            <option value="VERACRUZ">VERACRUZ</option>
            <option value="YUCATAN">YUCATAN</option>
            <option value="ZACATECAS">ZACATECAS</option>
        </select>

        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">10.- Información de ingresos y ocupación</h2>
    <h3 class="fs-subtitle">A continuación te haremos unas preguntas sobre tus datos económicos</h3>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Continuar" />
  </fieldset>




    <fieldset class="form-wrapper container">
    <h2 class="fs-title">a. ¿Cuál es tu sueldo mensual?</h2>
    <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="sueldo" id="sueldo1" value="De $5,000 a $7,000"><label for="sueldo1" style="margin-left: 105%">
                <h4 style="margin: 10px">Menos de $5,000</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="sueldo" id="sueldo2" value="De $5,000 a $7,000"><label for="sueldo2" style="margin-left: 105%">
                <h4 style="margin: 10px">De $5,000 a $7,000</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="sueldo" id="sueldo3" value="De $7,001 a $10,000"><label for="sueldo3" style="margin-left: 105%">
                <h4 style="margin: 10px">De $7,001 a $10,000</h4>
                </label>
            </div>    
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="sueldo" id="sueldo4" value="De $10,001 a $15,000"><label for="sueldo4" style="margin-left: 105%">
                <h4 style="margin: 10px">De $10,001 a $15,000</h4>
                </label>
            </div>
           
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="sueldo" id="sueldo5" value="Mas de $15,000"><label for="sueldo5" style="margin-left: 105%">
                <h4 style="margin: 10px">Más de $15,000</h4>
                </label>
            </div>
           
        </div>
        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
            <input type="button" name="next" class="next action-button" value="Aceptar" />
    </fieldset> 
    

    <fieldset>
    <h2 class="fs-title">¿Cuál es tu ocupación?</h2>
    <h3 class="fs-subtitle"></h3>
        <select type="select" id="ocupacion" name="ocupacion" required>
            <option value="">ELIGE UNA OPCIÓN</option>
            <option value="Trabajo por cuenta Propia">Trabajo por cuenta Propia</option>
            <option value="Jubilado Pensionado">Jubilado Pensionado</option>
            <option value="Dueño de Negocio">Dueño de Negocio</option>
            <option value="Empleado">Empleado</option>
            <option value="Ama de Casa">Ama de Casa</option>
            <option value="Estudiante">Estudiante</option>
            <option value="Desempleado">Desempleado</option>
            <option value="Otro">Otro</option>
        </select>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" / onclick="usoOcupacion();">
  </fieldset>
    <fieldset class="form-wrapper container">
            <div id="uso_ocupacion" style="display: none">
                <h2 class="fs-title">Continua con la encuesta</h2>
                <h3 class="fs-subtitle"></h3>
                <br>
                <br>
            </div>
            <div id="uso_empleado" style="display: none" onchange="divIndustra()";>
                <h2 class="fs-title">¿Cuál es tu tipo de empleo?</h2>
                <h3 class="fs-subtitle"></h3>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="tipo_empleo" id="tipo_empleo1" value="Sindicalizado"><label for="tipo_empleo1">
                        <h4>Sindicalizado</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="tipo_empleo" id="tipo_empleo2" value="Operativo"><label for="tipo_empleo2">
                        <h4>Operativo</h4>
                        </label>
                    </div>  
                    <div class="four col">
                        <input type="radio" name="tipo_empleo" id="tipo_empleo3" value="Administrativo"><label for="tipo_empleo3">
                        <h4>Administrativo</h4>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="tipo_empleo" id="tipo_empleo4" value="Directivo"><label for="tipo_empleo4">
                        <h4>Directivo</h4>
                        </label>
                    </div>
                </div>
            </div>  
            <div id="uso_industria" style="display: none">
                <h2 class="fs-title">c. ¿En qué industria trabajas?*</h2>
                <h3 class="fs-subtitle"></h3>
                    <select type="select" id="industria_trabajas" name="industria_trabajas" onchange="areaTrabajo();">
                        <option value="">ELIGE UNA OPCIÓN</option>
                        <option value="GOBIERNO">GOBIERNO</option>
                        <option value="SALUD Y BELLEZA">SALUD Y BELLEZA</option>
                        <option value="EDUCACION">EDUCACIÓN</option>
                        <option value="MANUFACTURA">MANUFACTURA</option>
                        <option value="TRANSPORTE Y AUTOMOTRIZ">TRANSPORTE Y AUTOMOTRIZ</option>
                        <option value="SERVICIO Y COMERCIO">SERVICIO Y COMERCIO</option>
                        <option value="SERVICIOS PROFESIONALES">SERVICIOS PROFESIONALES</option>
                        <option value="CAMPO E INDUSTRIAL">CAMPO E INDUSTRIAL</option>
                        <option value="HOSPITALIDAD Y TURISMO">HOSPITALIDAD Y TURISMO</option>
                        <option value="RESTAURANTES">RESTAURANTES</option>
                        <option value="RECREACION Y CULTURA">RECREACIÓN Y CULTURA</option>
                        <option value="TECNOLOGIA Y COMUNICACION">TECNOLOGÍA Y COMUNICACIÓN</option>
                    </select>
                <br>
                <br>
            </div>

    <div id="area_gobierno" style="display: none">
        <h2 class="fs-title">¿En cuál área de Gobierno trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_gobierno" id="area_gobierno1" value="Seguridad Publica"><label for="area_gobierno1">
                <h4>Seguridad Pública</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_gobierno" id="area_gobierno2" value="Fuerzas Armadas"><label for="area_gobierno2">
                <h4>Fuerzas Armadas</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_gobierno" id="area_gobierno3" value="Federal"><label for="area_gobierno3">
                <h4>Federal</h4>
                </label>
            </div>  
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_gobierno" id="area_gobierno4" value="Estatal"><label for="area_gobierno4">
                <h4>Estatal</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_gobierno" id="area_gobierno5" value="Municipal"><label for="area_gobierno5">
                <h4>Municipal</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_gobierno" id="area_gobierno6" value="Otro"><label for="area_gobierno6">
                <h4>Otro</h4>
                </label>
            </div>  
        </div>
        <br>
        <br>
    </div>
    <div id="area_salud" style="display: none">
        <h2 class="fs-title">¿En cuál área de Salud y Belleza trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_salud" id="area_salud1" value="Farmaceutica"><label for="area_salud1">
                <h4>Farmaceutica</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_salud" id="area_salud2" value="Medica"><label for="area_salud2">
                <h4>Medica</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_salud" id="area_salud3" value="Nutricion"><label for="area_salud3">
                <h4>Nutrición</h4>
                </label>
            </div>  
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_salud" id="area_salud4" value="Cuidado Personal"><label for="area_salud4">
                <h4>Cuidado Personal</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_salud" id="area_salud5" value="Belleza"><label for="area_salud5">
                <h4>Belleza</h4>
                </label>
            </div>
            
        </div>
        <br>
        <br>
    </div>
    <div id="area_educacion" style="display: none">
        <h2 class="fs-title">¿En cuál área de Educación trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_educacion" id="area_educacion1" value="Basica"><label for="area_educacion1">
                <h4>Basica</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_educacion" id="area_educacion2" value="Media"><label for="area_educacion2">
                <h4>Media</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_educacion" id="area_educacion3" value="Superior"><label for="area_educacion3">
                <h4>Superior</h4>
                </label>
            </div>  
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_educacion" id="area_educacion4" value="Otro"><label for="area_educacion4">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
    </div>
    <div id="area_manufactura" style="display: none">
        <h2 class="fs-title">¿En cuál área de Manufactura trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_manufactura" id="area_manufactura1" value="Automotriz"><label for="area_manufactura1">
                <h4>Automotriz</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_manufactura" id="area_manufactura2" value="Electronica"><label for="area_manufactura2">
                <h4>Electrónica</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_manufactura" id="area_manufactura3" value="Metal Mecanica"><label for="area_manufactura3">
                <h4>Metal Mecánica</h4>
                </label>
            </div>  
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_manufactura" id="area_manufactura4" value="Textil"><label for="area_manufactura4">
                <h4>Textil</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_manufactura" id="area_manufactura5" value="Otro"><label for="area_manufactura5">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
    </div>

    <div id="area_transporte" style="display: none">
        <h2 class="fs-title">¿En cuál área de Transporte y Automotriz trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_transporte" id="area_transporte1" value="Taxi y Aplicaciones"><label for="area_transporte1">
                <h4>Taxi y Aplicaciones</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_transporte" id="area_transporte2" value="Publico y Privado"><label for="area_transporte2">
                <h4>Público y Privado</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_transporte" id="area_transporte3" value="Mensajeria"><label for="area_transporte3">
                <h4>Mensajería</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_transporte" id="area_transporte4" value="Reparacion y Mantenimiento"><label for="area_transporte4">
                <h4>Reparación y Mantenimiento</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>

    <div id="area_servicio" style="display: none">
        <h2 class="fs-title">¿En cuál área de Servicio y Comercio trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio1" value="Alimentos"><label for="area_servicio1">
                <h4>Alimentos</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio2" value="Bienes Raices"><label for="area_servicio2">
                <h4>Bienes Raices</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio3" value="Seguridad Privada"><label for="area_servicio3">
                <h4>Seguridad Privada</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio4" value="Supermercado y Abarrotes"><label for="area_servicio4">
                <h4>Supermercado y Abarrotes</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio5" value="Departamental y Modas"><label for="area_servicio5">
                <h4>Departamental y Modas</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio6" value="Construccion y Limpieza"><label for="area_servicio6">
                <h4>Construcción y Limpieza</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio7" value="Gasolineria y Gas"><label for="area_servicio7">
                <h4>Gasolinería y Gas</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio8" value="Electronica y Agua"><label for="area_servicio8">
                <h4>Electrónica y Agua</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_servicio" id="area_servicio9" value="Otro"><label for="area_servicio9">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <div id="area_profesionales" style="display: none">
        <h2 class="fs-title">¿En cuál área de Servicios Profesionales trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales1" value="Investigacion y Desarrollo"><label for="area_profesionales1">
                <h4>Investigación y Desarrollo</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales2" value="Publicidad y Mercadotecnia"><label for="area_profesionales2">
                <h4>Publicidad y Mercadotecnia</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales3" value="Consultoria"><label for="area_profesionales3">
                <h4>Consultoría</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales4" value="Contabilidad"><label for="area_profesionales4">
                <h4>Contabilidad</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales5" value="Financieros"><label for="area_profesionales5">
                <h4>Financieros</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales6" value="Legales"><label for="area_profesionales6">
                <h4>Legales</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales7" value="Seguros"><label for="area_profesionales7">
                <h4>Seguros</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_profesionales" id="area_profesionales8" value="Otro"><label for="area_profesionales8">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <div id="area_industrial" style="display: none">
        <h2 class="fs-title">¿En cuál área de Campo e Industrial trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_industrial" id="area_industrial1" value="Agricultura"><label for="area_industrial1">
                <h4>Agricultura</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_industrial" id="area_industrial2" value="Ganaderia"><label for="area_industrial2">
                <h4>Ganadería</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_industrial" id="area_industrial3" value="Pesca"><label for="area_industrial3">
                <h4>Pesca</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_industrial" id="area_industrial4" value="Mineria"><label for="area_industrial4">
                <h4>Minería</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_industrial" id="area_industrial5" value="Petrolera"><label for="area_industrial5">
                <h4>Petrolera</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_industrial" id="area_industrial6" value="Otro"><label for="area_industrial6">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <div id="area_hospital" style="display: none">
        <h2 class="fs-title">¿En cuál área de Hospitalidad y Turismo trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_hospital" id="area_hospital1" value="Viajes"><label for="area_hospital1">
                <h4>Viajes</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_hospital" id="area_hospital2" value="Turismo"><label for="area_hospital2">
                <h4>Turismo</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_hospital" id="area_hospital3" value="Otro"><label for="area_hospital3">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        
        <br>
        <br>
        <br>
    </div>
    <div id="area_restaurante" style="display: none">
        <h2 class="fs-title">¿En cuál área de Restaurantes trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_restaurante" id="area_restaurante1" value="Restaurante"><label for="area_restaurante1">
                <h4>Restaurante</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_restaurante" id="area_restaurante2" value="Bar"><label for="area_restaurante2">
                <h4>Bar</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_restaurante" id="area_restaurante3" value="Cafeteria"><label for="area_restaurante3">
                <h4>Cafetería</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_restaurante" id="area_restaurante4" value="Fonda"><label for="area_restaurante4">
                <h4>Fonda</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_restaurante" id="area_restaurante5" value="Otro"><label for="area_restaurante5">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <div id="area_recreacion" style="display: none">
        <h2 class="fs-title">¿En cuál área de Recreación y Cultura trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_recreacion" id="area_recreacion1" value="Arte y Cultura"><label for="area_recreacion1">
                <h4>Arte y Cultura</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_recreacion" id="area_recreacion2" value="Entretenimiento"><label for="area_recreacion2">
                <h4>Entretenimiento</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_recreacion" id="area_recreacion3" value="Otro"><label for="area_recreacion3">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <div id="area_tecnologia" style="display: none">
        <h2 class="fs-title">¿En cuál área de Tecnología y Comunicación trabajas?</h2>
        <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia1" value="Medios de Comunicacion"><label for="area_tecnologia1">
                <h4>Medios de Comunicación</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia2" value="Desarrollo de Software"><label for="area_tecnologia2">
                <h4>Desarrollo de Software</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia3" value="Reparacion y Soporte"><label for="area_tecnologia3">
                <h4>Reparación y Soporte</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia4" value="Imprenta"><label for="area_tecnologia4">
                <h4>Imprenta</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia5" value="Callcenter"><label for="area_tecnologia5">
                <h4>Callcenter</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia6" value="Telefonia e Internet"><label for="area_tecnologia6">
                <h4>Telefonia e Internet</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia7" value="Editorial"><label for="area_tecnologia7">
                <h4>Editorial</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="area_tecnologia" id="area_tecnologia8" value="Otro"><label for="area_tecnologia8">
                <h4>Otro</h4>
                </label>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>


            <input type="button" name="previous" class="previous action-button" value="Regresar" />
            <input type="button" id="destino_usoC" name="next" class="next action-button" value="Aceptar" />  
    </fieldset>
  

<fieldset class="form-wrapper container">
    <h2 class="fs-title">¿A cuanto asciende tu Ingreso Familiar Mensual?</h2>
    <h3 class="fs-subtitle">En pesos mexicanos MXN</h3>
    <div class="row cf">
            <div class="four col">
                <input type="radio" name="ingreso_familiar" id="ingreso_familiar1" value="Menos de $5,000"><label for="ingreso_familiar1" style="margin-left: 105%">
                <h4 style="margin: 10px">Menos de $5,000</h4>
                </label>
            </div>
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="ingreso_familiar" id="ingreso_familiar2" value="De $5,001 a $7,000"><label for="ingreso_familiar2" style="margin-left: 105%">
                <h4 style="margin: 10px">De $5,001 a $7,000</h4>
                </label>
            </div>    
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="ingreso_familiar" id="ingreso_familiar3" value="De $7,001 a $10,000"><label for="ingreso_familiar3" style="margin-left: 105%">
                <h4 style="margin: 10px">De $7,001 a $10,000</h4>
                </label>
            </div>
           
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="ingreso_familiar" id="ingreso_familiar4" value="De $10,001 a $15,000"><label for="ingreso_familiar4" style="margin-left: 105%">
                <h4 style="margin: 10px">De $10,001 a $15,000</h4>
                </label>
            </div>
           
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="ingreso_familiar" id="ingreso_familiar5" value="Mas de $15,000"><label for="ingreso_familiar5" style="margin-left: 105%">
                <h4 style="margin: 10px">Más de $15,000</h4>
                </label>
            </div>
           
        </div>
        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
</fieldset>
  

<fieldset class="form-wrapper container">
    <h2 class="fs-title">¿Te pagan a través de una institución financiera?</h2>
    <h3 class="fs-subtitle">Es decir, ¿recibes los depósitos de tus ingresos en una cuenta bancaria?</h3>

        <div class="row cf">
            <div class="four col">
                <input type="radio" name="pago" id="pago1" value="SI"><label for="pago1" style="margin-left: 90px;">
                <h4>SI</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="pago" id="pago2" value="NO"><label for="pago2" style="margin-left: 100px;">
                <h4>NO</h4>
                </label>
            </div> 
        </div>

        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
</fieldset>


<fieldset>
    <h2 class="fs-title">¿En qué emplearas el crédito?</h2>
    <h3 class="fs-subtitle"></h3>
        <select type="select" id="destino_credito" name="destino_credito" required>
            <option value="">ELIGE UNA OPCIÓN</option>
            <option value="INVERSION">INVERSIÓN</option>
            <option value="EDUCACION">EDUCACIÓN</option>
            <option value="HOGAR">HOGAR</option>
            <option value="GASTOS PERSONALES">GASTOS PERSONALES</option>
            <option value="AUTOMOVIL">AUTOMOVIL</option>
            <option value="DEUDAS">DEUDAS</option>
            <option value="SALUD">SALUD</option>
        </select>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" / onclick="usoCredito();">
  </fieldset>
    <fieldset class="form-wrapper container">
            <div id="uso_inversion" style="display: none">
                <h2 class="fs-title">Continua con la ultima parte de la encuesta</h2>
                <h3 class="fs-subtitle"></h3>
                <br>
                <br>
            </div>
            <div id="uso_educacion" style="display: none">
                <h2 class="fs-title">¿En qué tipo de gasto de Educación emplearás el crédito?</h2>
                <h3 class="fs-subtitle"></h3>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_educacion" id="uso_educacion1" value="Educacion Basica"><label for="uso_educacion1">
                        <h4>Educación Basica</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_educacion" id="uso_educacion2" value="Estudios Universitarios"><label for="uso_educacion2">
                        <h4>Estudios Universitarios</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_educacion" id="uso_educacion3" value="Cursos Complementarios"><label for="uso_educacion3">
                        <h4>Cursos Complementarios</h4>
                        </label>
                    </div>  
                </div>
                <br>
                <br>
            </div>
            <div id="uso_hogar" style="display: none">
                <h2 class="fs-title">¿En qué tipo de gasto del Hogar emplearás el crédito?</h2>
                <h3 class="fs-subtitle"></h3>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_hogar" id="uso_hogar1" value="Alimentos"><label for="uso_hogar1">
                        <h4>Alimentos</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_hogar" id="uso_hogar2" value="Servicios"><label for="uso_hogar2">
                        <h4>Servicios</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_hogar" id="uso_hogar3" value="Renta"><label for="uso_hogar3">
                        <h4>Renta</h4>
                        </label>
                    </div>  
                </div>
                <br>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_hogar" id="uso_hogar4" value="Construccion"><label for="uso_hogar4">
                        <h4>Construcción</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_hogar" id="uso_hogar5" value="Electrodomesticos"><label for="uso_hogar5">
                        <h4>Electrodomesticos</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_hogar" id="uso_hogar6" value="Decoracion"><label for="uso_hogar6">
                        <h4>Decoración</h4>
                        </label>
                    </div>
                    
                </div>
                <br>
                <br>
            </div>
            <div id="uso_gastos" style="display: none">
                <h2 class="fs-title">¿En qué tipo de Gastos Personales emplearás el crédito?</h2>
                <h3 class="fs-subtitle"></h3>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_gastos" id="uso_gastos1" value="Regalos"><label for="uso_gastos1">
                        <h4>Regalos</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_gastos" id="uso_gastos2" value="Viajes"><label for="uso_gastos2">
                        <h4>Viajes</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_gastos" id="uso_gastos3" value="Celebraciones"><label for="uso_gastos3">
                        <h4>Celebraciones</h4>
                        </label>
                    </div>  
                </div>
                <br>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_gastos" id="uso_gastos4" value="Transporte"><label for="uso_gastos4">
                        <h4>Transporte</h4>
                        </label>
                    </div>
                </div>
                <br>
                <br>
            </div>
            <div id="uso_automovil" style="display: none">
                <h2 class="fs-title">¿En qué tipo de Gasto del Automóvil emplearás el crédito?</h2>
                <h3 class="fs-subtitle"></h3>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_automovil" id="uso_automovil1" value="Seguro"><label for="uso_automovil1">
                        <h4>Seguro</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_automovil" id="uso_automovil2" value="Tramite"><label for="uso_automovil2">
                        <h4>Tramite</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_automovil" id="uso_automovil3" value="Servicios"><label for="uso_automovil3">
                        <h4>Servicios</h4>
                        </label>
                    </div>  
                </div>
                <br>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_automovil" id="uso_automovil4" value="Refaccion o Reparacion"><label for="uso_automovil4">
                        <h4>Refacción o Reparación</h4>
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
            <div id="uso_deudas" style="display: none">
                <h2 class="fs-title">¿Para qué tipo de Deudas emplearás el crédito?</h2>
                <h3 class="fs-subtitle"></h3>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_deudas" id="uso_deudas1" value="Atrasadas"><label for="uso_deudas1">
                        <h4>Atrasadas</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_deudas" id="uso_deudas2" value="Proximas a Vencer"><label for="uso_deudas2">
                        <h4>Próximas a Vencer</h4>
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
            <div id="uso_salud" style="display: none">
                <h2 class="fs-title">¿En qué tipo de gastos de Salud emplearás el crédito?</h2>
                <h3 class="fs-subtitle"></h3>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_salud" id="uso_salud1" value="Consulta Medica"><label for="uso_salud1">
                        <h4>Consulta Médica</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_salud" id="uso_salud2" value="Medicamentos"><label for="uso_salud2">
                        <h4>Medicamentos</h4>
                        </label>
                    </div>
                    <div class="four col">
                        <input type="radio" name="uso_salud" id="uso_salud3" value="Servicio Medico"><label for="uso_salud3">
                        <h4>Servicio Médico</h4>
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <div class="row cf">
                    <div class="four col">
                        <input type="radio" name="uso_salud" id="uso_salud4" value="Servicios Hospitalarios"><label for="uso_salud4">
                        <h4>Servicios Hospitalarios</h4>
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
            <input type="button" name="previous" class="previous action-button" value="Regresar" />
            <input type="button" id="destino_usoC" name="next" class="next action-button" value="Aceptar" />  
    </fieldset>

    <fieldset class="form-wrapper container">
    <h2 class="fs-title">¿Tienes o tuviste una tarjeta de crédito en los últimos dos años?</h2>
    <h3 class="fs-subtitle"></h3>

        <div class="row cf">
            <div class="four col">
                <input type="radio" name="tarjeta_c" id="tarjeta_c1" value="SI"><label for="tarjeta_c1" style="margin-left: 90px;">
                <h4>SI</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="tarjeta_c" id="tarjeta_c2" value="NO"><label for="tarjeta_c2" style="margin-left: 100px;">
                <h4>NO</h4>
                </label>
            </div> 
        </div>

        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
    </fieldset>
    <fieldset class="form-wrapper container">
    <h2 class="fs-title">¿En los últimos dos años has tenido un crédito automotriz?</h2>
    <h3 class="fs-subtitle"></h3>

        <div class="row cf">
            <div class="four col">
                <input type="radio" name="credito_auto" id="credito_auto1" value="SI"><label for="credito_auto1" style="margin-left: 90px;">
                <h4>SI</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="credito_auto" id="credito_auto2" value="NO"><label for="credito_auto2" style="margin-left: 100px;">
                <h4>NO</h4>
                </label>
            </div> 
        </div>

        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
    </fieldset>
    <fieldset class="form-wrapper container">
    <h2 class="fs-title">¿Tienes o tuviste un crédito para comprar una casa?</h2>
    <h3 class="fs-subtitle"></h3>

        <div class="row cf">
            <div class="four col">
                <input type="radio" name="credito_casa" id="credito_casa1" value="SI"><label for="credito_casa1" style="margin-left: 90px;">
                <h4>SI</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="credito_casa" id="credito_casa2" value="NO"><label for="credito_casa2" style="margin-left: 100px;">
                <h4>NO</h4>
                </label>
            </div> 
        </div>
        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
    </fieldset>

    <fieldset class="form-wrapper container">
    <h2 class="fs-title">¿Cómo consideras tu historial de crédito?</h2>
    <h3 class="fs-subtitle"></h3>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="historial" id="historial1" value="Bueno"><label for="historial1">
                <h4>Bueno</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="historial" id="historial2" value="Regular"><label for="historial2">
                <h4>Regular</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="historial" id="historial3" value="Malo"><label for="historial3">
                <h4>Malo</h4>
                </label>
            </div>  
        </div>
        <br>
        <div class="row cf">
            <div class="four col">
                <input type="radio" name="historial" id="historial4" value="No se"><label for="historial4">
                <h4>No sé</h4>
                </label>
            </div>
            <div class="four col">
                <input type="radio" name="historial" id="historial5" value="No tengo historial"><label for="historial5">
                <h4>No tengo historial</h4>
                </label>
            </div> 
        </div>
        <br>
        <br>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
            <input type="submit" name="next" class="action-button" value="Enviar" />
    </fieldset>

    

   
</form>
@endif
</body>

<script>
    
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

function areaTrabajo(){
    var industria = document.getElementById("industria_trabajas").value;
    if(industria == "GOBIERNO"){
        $('#area_gobierno').css('display','block');
        $('#area_salud').css('display', 'none');
        $('#area_educacion').css('display', 'none');
        $('#area_manufactura').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');

    }else if(industria == "SALUD Y BELLEZA"){
        $('#area_salud').css('display', 'block');
        $('#area_educacion').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



    }else if(industria == "EDUCACION"){
        $('#area_educacion').css('display','block');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



        
    }else if(industria == "MANUFACTURA"){
        $('#area_manufactura').css('display','block');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



    
    }else if(industria == "TRANSPORTE Y AUTOMOTRIZ"){
        $('#area_transporte').css('display','block');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');





    }else if(industria == "SERVICIO Y COMERCIO"){
        $('#area_servicio').css('display','block');
        $('#area_transporte').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



        
    }else if(industria == "SERVICIOS PROFESIONALES"){
        $('#area_profesionales').css('display','block');
        $('#area_servicio').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



        
    }else if(industria == "CAMPO E INDUSTRIAL"){
        $('#area_industrial').css('display','block');
        $('#area_profesionales').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



    
    }else if(industria == "HOSPITALIDAD Y TURISMO"){
        $('#area_hospital').css('display','block');
        $('#area_industrial').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



        
    }else if(industria == "RESTAURANTES"){
        $('#area_restaurante').css('display','block');
        $('#area_industrial').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');



        
    }else if(industria == "RECREACION Y CULTURA"){
        $('#area_recreacion').css('display','block');
        $('#area_restaurante').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_tecnologia').css('display','none');



        
    }else if(industria == "TECNOLOGIA Y COMUNICACION"){
        $('#area_tecnologia').css('display','block');
        $('#area_recreacion').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_gobierno').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_hospital').css('display','none');

        
    }else{
        $('#area_tecnologia').css('display','none');
        $('#area_gobierno').css('display','none');
        $('#area_salud').css('display', 'none');
        $('#area_educacion').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_recreacion').css('display','none');





    }

}

function divIndustra(){
    $('#uso_empleado').css('display','none');
    $('#uso_industria').css('display','block');
}


function usoCredito(){
    var destino = document.getElementById("destino_credito").value;

    if(destino == "INVERSION"){
        // document.getElementById("uso_inversion").style.display="block";
        // $('.next').click();
        // $(".next").click();
        // $("#next").click();

        $('#uso_inversion').css('display','block');
        $('#uso_educacion').css('display','none');
        $('#uso_hogar').css('display','none');
        $('#uso_gastos').css('display','none');
        $('#uso_automovil').css('display','none');
        $('#uso_deudas').css('display','none');
        $('#uso_salud').css('display','none');

        
    }else if(destino == "EDUCACION"){

        $('#uso_educacion').css('display','block');
        $('#uso_hogar').css('display','none');
        $('#uso_gastos').css('display','none');
        $('#uso_automovil').css('display','none');
        $('#uso_deudas').css('display','none');
        $('#uso_salud').css('display','none');
        $('#uso_inversion').css('display','none');



    }else if(destino == "HOGAR"){;
        // document.getElementById("uso_inversion").style.display="block";

        $('#uso_hogar').css('display', 'block');
        $('#uso_educacion').css('display','none');
        $('#uso_gastos').css('display','none');
        $('#uso_automovil').css('display','none');
        $('#uso_deudas').css('display','none');
        $('#uso_salud').css('display','none');
        $('#uso_inversion').css('display','none');



    }else if(destino == "GASTOS PERSONALES"){
        // document.getElementById("uso_inversion").style.display="block";

        $('#uso_gastos').css('display','block');
        $('#uso_educacion').css('display','none');
        $('#uso_hogar').css('display','none');
        $('#uso_automovil').css('display','none');
        $('#uso_deudas').css('display','none');
        $('#uso_salud').css('display','none');
        $('#uso_inversion').css('display','none');


        
    }else if(destino == "AUTOMOVIL"){
        // document.getElementById("uso_inversion").style.display="block";

        $('#uso_automovil').css('display','block');
        $('#uso_educacion').css('display','none');
        $('#uso_hogar').css('display','none');
        $('#uso_gastos').css('display','none');
        $('#uso_deudas').css('display','none');
        $('#uso_salud').css('display','none');
        $('#uso_inversion').css('display','none');




    }else if(destino == "DEUDAS"){

        $('#uso_deudas').css('display','block');
        $('#uso_automovil').css('display','none');
        $('#uso_educacion').css('display','none');
        $('#uso_hogar').css('display','none');
        $('#uso_gastos').css('display','none');
        $('#uso_salud').css('display','none');
        $('#uso_inversion').css('display','none');



       
    }else if(destino == "SALUD"){

        $('#uso_salud').css('display','block');
        $('#uso_automovil').css('display','none');
        $('#uso_educacion').css('display','none');
        $('#uso_hogar').css('display','none');
        $('#uso_gastos').css('display','none');
        $('#uso_deudas').css('display','none');
        $('#uso_inversion').css('display','none');


    }else{        
        $('#uso_educacion').css('display','none');
        $('#uso_hogar').css('display','none');
        $('#uso_gastos').css('display','none');
        $('#uso_automovil').css('display','none');
        $('#uso_salud').css('display','none');
        $('#uso_deudas').css('display','none');
        $('#uso_inversion').css('display','none');


       
    }

}

function usoOcupacion(){
    var ocupacion = document.getElementById("ocupacion").value;

    if(ocupacion == "Empleado"){

        $('#uso_empleado').css('display','block');
        $('#uso_ocupacion').css('display','none');
        $('#uso_industria').css('display','none');

    }else if(ocupacion == "Ama de Casa" || ocupacion == "Estudiante" || ocupacion == "Jubilado Pensionado" || ocupacion == "Desempleado" || ocupacion == "Otro"){

        $('#uso_ocupacion').css('display','block');
        $('#uso_empleado').css('display','none');
        $('#uso_industria').css('display','none');
        
        $('#area_gobierno').css('display','none');
        $('#area_salud').css('display','none');
        $('#area_educacion').css('display','none');
        $('#area_manufactura').css('display','none');
        $('#area_transporte').css('display','none');
        $('#area_servicio').css('display','none');
        $('#area_profesionales').css('display','none');
        $('#area_industrial').css('display','none');
        $('#area_hospital').css('display','none');
        $('#area_restaurante').css('display','none');
        $('#area_recreacion').css('display','none');
        $('#area_tecnologia').css('display','none');
        $('#area_salud').css('display','none');
        ///agreegar los que falra
    }else if(ocupacion == "Trabajo por cuenta Propia" || ocupacion == "Dueño de Negocio"){
        $('#uso_industria').css('display','block');
        $('#uso_empleado').css('display','none');
        $('#uso_ocupacion').css('display','none');
    }else{        
        
        $('#uso_empleado').css('display','none');
        $('#uso_ocupacion').css('display','none');
        $('#uso_industria').css('display','none');


       
    }

}

function tipoEmpleado(){
    // var ocupacion = document.getElementById("ocupacion4").value;
    var checkbox = document.getElementById('ocupacion4');
    var checked = checkbox.checked;
    if(checked){
        $('#tipo_empleado').css('display','block');
        $('#div_ocupacion').css('display','none');
        // document.getElementById('next').className='next action-button'; 


    }else{
        $('#tipo_empleado').css('display','none');
        $('#div_ocupacion').css('display','block');
        document.getElementById('next').className='next action-button'; 
    }
   
}
        
    function calcularEdad(){
        
        var fecha=document.getElementById("fecha_nacimiento").value;
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];
        fecha=	dia+"/"+mes	+"/"+ano;
        var values=fecha.split("/");
		var dia = values[0];
        var mes = values[1];
        var ano = values[2];
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth();
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
 
        if ( ahora_mes < (mes - 1)){
            edad--;
        }
        if (((mes - 1) == ahora_mes) && (ahora_dia < dia)){
            edad--;
        }
        if (edad > 1900){
            edad -= 1900;
        }
        $('#edad').val(edad);

        // if(edad == 0 && edad <=17){
        //     $('#edad').val('-99');

        // }
    }


</script>