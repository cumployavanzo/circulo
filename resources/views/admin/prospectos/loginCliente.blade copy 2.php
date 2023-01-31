<head>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'>
</script>
</head>
<style>
    /*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {margin: 0; padding: 0;}

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
	width: 140%;
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
	width: 13.33%;
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 20px;
	line-height: 20px;
	display: block;
	font-size: 10px;
	color: #333;
	background: white;
	border-radius: 3px;
	margin: 0 auto 5px auto;
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
  border-bottom: 1px solid #3498db;
  color: #3498db;
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
  background-color: #3498db;
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
  padding: 10px;
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
  background-color: #3498db;
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
  border: 1px solid #3498db;
}

.form-wrapper input[type="radio"]:checked + label h4{
  color: #3498db;
}

</style>
<!-- multistep form -->

<form id="msform" method="POST" action="#" data-action="{{ route('listadoEncuestas') }}" enctype="multipart/form-data"  autocomplete="off">
@csrf
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Account Setup</li>
    <li>Social Profiles</li>
    <li>Personal Details</li>
    <li>Personal Details</li>
    <li>Personal Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">1.- ¿Cuánto dinero necesitas?</h2>
    <h3 class="fs-subtitle">Por favor escribe cualquier monto en pesos de 1,000 a 3,000</h3>
        <input type="text" name="dinero" placeholder="" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">2.- ¿A qué plazo?</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="input" name="plazo" class="" value="30 DIAS"  readonly/>
        <input type="input" name="plazo" class="" value="60 DIAS" readonly />
        <input type="input" name="plazo" class="" value="90 DIAS" readonly  />
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">3.- ¿Cuál es tu nombre completo?</h2>
    <h3 class="fs-subtitle">Por favor escribe todos tus nombres y apellidos como vienen en tu INE</h3>
        <input type="text" name="nombre" placeholder="Nombres" />
        <input type="text" name="primer_apellido" placeholder="Primer Apellido" />
        <input type="text" name="segundo_apellido" placeholder="Segundo Apellido" />
        <!-- <textarea name="address" placeholder="Address"></textarea> -->
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />

        <!-- <a href="https://twitter.com/GoktepeAtakan" class="submit action-button" target="_top">Submit</a> -->
  </fieldset>
  <div class="form-wrapper container">
       
        <fieldset class="section is-active"">
          <h3>Account Type</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="r1" id="r1" checked>
              <label for="r1">
                <h4>Designer</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r1" id="r2"><label for="r2">
                <h4>Developer</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r1" id="r3"><label for="r3">
                <h4>Project Manager</h4>
              </label>
            </div>
          </div>
          <div class="button">Next</div>
        </fieldset>
        
        </div>
  <!-- <fieldset>
    <h2 class="fs-title">4.- ¿Cuál es tu género?</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="input" name="genero" class="" value="Femenino" readonly />
        <input type="input" name="genero" class="" value="Masculino" readonly />
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">5.- Por favor escribe tu fecha de nacimiento</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="date" name="fecha_nacimiento" class=""/>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
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
            <option value="EXTRANJERO">EXTRANJERO</option>
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
  <fieldset>
    <h2 class="fs-title">a. ¿Cuál es tu sueldo mensual?</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="input" name="sueldo" class="" value="Menos de $5,000" readonly />
        <input type="input" name="sueldo" class="" value="De $5,000 a $7,000" readonly />
        <input type="input" name="sueldo" class="" value="De $7,001 a $10,000" readonly />
        <input type="input" name="sueldo" class="" value="De $10,001 a $15,000" readonly />
        <input type="input" name="sueldo" class="" value="Más de $15,000" readonly />
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">b. ¿Cuál es tu ocupación?</h2>
    <h3 class="fs-subtitle"></h3>
        <input type="input" name="ocupacion" class="" value="Dueño de negocio" readonly />
        <input type="input" name="ocupacion" class="" value="Trabajo por cuenta propia" readonly />
        <input type="input" name="ocupacion" class="" value="Empleado" readonly />
        <input type="input" name="ocupacion" class="" value="Ama de casa" readonly />
        <input type="input" name="ocupacion" class="" value="Jubilado pensionado" readonly />
        <input type="input" name="ocupacion" class="" value="Estudiante" readonly />
        <input type="input" name="ocupacion" class="" value="Desempleado" readonly />
        <input type="input" name="ocupacion" class="" value="Otro" readonly />
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset>

  <fieldset>
    <h2 class="fs-title">c. ¿En qué industria trabajas?*</h2>
    <h3 class="fs-subtitle"></h3>
        <select type="select" id="industria_trabajas" name="industria_trabajas" required onchange="areaTrabajo();">
            <option value="">ELIGE UNA OPCIÓN</option>
            <option value="GOBIERNO">GOBIERNO</option>
            <option value="SALUD Y BELLEZA">SALUD Y BELLEZA</option>
            <option value="EDUCACION">EDUCACION</option>
            <option value="MANUFACTURA">MANUFACTURA</option>
            <option value="TRANSPORTE Y AUTOMOTRIZ">TRANSPORTE Y AUTOMOTRIZ</option>
            <option value="SERVICIO Y COMERCIO">SERVICIO Y COMERCIO</option>
            <option value="SERVICIOS PROFESIONALES">SERVICIOS PROFESIONALES</option>
            <option value="CAMPO E INDUSTRIAL">CAMPO E INDUSTRIAL</option>
            <option value="HOSPITALIDAD Y TURISMO">HOSPITALIDAD Y TURISMO</option>
            <option value="RESTAURANTES">RESTAURANTES</option>
            <option value="RECREACIÓN Y CULTURA">RECREACIÓN Y CULTURA</option>
            <option value="TECNOLOGÍA Y COMUNICACIÓN">TECNOLOGIA Y COMUNICACIÓN</option>
        </select>
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="button" name="next" class="next action-button" value="Aceptar" />
  </fieldset> -->

  <fieldset>

    <h2 class="fs-title">¿En cuál área de Gobierno trabajas?</h2>
    <h3 class="fs-subtitle"></h3>
         <!-- <div class="form-list__input-inline">
            <input type="text" name="ocupacion" class="" value="Gobierno" readonly />
            <input type="text" name="ocupacion" class="" value="Salud y Belleza" readonly />
            <input type="text" name="ocupacion" class="" value="Educación" readonly />

        </div>
       -->
       <div class="div">
            <input type="text" name="area_gobierno" value="Seguridad Publica" readonly />
            <input type="text" name="area_gobierno" value="Fuerzas Armadas" readonly />
            <input type="text" name="area_gobierno" value="Federal" readonly />
            <input type="text" name="area_gobierno" value="Estatal" readonly />
            <input type="text" name="area_gobierno" value="Municipal" readonly />
            <input type="text" name="area_gobierno" value="Otro" readonly />
       </div>
        
        
        <input type="button" name="previous" class="previous action-button" value="Regresar" />
        <input type="submit" name="" class=" action-button" value="Aceptar" />
  </fieldset>


</form>

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

    alert(industria);

}

</script>