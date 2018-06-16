<?php

namespace AppBundle\Model;

use AppBundle\Model\om\BaseRecurso;

class Recurso extends BaseRecurso
{
    const recurso_eliminado_false = 0;
    const recurso_eliminado_true = 1;
    
    const estado_activo = 0;
    const estado_inactivo = 1;
    
    const tipo_imagen = 0;
}
