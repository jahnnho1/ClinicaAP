<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Lib\Utiles;

class SecurityController extends Controller {

    public function loginAction(Request $request) {
        $log = Utiles::setLog('BackendBundle\Controller\SecurityController:loginAction', 'backend/backend');
        $log->debug('Entrando');

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('frontend/usuario/ingreso.html.twig', array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                        )
        );
    }
    
   
    

}
