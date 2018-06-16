<?php

namespace AppBundle\Lib;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use AppBundle\Model\ParametroConfiguracionQuery;

/**
 * Description of Utiles
 *
 * @author Luis Arcos
 */
class Utiles {
    
    public static function setLog($type = '', $archivo = 'web') {
        $logFechaNombre = $archivo . "_" . date("Ymd") . ".log";
        $logPath = __DIR__ . '/../../../app/logs/' . $logFechaNombre;

        $log = new Logger($type);
        $handler = new StreamHandler($logPath, Logger::DEBUG);
        $handler->setFormatter(new LineFormatter(null, null, true, true));

        $log->pushHandler($handler);
        return $log;
    }
    
    /**
     * Retorna un objeto DateTime si se puede crear con el string pasado,
     * FALSE de lo contrario
     * 
     * @param string $strDate
     * @return \DateTime|boolean
     */
    public static function getDateTimeObject($strDate) {
        try {
            $dateTimeObject =  new \DateTime($strDate);
        } 
        catch (\Exception $exc) {
            return FALSE;
        }
        return $dateTimeObject;
            
    }
    
    // --------------------------------------------------------- 
    // ----- object_to_array_recusive --- function (PHP) ------ 
    // -------------------------------------------------------- 
    // -- arg1:  $object  =  (PHP Object with Children) 
    // -- arg2:  $assoc   =  (TRUE / FALSE) - optional 
    // -- arg3:  $empty   =  ('' or NULL) - optional 
    // -------------------------------------------------------- 
    // ----- return: Array from Object --- (associative) ------ 
    // -------------------------------------------------------- 

    public static function object_to_array_recusive($object, $assoc = 1, $empty = '') {
            $out_arr = array();
            $assoc = (!empty($assoc)) ? TRUE : FALSE;

            if (!empty($object)) {

                $arrObj = is_object($object) ? get_object_vars($object) : $object;

                $i = 0;
                foreach ($arrObj as $key => $val) {
                    $akey = ($assoc !== FALSE) ? $key : $i;
                    if (is_array($val) || is_object($val)) {
                        $out_arr[$key] = (empty($val)) ? $empty : self::object_to_array_recusive($val);
                    } else {
                        $out_arr[$key] = (empty($val)) ? $empty : (string) $val;
                    }
                    $i++;
                }
            }

            return $out_arr;
        }

    // -------------------------------------------------------- 
    // -------------------------------------------------------- 
        
    public static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
    
    public static function getParametroConfiguracion($nombre) {

        $str_valor = '';

        $parametro = ParametroConfiguracionQuery::create()->findOneByPcoNombre($nombre);
        if ($parametro)
            $str_valor = $parametro->getPcoValor ();

        return $str_valor;
    }
    
    public static function upload_image_url($image_url, $image_destination){
       $bandera = false;
       $username = 'admin';
        $password = 'admin';

        $context = stream_context_create(array(
            'http' => array(
                'header'  => "Authorization: Basic " . base64_encode("$username:$password")
            )
        ));
        if ($l = fopen($image_destination, 'w')){
            if (fwrite($l, file_get_contents($image_url,false,$context))){
                fclose($l);
                //chmod($l, 0777);
                $bandera = true;
            }
            else
                $bandera = false;
        }
        else
            $bandera = false;
        
        return $bandera;
    }

    /**
     * Retorna la ruta hasta 'entelfutbolclub/www/sf2/web'
     * 
     * @return String
     */
    public static function getWebRoot() {
        return $pathRoot =  __DIR__.'/../../../web';
    }
    
    /**
     * retorna un array con mime types de tipo imagen
     * 
     * @return array
     */
    public static function getMimeTypesImagenes() {
        return array('image/png','image/jpg','image/jpeg','image/gif');
    }
    
    public static function comprobarSeccionActiva(){
        if($this->container->get('session')->get('usuarioObjeto') != null){
             return $this->redirect($this->generateUrl('clinica_homepage'));
        }
    }
    
}
