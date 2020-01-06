<?php
namespace App\Controller;

use App\Repository\VitalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VitalityController extends AbstractController
{

    /**
     * @Route("/vitality", name="vitality")
     */

    public function VitalityShow(Request $request)
    {


        return $this->render('vitality.html.twig',[


        ]);
    }

}