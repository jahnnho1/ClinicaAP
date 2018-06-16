<?php

namespace clinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\BlogQuery;
use AppBundle\Model\Blog;
use AppBundle\Model\TipoPublicacion;
use AppBundle\Model\ComentarioQuery;
use AppBundle\Model\Comentario;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        //Noticia principal
        $noticiaImportante = BlogQuery::create()->filterByBloEliminado(Blog::eliminado_false)->filterByBloEstado(Blog::eliminado_false)->filterByTpuId(TipoPublicacion::tp_innovacion)->orderByCreatedAt('desc')->findOne();
        $noticiasImportantes = BlogQuery::create()->filterByBloEliminado(Blog::eliminado_false)->filterByBloEstado(Blog::eliminado_false)->filterByTpuId(TipoPublicacion::tp_innovacion)->orderByCreatedAt('desc')->find();
        

        $noticiaImportante2 = BlogQuery::create()->filterByBloEliminado(Blog::eliminado_false)->filterByBloEstado(Blog::eliminado_false)->filterByTpuId(TipoPublicacion::tp_salud)->orderByCreatedAt('desc')->findOne();
        $noticiasImportantes2 = BlogQuery::create()->filterByBloEliminado(Blog::eliminado_false)->filterByBloEstado(Blog::eliminado_false)->filterByTpuId(TipoPublicacion::tp_salud)->orderByCreatedAt('desc')->find();


        
        $noticiaPrincipal = BlogQuery::create()->filterByBloEliminado(Blog::eliminado_false)->filterByBloEstado(Blog::eliminado_false)->filterByTpuId(TipoPublicacion::tp_principal)->orderByCreatedAt('desc')->findOne();
        
        return $this->render('frontend/home/index.html.twig',
                array('noticiaImportante' => $noticiaImportante,'noticiasImportantes' => $noticiasImportantes,
                    'noticiaImportante2' => $noticiaImportante2,'noticiasImportantes2' => $noticiasImportantes2,
                    'noticiaPrincipal'=> $noticiaPrincipal
                    ));
    }
    
    public function nosotrosAction(){
        
        return $this->render('frontend/home/nosotros.html.twig');
    }
    
    public function publicacionBlogAction(Request $request){
        
        $blogId = $request->get('blogId');
        $publicacion = BlogQuery::create()->filterByBloId($blogId)->filterByBloEliminado(Blog::eliminado_false)->filterByBloEstado(Blog::estado_activo)->findOne();
        $noticias = BlogQuery::create()->filterByBloEliminado(Blog::eliminado_false)->filterByBloEstado(Blog::eliminado_false)->orderByCreatedAt('desc')->find();
        
        
        $comentarios = ComentarioQuery::create()
                ->filterByComEliminado(Comentario::eliminado_false)
                ->filterByComEstado(Comentario::estado_activo)
                ->filterByBloId($blogId)
                ->find();
        
        return $this->render('frontend/home/publicacion.html.twig', array('publicacion' => $publicacion,
            'noticias' => $noticias,
            'comentarios' => $comentarios,
            'blogId'=> $blogId
            
            ));
    }
    
    
    public function publicacionBlogCrearPostAction(Request $request){
       

        $blogId = $request->get('blogId');
        $comentarioMensaje = $request->get('comentarioMensaje');
        $usuarioId = $this->container->get('session')->get('usuarioId');
        
        $comentario = new Comentario();
        $comentario->setComMensaje($comentarioMensaje);
        $comentario->setBloId($blogId);
        $comentario->setUpaId($usuarioId);
        $comentario->setComEliminado(Comentario::eliminado_false);
        $comentario->setComEstado(Comentario::estado_activo);
        $comentario->save();
        

        return $this->redirect($this->generateUrl('clinica_publicacion_blog', array('blogId'=>$blogId)));  
    }
    
    
}
