<?php
namespace App\Controller;

use App\Entity\Peripherique;
use App\Entity\Equipe;
use App\Form\PeripheriqueType;
use App\Repository\PeripheriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PeripheriqueController extends AbstractController
{
    /**
     * @Route("/peripherique", name="peripherique")
     */

    public function PeripheriqueList(PeripheriqueRepository $peripheriqueRepository)
    {

        $peripheriques = $peripheriqueRepository->findAll();
        return $this->render('peripherique/peripherique.html.twig',[
            'peripheriques' => $peripheriques


        ]);
    }
    /**
     * @Route("/peripherique/show/{id}" , name="peripheriqueid")
     */

    public function PeripheriqueID(PeripheriqueRepository $peripheriqueRepository, $id)
    {

        $peripherique = $peripheriqueRepository -> find($id);
        return $this->render('peripherique/peripherique_article.html.twig', [

            'peripherique' => $peripherique

        ]);
    }
    /**
     * @Route("/admin/peripherique/insert", name="peripherique_insert")
     */
    public function insertPeripheriqueForm(Request $request, EntityManagerInterface $entityManager)
    {
// J'utilise le gabarit de formulaire pour créer mon formulaire
// j'envoie mon formulaire à un fichier twig
// et je l'affiche
// je crée un nouveau Peripherique,
// en créant une nouvelle instance de l'entité Peripherique

        $peripherique = new Peripherique();
// J'utilise la méthode createForm pour créer le gabarit / le constructeur de
// formulaire pour le Author : PeripheriqueType (que j'ai généré en ligne de commandes)
// Et je lui associe mon entité Peripherique vide
        $peripheriqueForm = $this->createForm(PeripheriqueType::class, $peripherique);
// Si je suis sur une méthode POST
// donc qu'un formulaire a été envoyé
        if ($request->isMethod('Post')) {
// Je récupère les données de la requête (POST)
// et je les associe à mon formulaire
            $peripheriqueForm->handleRequest($request);
// Si les données de mon formulaire sont valides
// (que les types rentrés dans les inputs sont bons,
// que tous les champs obligatoires sont remplis etc)
            if ($peripheriqueForm->isValid()) {
// J'enregistre en BDD ma variable $peripherique
// qui n'est plus vide, car elle a été remplie
// avec les données du formulaire
                $entityManager->persist($peripherique);
                $entityManager->flush();
            }
        }
// à partir de mon gabarit, je crée la vue de mon formulaire
        $peripheriqueFormView = $peripheriqueForm->createView();
// je retourne un fichier twig, et je lui envoie ma variable qui contient
// mon formulaire
        return $this->render('peripherique/peripherique_form.html.twig', [
            'peripheriqueFormView' => $peripheriqueFormView,


        ]);

    }
    /**
     * @Route("/admin/peripherique", name="peripherique_admin")
     */
    //méthode qui permet de faire "un select" en BDD de l'ensemble de mes champs dans ma table Peripherique
    public function peripheriqueDbList(peripheriqueRepository $peripheriqueRepository)
    {

        //J'utilise le repository de pheripherique pour pouvoir selectionner tous les élèments de ma table peripherique
        //Les repositorys en général servent à faire les requêtes select dans les tables
        $peripheriques = $peripheriqueRepository->findAll();
        //méthode render qui permet d'afficher mon fichier html.twig, et le résultat de ma requëte SQL
        return $this->render('peripherique/peripherique_admin.html.twig', [
            'peripheriques' => $peripheriques,

        ]);
    }
    /**
     * @Route("/admin/peripherique/delete/{id}", name="peripherique_delete")
     */
    public function deletePeripherique(PeripheriqueRepository $peripheriqueRepository, EntityManagerInterface $entityManager, $id)
    {

        // Je récupère un enregistrement peripherique en BDD grâce au repository de peripherique
        $peripherique = $peripheriqueRepository->find($id);
        // j'utilise l'entity manager avec la méthode remove pour enregistrer
        // la suppression du peripherique dans l'unité de travail
        $entityManager->remove($peripherique);
        // je valide la suppression en bdd avec la méthode flush
        $entityManager->flush();

        return $this->render('peripherique/peripherique_delete.html.twig', [
            'peripherique' => $peripherique,
        ]);
    }
    /**
     * @Route("/admin/peripherique/update_form/{id}", name="peripherique_update")
     */
    public function updatePeripheriqueForm(PeripheriqueRepository $peripheriqueRepository, Request $request, EntityManagerInterface $entityManager, $id)
    {

        $peripherique = $peripheriqueRepository->find($id);
        $peripheriqueForm = $this->createForm(PeripheriqueType::class, $peripherique);
        if ($request->isMethod('Post'))
        {
            $peripheriqueForm->handleRequest($request);
            if ($peripheriqueForm->isValid()) {
                $entityManager->persist($peripherique);
                $entityManager->flush();
            }
        }
        // à partir de mon gabarit, je crée la vue de mon formulaire
        $peripheriqueFormView = $peripheriqueForm->createView();
        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('peripherique/peripherique_form.html.twig', [
            'peripheriqueFormView' => $peripheriqueFormView,

        ]);
    }

}