<?php
namespace App\Controller;

use App\Repository\LestreamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LestreamController extends AbstractController
{

    /**
     * @Route("/lestream", name="lestream")
     */

    public function LestreamShow(Request $request)
    {


        return $this->render('lestream.html.twig',[


        ]);
    }

}