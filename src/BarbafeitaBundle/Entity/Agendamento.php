<?php

namespace BarbafeitaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BarbafeitaBundle\Entity\Servico;
use BarbafeitaBundle\Entity\Barbeiro;

/**
 * @ORM\Entity
 * @ORM\Table(name="agendamento")
 */

class Agendamento
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Servico")
     * @ORM\JoinColumn(name="servico_id", referencedColumnName="id")
     */
    private $servico;

    /**
     * @ORM\ManyToOne(targetEntity="Barbeiro")
     * @ORM\JoinColumn(name="barbeiro_id", referencedColumnName="id")
     */
    private $barbeiro;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $horario;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;
    
    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=100, nullable=TRUE)
     */
    private $email;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $dataCadastro;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $dataOperacao;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $status;
        

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set horario
     *
     * @param \DateTime $horario
     *
     * @return Agendamento
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return \DateTime
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Agendamento
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Agendamento
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Agendamento
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     *
     * @return Agendamento
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set dataOperacao
     *
     * @param \DateTime $dataOperacao
     *
     * @return Agendamento
     */
    public function setDataOperacao($dataOperacao)
    {
        $this->dataOperacao = $dataOperacao;

        return $this;
    }

    /**
     * Get dataOperacao
     *
     * @return \DateTime
     */
    public function getDataOperacao()
    {
        return $this->dataOperacao;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Agendamento
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set servico
     *
     * @param \BarbafeitaBundle\Entity\Servico $servico
     *
     * @return Agendamento
     */
    public function setServico(\BarbafeitaBundle\Entity\Servico $servico = null)
    {
        $this->servico = $servico;

        return $this;
    }

    /**
     * Get servico
     *
     * @return \BarbafeitaBundle\Entity\Servico
     */
    public function getServico()
    {
        return $this->servico;
    }

    /**
     * Set barbeiro
     *
     * @param \BarbafeitaBundle\Entity\Barbeiro $barbeiro
     *
     * @return Agendamento
     */
    public function setBarbeiro(\BarbafeitaBundle\Entity\Barbeiro $barbeiro = null)
    {
        $this->barbeiro = $barbeiro;

        return $this;
    }

    /**
     * Get barbeiro
     *
     * @return \BarbafeitaBundle\Entity\Barbeiro
     */
    public function getBarbeiro()
    {
        return $this->barbeiro;
    }
}
