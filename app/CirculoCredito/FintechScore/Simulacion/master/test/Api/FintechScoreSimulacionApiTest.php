<?php

namespace FintechScoreSimulacion\Client;

use \FintechScoreSimulacion\Client\Configuration;
use \FintechScoreSimulacion\Client\ApiException;
use \FintechScoreSimulacion\Client\ObjectSerializer;
use \FintechScoreSimulacion\Client\Model\Peticion;
use \FintechScoreSimulacion\Client\Model\PeticionFolio;
use \FintechScoreSimulacion\Client\Model\Persona;
use \FintechScoreSimulacion\Client\Model\Domicilio;
use \FintechScoreSimulacion\Client\Api\FintechScoreSimulacionApi as Instance;
use \GuzzleHttp\Client;


class FintechScoreSimulacionApiTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $config = new Configuration();
        $config->setHost('url');
        $this->x_api_key = "your-apikey";
        $client = new Client();
        $this->apiInstance = new Instance($client,$config);
    }
    
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
}




