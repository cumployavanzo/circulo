<?php

namespace App\CirculoCredito\FintechScore\Simulacion\Model;

interface ModelInterface
{
    
    public function getModelName();
    
    public static function RCCPMTypes();
    
    public static function RCCPMFormats();
    
    public static function attributeMap();
    
    public static function setters();
    
    public static function getters();
    
    public function listInvalidProperties();
    
    public function valid();
}
