<?php
namespace App\Controller;

use App\Entity\Vetement;
use App\Entity\Equipe;
use App\Form\VetementType;
use App\Repository\VetementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VetementController extends AbstractController
{
    /**
     * @Route("/vetement", name="vetement")
     */

    public function VetementList(VetementRepository $vetementRepository)
    {

        $vetements = $vetementRepository->findAll();
        return $this->render('vetement/vetement.html.twig',[
            'vetements' => $vetements


        ]);
    }
    /**
     * @Route("/Vetement/show/{id}" , name="vetementid")
     */

    public function VetementID(VetementRepository $vetementRepository, $id)
    {

        $vetement = $vetementRepository -> find($id);
        return $this->render('vetement/vetement_article.html.twig', [

            'vetement' => $vetement

        ]);
    }
    /**
     * @Route("/admin/vetement/insert", name="vetement_insert")
     */
    public function insertVetementForm(Request $request, EntityManagerInterface $entityManager)
    {
// J'utilise le gabarit de formulaire pour créer mon formulaire
// j'envoie mon formulaire à un fichier twig
// et je l'affiche
// je crée un nouveau Vetement,
// en créant une nouvelle instance de l'entité Vetement
        $title = 'Formulaire des vêtements';
        $vetement = new Vetement();
// J'utilise la méthode createForm pour créer le gabarit / le constructeur de
// formulaire pour le Author : VetementType (que j'ai généré en ligne de commandes)
// Et je lui associe mon entité Author vide
        $vetementForm = $this->createForm(VetementType::class, $vetement);
// Si je suis sur une méthode POST
// donc qu'un formulaire a été envoyé
        if ($request->isMethod('Post')) {
// Je récupère les données de la requête (POST)
// et je les associe à mon formulaire
            $vetementForm->handleRequest($request);
// Si les données de mon formulaire sont valides
// (que les types rentrés dans les inputs sont bons,
// que tous les champs obligatoires sont remplis etc)
            if ($vetementForm->isValid()) {
// J'enregistre en BDD ma variable $author
// qui n'est plus vide, car elle a été remplie
// avec les données du formulaire
                $entityManager->persist($vetement);
                $entityManager->flush();
            }
        }
// à partir de mon gabarit, je crée la vue de mon formulaire
        $vetementFormView = $vetementForm->createView();
// je retourne un fichier twig, et je lui envoie ma variable qui contient
// mon formulaire
        return $this->render('vetement/vetement_form.html.twig', [
            'vetementFormView' => $vetementFormView,
            'title' => $title

        ]);

    }

}