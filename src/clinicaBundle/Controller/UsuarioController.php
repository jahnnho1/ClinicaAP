<?php

namespace clinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Lib\Utiles;
use AppBundle\Model\UsuarioPadre;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use AppBundle\Model\UsuarioPadreQuery;
use Swift_Message;
use AppBundle\Model\UsuarioAdministrativoQuery;
use AppBundle\Model\UsuarioAdministrativo;

class UsuarioController extends Controller
{
    public function ingresoAction()
    {
        if($this->container->get('session')->get('usuarioObjeto') != null){
             return $this->redirect($this->generateUrl('clinica_homepage'));
        }
        
        return $this->render('frontend/usuario/ingreso.html.twig');
    }
    
    public function ingresoValidarAction(Request $request)
    {
        
        if($this->container->get('session')->get('usuarioObjeto') != null){
             return $this->redirect($this->generateUrl('clinica_homepage'));
        }        
             
        
        $usuarioRut = $request->get('usuarioRut',null);
        $usuarioClave = $request->get('usuarioClave',null);
        $usuarioTipo = $request->get('usuarioTipo',1);
   
        
        if($usuarioTipo == UsuarioAdministrativo::usuario_tipo_normal){            
                
        $usuarioPadre = new UsuarioPadre();  
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($usuarioPadre,$usuarioClave);             
            
                $usuarioPadre = UsuarioPadreQuery::create()
                ->filterByUpaEstado(UsuarioPadre::usuario_activo)
                ->filterByUpaEliminado(UsuarioPadre::usuario_eliminado_false)
                ->filterByUpaClave($encoded)
                ->filterByUpaRut($usuarioRut)
                ->findOne();
            
                    if($usuarioPadre == null){
                        $successMessage = ('Error, Las credenciales ingresadas no son validas');
                        $this->get('session')->getFlashBag()->add('error', $successMessage);
                        return $this->redirect($this->generateUrl('clinica_usuario_ingreso'));
                    }else{
                            $this->container->get('session')->set('usuarioNombre', $usuarioPadre->getUpaNombres());
                            $this->container->get('session')->set('usuarioId', $usuarioPadre->getUpaId());
                            $this->container->get('session')->set('usuarioObjeto', $usuarioPadre); 
                            $this->container->get('session')->set('usuarioCorreo', $usuarioPadre->getUpaEmail());
                            $this->container->get('session')->set('rec_img', $usuarioPadre->recuperarImagen());
                            return $this->redirect($this->generateUrl('clinica_homepage'));
                    }
            
        }elseif ($usuarioTipo == UsuarioAdministrativo::usuario_tipo_administrativo ) {
            
                       $usuario =  UsuarioAdministrativoQuery::create()
                        ->filterByUsuRut($usuarioRut)
                        ->filterByUsuClave($usuarioClave)
                        ->filterByUsuEliminado(UsuarioAdministrativo::usuario_eliminado_false)
                        ->filterByUsuEstado(UsuarioAdministrativo::usuario_estado_activo)
                        ->findOne();
                       
                     if($usuario == null){
                           $successMessage = ('Error, Credenciales ingresadas son incorrectas');
                           $this->get('session')->getFlashBag()->add('error', $successMessage);           
                            return $this->redirect($this->generateUrl('backend_login')); 
                     }else{
                       
                        $this->container->get('session')->set('usuarioNombre', $usuario->getUsuNombre());
                        $this->container->get('session')->set('usuarioId', $usuario->getUsuId());
                        $this->container->get('session')->set('usuarioCorreo', $usuario->getUsuEmail());
                        $this->container->get('session')->set('rec_img', $usuario->recuperarImagen());
                        $this->container->get('session')->set('usuarioObjeto', $usuario);
                        return $this->redirect($this->generateUrl('backend_homepage')); 
                     }
            
            
        }else {
            
       
               $successMessage = ('Error, Area en construccion');
               $this->get('session')->getFlashBag()->add('error', $successMessage);           
               return $this->redirect($this->generateUrl('backend_login')); 
            
            
        }
        
  
        

        
        
   
        
        
        return $this->redirect($this->generateUrl('clinica_homepage'));
        
    }
    
    
    public function registroAction()
    {        
        
        if($this->container->get('session')->get('usuarioObjeto') != null){
             return $this->redirect($this->generateUrl('clinica_homepage'));
        }
        
        return $this->render('frontend/usuario/registro.html.twig');
    }
    

