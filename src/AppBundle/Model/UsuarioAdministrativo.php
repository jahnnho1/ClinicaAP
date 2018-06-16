<?php

namespace AppBundle\Model;

use AppBundle\Model\om\BaseUsuarioAdministrativo;

class UsuarioAdministrativo extends BaseUsuarioAdministrativo
{
    const usuario_tipo_profesional = 3;
    const usuario_tipo_administrativo = 2;
    const usuario_tipo_normal = 1;
    
    const usuario_estado_activo = 0;
    const usuario_estado_inactivo = 1;
    
    const usuario_eliminado_false = 0;
    const usuario_eliminado_true = 1;
    
    
    public function recuperarImagen() {
        $recurso = RecursoQuery::create()->filterByRecEliminado(Recurso::recurso_eliminado_false)->findOneByUpaId($this->getUsuId());
        if ($recurso != null) {
            $src = $recurso->getRecSrc();
            return $src;
    } else {
            Return 'backend/img/user-generic-white.png';
    }
    
    
    }   
    
}
