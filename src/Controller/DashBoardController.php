<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashBoardController extends AbstractController
{
    /**
     * @Route("/", name="dashBoard")
     */
    public function overviewAction()
    {
        return $this->render('DashBoard/overview.html.twig', [
            'ipAddress' => $_SERVER['REMOTE_ADDR']
        ]);
    }
}
