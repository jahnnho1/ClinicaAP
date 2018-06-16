<?php

namespace AppBundle\Model;

use AppBundle\Model\om\BaseComentario;

class Comentario extends BaseComentario
{
    const eliminado_true = 1;
    const eliminado_false = 0;
    
    const estado_activo = 0;
    const estado_inactivo = 1;
    
     public function recuperarImagenUsuarioPadre() {
        $recurso = RecursoQuery::create()->filterByRecEliminado(Recurso::recurso_eliminado_false)->filterByUpaId($this->getBloId())->findOne();
        if ($recurso != null) {
            $src = $recurso->getRecSrc();
            return $src;
        } else {
            Return 'backend/img/user-generic-white.png';
        }
    }
   




    
      public function mostrarFechaTime() {
        
        $str = '';
        $tiempo = '';
        
        $date1 = new \DateTime(date('Y-m-d H:i:s'));
        $date2 = new \DateTime($this->getCreatedAt('Y-m-d H:i:s'));        
        
        $diff = $date2->diff($date1);
        if ($diff->m >= 1) {
            $tiempo = $diff->m;
            $str = 'mes';
            if ($diff->m >= 2)
                $str = 'meses';
        }
        else
        if ($diff->d >= 1) {
            $tiempo = $diff->d;
            $str = 'día';
            if ($diff->d >= 2)
                $str = 'días';
        }
        else
        if ($diff->h >= 1) {
            $tiempo = $diff->h;
            $str = 'hora';
            if ($diff->h >= 2)
                $str = 'horas';
        }
        else
        if ($diff->i >= 1) {
            $tiempo = $diff->i;
            $str = 'minuto';
            if ($diff->i >= 2)
                $str = 'minutos';
        }
        else
        if ($diff->s >= 0) {
            $tiempo = $diff->s;
            $str = 'segundo';
            if ($diff->s >= 2)
                $str = 'segundos';
        }
        
        return 'hace '.$tiempo.' '.$str;
    }  
    
    

    
}