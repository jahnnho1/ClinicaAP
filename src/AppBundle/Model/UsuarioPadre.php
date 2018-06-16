<?php

namespace AppBundle\Model;

use AppBundle\Model\om\BaseUsuarioPadre;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class UsuarioPadre extends BaseUsuarioPadre implements AdvancedUserInterface, \Serializable
{
    const usuario_activo = 0;
    const usuario_inactivo = 1;
    
    const usuario_eliminado_false = 0;
    const usuario_eliminado_true = 1;

    public function isEnabled() {
        return $this->getUpaEstado();
    }   
    
    public function eraseCredentials() {
        
    }
    
    public function getPassword() {
        return $this->getUpaClave();
    }
    
    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->getUpaRut();
    }

    public function getRoles() {
        $roles = array();
        return $roles;
    }    
    
    public function recuperarImagen() {
        $recurso = RecursoQuery::create()->filterByRecEliminado(Recurso::recurso_eliminado_false)->findOneByUpaId($this->getUsuId());
        if ($recurso != null) {
            $src = $recurso->getRecSrc();
            return $src;
    } else {
            Return 'backend/img/user-generic-white.png';
    }
    
    
    }
    

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
           $this->getUpaId(),
           $this->getUpaRut(),
           $this->getUpaClave()
     
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        return list (
           $this->getUpaId(),
           $this->getUpaRut(),
           $this->getUpaClave()        
        ) = unserialize($serialized);
    }   
        


    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }   
    
    
    
    
    
    
    
}
