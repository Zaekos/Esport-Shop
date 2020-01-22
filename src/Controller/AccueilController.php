<?php
namespace App\Controller;

use App\Entity\Peripherique;
use App\Repository\PeripheriqueRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{

    /**
     * @Route("/accueil", name="accueil")
     */

    public function AccueilShow(Request $request, PeripheriqueRepository $peripheriqueRepository)
    {


        $peripheriques = $peripheriqueRepository->GetLastElements();


        return $this->render('accueil.html.twig',[
            'peripheriques' => $peripheriques

        ]);

    }
    /**
     * @Route("/admin/accueil", name="accueil_admin")
     */

    public function AccueilAdminShow(Request $request)
    {


        return $this->render('accueil_admin.html.twig',[


        ]);
    }

    /**
     * @Route ("/compte", name="compte")
     */

    public function CompteShow(Request $request)
    {
        return $this->render('Bundles/FOSUserBundle/layout.html.twig');

    }

}