<?php

namespace BarbafeitaBundle\Controller;

use BarbafeitaBundle\Entity\Agendamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Agendamento controller.
 *
 * @Route("agendamento")
 */
class AgendamentoController extends Controller
{
    /**
     * Lists all agendamento entities.
     *
     * @Route("/", name="agendamento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agendamentos = $em->getRepository('BarbafeitaBundle:Agendamento')->findAll();

        return $this->render('BarbafeitaBundle:Agendamento:/index.html.twig', array(
            'agendamentos' => $agendamentos,
        ));
    }

    /**
     * Finds and displays a agendamento entity.
     *
     * @Route("/{id}", name="agendamento_show")
     * @Method("GET")
     */
    public function showAction(Agendamento $agendamento)
    {

        return $this->render('BarbafeitaBundle:Agendamento:show.html.twig', array(
            'agendamento' => $agendamento,
        ));
    }
}
