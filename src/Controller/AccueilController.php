<?php
namespace App\Controller;

use App\Repository\AccueilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{

    /**
     * @Route("/accueil", name="accueil")
     */

    public function AccueilShow(Request $request)
    {


        return $this->render('accueil.html.twig',[


        ]);
    }

}