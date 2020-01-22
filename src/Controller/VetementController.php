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
    // création de ma route URL+/vetement
    /**
     * @Route("/vetement", name="vetement")
     */
    // création de ma méthode que j'ai appelé ici VetementList
    // je passe en paramètres VetementRepository qui est la classe
    // permettant de gérer les requêtes liées à mon entité Vetement
    public function VetementList(VetementRepository $vetementRepository)
    {
        // je fais appel à la méthode finAll() présente dans le repository
        // cela va me permettre de récupérer tous les articles
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
// création de la route URL+/admin/vetement/insert
    /**
     * @Route("/admin/vetement/insert", name="vetement_insert")
     */
// création de ma méthode que j'ai appelé ici innsertVetementForm
// je met en paramètre de la méthode l'entity manager
// car c'est l'outil qui permet de gérer mes entités
    public function insertVetementForm(Request $request, EntityManagerInterface $entityManager)
    {
// J'utilise le gabarit de formulaire pour créer mon formulaire
// j'envoie mon formulaire à un fichier twig
// et je l'affiche
// je crée un nouveau Vetement,
// en créant une nouvelle instance de l'entité Vetement

        $vetement = new Vetement();
// J'utilise la méthode createForm pour créer le gabarit / le constructeur de
// formulaire pour le Vetement : VetementType (que j'ai généré en ligne de commandes)
// Et je lui associe mon entité Vetement vide
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
// J'enregistre en BDD ma variable $vetement
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


        ]);

    }
    /**
     * @Route("/admin/vetement", name="vetement_admin")
     */
    //méthode qui permet de faire "un select" en BDD de l'ensemble de mes champs dans ma table Vetement
    public function vetementDbList(vetementRepository $vetementRepository)
    {

        //J'utilise le repository de Vetement pour pouvoir selectionner tous les élèments de ma table vetement
        //Les repositorys en général servent à faire les requêtes select dans les tables
        $vetements = $vetementRepository->findAll();
        //méthode render qui permet d'afficher mon fichier html.twig, et le résultat de ma requëte SQL
        return $this->render('vetement/vetement_admin.html.twig', [
            'vetements' => $vetements,

        ]);
    }
    /**
     * @Route("/admin/vetement/delete/{id}", name="vetement_delete")
     */
    public function deleteVetement(VetementRepository $vetementRepository, EntityManagerInterface $entityManager, $id)
    {

        // Je récupère un enregistrement vetement en BDD grâce au repository de vetement
        $vetement = $vetementRepository->find($id);
        // j'utilise l'entity manager avec la méthode remove pour enregistrer
        // la suppression du vetement dans l'unité de travail
        $entityManager->remove($vetement);
        // je valide la suppression en bdd avec la méthode flush
        $entityManager->flush();

        return $this->render('vetement/vetement_delete.html.twig', [
            'vetement' => $vetement,
        ]);
    }
    /**
     * @Route("/admin/vetement/update_form/{id}", name="vetement_update")
     */
    public function updateVetementForm(VetementRepository $vetementRepository, Request $request, EntityManagerInterface $entityManager, $id)
    {

        $vetement = $vetementRepository->find($id);
        $vetementForm = $this->createForm(VetementType::class, $vetement);
        if ($request->isMethod('Post'))
        {
            $vetementForm->handleRequest($request);
            if ($vetementForm->isValid()) {
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

        ]);
    }

}