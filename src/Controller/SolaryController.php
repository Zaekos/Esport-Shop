<?php
namespace App\Controller;

use App\Repository\SolaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SolaryController extends AbstractController
{

    /**
     * @Route("/solary", name="solary")
     */

    public function SolaryShow(Request $request)
    {


        return $this->render('solary.html.twig',[


        ]);
    }

}