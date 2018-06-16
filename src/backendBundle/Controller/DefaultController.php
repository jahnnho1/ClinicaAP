<?php

namespace backendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('backendBundle:Default:index.html.twig');
    }
}
