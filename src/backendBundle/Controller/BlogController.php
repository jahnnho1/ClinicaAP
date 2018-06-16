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
use AppBundle\Model\TipoPublicacionQuery;
use AppBundle\Model\TipoPublicacion;
use AppBundle\Model\Blog;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;

class BlogController extends Controller
{
    public function indexAction()
    {
        return $this->render('backend/blog/index.html.twig');
    }

    public function crearPublicacionAction()
    {
        $tipoPublicacion = TipoPublicacionQuery::create()->filterByTpuEliminado(TipoPublicacion::tp_no_eliminado)
                ->find();
        
        
        return $this->render('backend/blog/realizarPublicacion.html.twig', array('tipoPublicacion' => $tipoPublicacion));
    }
    
    
    public function crearPublicacionEjecutarAction(Request $request)
    {
        $blogTitulo = $request->get('blogTitulo', null);   
        $blogTipo = $request->get('blogTipo', null);
        $blogBreveComentario = $request->get('blogBreveComentario', null);
        $blogComentario = $request->get('blogComentario', null); 
        $usuario = $this->container->get('session')->get('usuarioNombre');        
       
        
        $blog = new Blog();
        $blog->setBloTitulo($blogTitulo);
        $blog->setBloAutor($usuario);
        $blog->setBloBreveDescripcion($blogBreveComentario);
        $blog->setBloDescripcion($blogComentario);
        $blog->setTpuId($blogTipo);
        $blog->setBloEliminado(Blog::eliminado_false);
        $blog->setBloEstado(Blog::estado_activo);        
        $blog->save();
                

            //Guardar imagen
            $flagImagen = TRUE;
            $sucursalImagen = $request->files->get('files');
            if ($sucursalImagen == NULL) {
                $flagImagen = FALSE;
            } elseif (!in_array($sucursalImagen->getClientMimeType(), Utiles::getMimeTypesImagenes()) || //extension valida
                    $sucursalImagen->getError() !== UPLOAD_ERR_OK) {//sin errores en la subida  
                $flagImagen = FALSE;
            }
            if ($flagImagen) {
                
                $recurso = new Recurso();
                $recurso->setBlog($blog);
                $recurso->setRecEliminado(Recurso::recurso_eliminado_false);
                $recurso->setRecEstado(Recurso::estado_inactivo);                
                $recurso->setRecTipo(Recurso::tipo_imagen);                
                $recurso->save();
                //mueve imagen
                try {
                    $ruta = 'images/blog';
                    $nombreImagen = $recurso->getRecId() . '_' . $sucursalImagen->getClientOriginalName();
                    $flagSubida = $sucursalImagen->move(Utiles::getWebRoot() . '/' . $ruta, $nombreImagen);
                    if ($flagSubida) {
                        $recurso->setRecSrc($ruta . '/' . $nombreImagen);
                        $recurso->save();
                    } else {
                        $recurso->setRecEliminado(Recurso::recurso_eliminado_true);
                        $recurso->save();
                    }
                } catch (\FileException $exc) {
                    $log->warning(' problema al mover imagen->' . $exc);
                    $recurso->setRecEliminado(1);
                    $recurso->save();
                }
            }
            
          return $this->redirect($this->generateUrl('backend_blog_homepage'));   
        }
    }
    


