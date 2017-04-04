<?php

namespace BarbafeitaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $servicos = $em->getRepository('BarbafeitaBundle:Servico')->findBy(array(), array('nome'=>'ASC'));
        
        return $this->render('BarbafeitaBundle:Default:index.html.twig', array(
            'servicos'=>$servicos
        ));
    }
    
    /**
     * @Route("/profissionais")
     */
    public function profissionaisAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $barbeiros = $em->getRepository('BarbafeitaBundle:Barbeiro')->findBy(array(), array('nome'=>'ASC'));
        
        return $this->json($barbeiros);
    }
}
