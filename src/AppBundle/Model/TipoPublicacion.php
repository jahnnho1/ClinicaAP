<?php

namespace AppBundle\Model;

use AppBundle\Model\om\BaseTipoPublicacion;

class TipoPublicacion extends BaseTipoPublicacion
{
    const tp_no_eliminado = 0;
    const tp_eliminado = 1;
    
    
    const tp_innovacion = 1;
    const tp_salud = 2;
    const tp_principal =3;
    
}
