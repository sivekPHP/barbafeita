<?php

namespace BarbafeitaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \BarbafeitaBundle\Entity\Agendamento;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $servicos = $em->getRepository('BarbafeitaBundle:Servico')->findBy(array(), array('nome'=>'ASC'));
        
        $dtInicio = new \DateTime('+1 day');
        $dtFim = new \DateTime('+1 month');
        $intervalo = new \DateInterval('P1D');
        $periodo = new \DatePeriod($dtInicio, $intervalo, $dtFim);
        
        return $this->render('BarbafeitaBundle:Default:index.html.twig', array(
            'servicos'=>$servicos,
            'datas'=>$periodo
        ));
    }
    
    /**
     * @Route("/profissionais")
     */
    public function profissionaisAction(Request $request)
    {
        $idServico = $request->get('servico');
        
        $em = $this->getDoctrine()->getManager();
        
        $barbeiros = $em->getRepository('BarbafeitaBundle:Barbeiro')->findBy(array('servico'=>$idServico), array('nome'=>'ASC'));
        
        return $this->json($barbeiros);
    }
    
    /**
     * @Route("/horarios")
     */
    public function horariosAction(Request $request)
    {
        $barbeiro = $request->get('barbeiro');
        $dtSelecionada = $request->get('dia');

        $em = $this->getDoctrine()->getManager();
        $pesquisa = $em->createQuery(
                '
                    SELECT a FROM BarbafeitaBundle:Agendamento a
                    WHERE a.barbeiro = :barbeiro
                    AND a.horario BETWEEN :dtini AND :dtfim 
                '
            );
        $pesquisa->setParameter('barbeiro', $barbeiro);
        $pesquisa->setParameter('dtini', $dtSelecionada.' 00:00:00');
        $pesquisa->setParameter('dtfim', $dtSelecionada.' 23:59:00');
                
        $resultado = $pesquisa->getResult();
        
        //dump($resultado);
        
        $dtInicio = new \DateTime($dtSelecionada);
        $dtInicio->setTime(9, 0, 0);
        $dtFim = new \DateTime($dtSelecionada);
        $dtFim->setTime(18, 0, 0);
        $intervalo = new \DateInterval('PT30M');
        $periodo = new \DatePeriod($dtInicio, $intervalo, $dtFim);
        
        foreach ($periodo as $dia)
        {
            $dias['hora'] = $dia->format('H:i');
            $dias['disponivel'] = true;
            $listaHorarios[] = $dias;
        }
        
        foreach ($resultado as $horarioIndisp) 
        {
            $hora = $horarioIndisp->getHorario()->format('H:i');
            $ind = array_search($hora, $listaHorarios);
            $listaHorarios[$ind]['disponivel'] = false;
        }
            
        return $this->json($listaHorarios);
    }
    
    /**
     * @Route("/agendar")
     */
    public function agendarAction(Request $request) 
    {
        $agendamento = new Agendamento();
        $agendamento->setStatus('NOVO');
        $agendamento->setDataCadastro(new \DateTime());
        $agendamento->setDataOperacao(new \DateTime());
        
        $agendamento->setNome($request->get('nome'));
        $agendamento->setTelefone($request->get('telefone'));
        $agendamento->setEmail($request->get('email'));
        
        $horario = new \DateTime($request->get('horario'));
        $agendamento->setHorario($horario);

        $em = $this->getDoctrine()->getManager();
        $servico = $em->getRepository('BarbafeitaBundle:Servico')->find($request->get('servico'));
        $barbeiro = $em->getRepository('BarbafeitaBundle:Barbeiro')->find($request->get('barbeiro'));
        
        $agendamento->setBarbeiro($barbeiro);
        $agendamento->setServico($servico);
        
        $em->persist($agendamento);
        $em->flush();
        
        return $this->render('BarbafeitaBundle:Default:agendar.html.twig', array(
            'info'=>$agendamento
        ));
    }
}
