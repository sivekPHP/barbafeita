<?php

namespace BarbafeitaBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=TRUE)
     */
    private $nome;

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
}
