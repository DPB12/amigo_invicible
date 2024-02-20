<?php

namespace App\Controller;

use App\Repository\ParticipantesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ParticipantesRepository $participante): Response
    {
        $arr = array();
        $fecha = array();
        if($this->getUser()){

            $notificaciones = $this->getUser()->getNotificaciones();
            $tusSorteos = $participante->findByUserId($this->getUser()->getId());
            foreach ($tusSorteos as $sorts) {
                $arr[] = $sorts->getSorteo();
                $fecha[] = $sorts->getSorteo()->getFecha();
            }
            // dd($arr);
            
        }else{
            $notificaciones = [];
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            "notificaciones" => $notificaciones,
            "sorteosUsuario"=> $arr,
        ]);
    }
}
