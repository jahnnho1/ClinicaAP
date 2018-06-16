<?php

namespace backendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Lib\Utiles;
use AppBundle\Model\UsuarioPadre;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use AppBundle\Model\UsuarioAdministrativoQuery;
use AppBundle\Model\UsuarioAdministrativo;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('backend/home/index.html.twig');
    }
    

}
