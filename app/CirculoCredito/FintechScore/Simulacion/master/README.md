# fintechscore-simulacion-client-php

Esta API simula la evaluación de riesgo cubriendo las necesidades de las FinTechs como los son: plazos más cortos que van de 1 día hasta 3 meses en promedio, montos de $3.5K promedio, renovaciones con mayor frecuencia, mayores tasas de interés y disponibilidad inmediata. <br/><img src='https://github.com/APIHub-CdC/imagenes-cdc/blob/master/circulo_de_credito-apihub.png' height='37' width='160'/><br/>

## Requisitos

PHP 7.1 ó superior

### Dependencias adicionales

- Se debe contar con las siguientes dependencias de PHP:
  - ext-curl
  - ext-mbstring
- En caso de no ser así, para linux use los siguientes comandos

```sh
#ejemplo con php en versión 7.3 para otra versión colocar php{version}-curl
apt-get install php7.3-curl
apt-get install php7.3-mbstring
```

- Composer [vea como instalar][1]

## Instalación

Ejecutar: `composer install`

## Guía de inicio

### Paso 1. Agregar el producto a la aplicación

Al iniciar sesión seguir los siguientes pasos:

1.  Dar clic en la sección "**Mis aplicaciones**".
2.  Seleccionar la aplicación.
3.  Ir a la pestaña de "**Editar '@tuApp**' ".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/edit_applications.jpg" width="900">
    </p>
4.  Al abrirse la ventana emergente, seleccionar el producto.
5.  Dar clic en el botón "**Guardar App**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/selected_product.jpg" width="400">
    </p>

### Paso 2. Capturar los datos de la petición

Los siguientes datos a modificar se encuentran en **test/Api/FintechScoreSimulacionApiTest.php**

Es importante contar con el setUp() que se encargará de inicializar la petición. Por tanto, se debe modificar la URL (**the_url**); y la API KEY (**your_x_api_key**), como se muestra en el siguiente fragmento de código:

```php
$config = new Configuration();
        $config->setHost('url');
        $this->x_api_key = "your-apikey";
        $client = new Client();
        $this->apiInstance = new Instance($client,$config);
```

Para la petición se deberá modificar el siguiente fragmento de código con los datos correspondientes:

> **NOTA:** Para más ejemplos de simulación, consulte la colección de Postman.

```php
/**
* Este método será ejecutado en la prueba ubicado en path/to/repository/test/Api/FintechScoreSimulacionApiTest.php
*/
public function testGetReporte()
{
     try{
                $request = new Peticion();
                $persona = new Persona();
                $domicilio = new Domicilio();

                $request->setFolioOtorgante("20210304");

                $persona->setApellidoPaterno("SESENTAYDOS");
                $persona->setApellidoMaterno("PRUEBA");
                $persona->setPrimerNombre("JUAN");
                $persona->setSegundoNombre("JUAN");
                $persona->setFechaNacimiento("1965-08-09");
                $persona->setRFC("SEPJ650809JG1");
                
                $domicilio->setDireccion("PASADISO ENCONTRADO 58");
                $domicilio->setColoniaPoblacion("MONTEVIDEO");
                $domicilio->setDelegacionMunicipio("GUSTAVO A MADERO");
                $domicilio->setCiudad("CIUDAD DE MÉXICO");
                $domicilio->setEstado("CDMX");
                $domicilio->setCP("07730");
                $domicilio->setPais("MX");
            
                $persona->setDomicilio($domicilio);
                $request->setPersona($persona);
                $response = $this->apiInstance->getReporte($this->x_api_key, $request);
                $this->assertNotNull($response );
                print_r($response);

        }
 
        catch(Exception $e){
            echo 'Exception when calling ApiTest->testGetReporte: ', $e->getMessage(), PHP_EOL;
        }
      
}

/**
*Metodo con folios del solicitante
* Este método será ejecutado en la prueba ubicado en path/to/repository/test/Api/FintechScoreSimulacionApiTest.php
*/
    public function testGetReporteFolio()
    {
     try{
                $request = new PeticionFolio();
                $request->setFolioOtorgante("20210301");
                $request->setFolioConsulta("12345678");
                $response = $this->apiInstance->getReporteFolio($this->x_api_key, $request);
                $this->assertNotNull($response );
                print_r($response);
        }
            catch(Exception $e){
                echo 'Exception when calling ApiTest->testGetReporteFolio: ', $e->getMessage(), PHP_EOL;
            }
    }
```

## Pruebas unitarias

Para ejecutar las pruebas unitarias:

```sh
./vendor/bin/phpunit
```

---
[CONDICIONES DE USO, REPRODUCCIÓN Y DISTRIBUCIÓN](https://github.com/APIHub-CdC/licencias-cdc)

[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