    public function registroValidarAction(Request $request)
    {
        
        if($this->container->get('session')->get('usuarioObjeto') != null){
             return $this->redirect($this->generateUrl('clinica_homepage'));
        }        
                        
        $usuarioNombre = $request->get('usuarioNombre',null);
        $usuarioApellido =  $request->get('usuarioApellido',null);
        $usuarioCorreo = $request->get('usuarioCorreo',null);
        $usuarioRut = $request->get('usuarioRut',null);
        $usuarioClave1 = $request->get('usuarioClave1',null);
        $usuarioClave2 = $request->get('usuarioClave2',null);
        $usuarioTerminos = $request->get('usuarioTerminos',null);
        
        
        if($usuarioClave1 != $usuarioClave2){    
            $successMessage = ('Error, Las credenciales no son iguales');
            $this->get('session')->getFlashBag()->add('error', $successMessage);
            return $this->redirect($this->generateUrl('clinica_usuario_registro'));
        }
        
        if($usuarioNombre == null && $usuarioApellido == null && $usuarioCorreo == null && $usuarioClave1 == null ){
                        
            $successMessage = ('Error, Complete todos los campos');
            $this->get('session')->getFlashBag()->add('error', $successMessage);
            return $this->redirect($this->generateUrl('clinica_usuario_registro'));
        }
        
        
        

        
        $usuario = new UsuarioPadre();  
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($usuario,$usuarioClave1); 
        $usuario->setUpaNombres($usuarioNombre);
        $usuario->setUpaApellidos($usuarioApellido);
        $usuario->setUpaEstado(UsuarioPadre::usuario_activo);
        $usuario->setUpaEmail($usuarioCorreo);
        $usuario->setUpaClave($encoded);
        $usuario->setUpaRut($usuarioRut);
        $usuario->setUpaEliminado(UsuarioPadre::usuario_eliminado_false);
        $usuario->save();
        $successMessage = ('Exito, La cuenta fue creada exitosamente');
        $this->get('session')->getFlashBag()->add('success', $successMessage);                 
        return $this->redirect($this->generateUrl('clinica_login'));        
        
    }
    
    
    
    
    public function salirUsuarioAction(){
        
        $this->get('session')->invalidate();
        return $this->redirect($this->generateUrl('clinica_homepage'));
    }
    
  

    
    public function contactoAction(){        
        return $this->render('frontend/home/contacto.html.twig');        
    }    
    
    public function contactoEjecutarAction(Request $request){   
        
        $contactoNombre = $request->get('contactoNombre',null);
        $contactoEmail = $request->get('contactoEmail',null);
        $contactoMensaje = $request->get('contactoMensaje',null);
        
        
        $mailer = $this->container->get('mailer');
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
                ->setUsername('*****')
                ->setPassword('*****');
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance('Test')
                ->setSubject('Mensaje enviado exitosamente')
                ->setTo($contactoEmail, 'Alejandro Moraga') // A que usuario se le mandara el correo
                ->setFrom('clymoplet@gmail.com', 'Alejandro Moraga') // De parte de quien se le mandara el correo               
                ->setBody('Estimado usuario, el correo fue enviado con exito');
        $this->get('mailer')->send($message);
        

        $mailer = $this->container->get('mailer');
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
                ->setUsername('*****')
                ->setPassword('*****');
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance('Test')
                ->setSubject($contactoNombre)
                ->setTo('clymoplet@gmail.com') // A que usuario se le mandara el correo
                ->setFrom('clymoplet@gmail.com', 'Alejandro Moraga') // De parte de quien se le mandara el correo               
                ->setBody($contactoMensaje);
        $this->get('mailer')->send($message);

        
        return $this->redirect($this->generateUrl('clinica_contacto'));         
    }     
    
    

    
    
    
    
    
}
