<?php
namespace App\Utils;

use Exception;

class Util {
    
    /** 
    * Funcion que permite personalizar el mensaje de validacion y personalizarlo siempre y cuando se utlize el bloque try catch 
    * @param $error , hace referencia a el error capturado por un catch, dentro de un bloque try catch.
    * @return  $custom_message , hace referencia a el mensaje personalalizado que devolvera el api o endpoint.
    */
    public static function throwExceptionMessage(Exception $error):string{
       
        /// Veriifcamos si estamos en entorno local
        $enviroment = env('APP_ENV');
        if($enviroment === "local"){
            return $error->getMessage();
        }

        /// Modificamos el error
        $wordMessage="Error : ";
        $message = $error->getMessage();
        if (strpos($message,  $wordMessage) !== false) {
         /// Si entra en esta condicion es por que el error si contiene la palabra Error :
         $custome_message =str_replace( $wordMessage, "", $message);
         return $custome_message;
        }else{
            /// Si entra en esta condicion es por que es un error interno por lo cual se
            /// respondera con un mensaje generico
            return "Error interno en el servidor";
        }
    }

}