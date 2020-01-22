<?php
namespace App\Controller;

use App\Entity\Accessoire;
use App\Entity\Equipe;
use App\Form\AccessoireType;
use App\Repository\AccessoireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccessoireController extends AbstractController
{
    /**
     * @Route("/accesoire", name="accessoire")
     */

    public function AccessoireList(AccessoireRepository $accessoireRepository)
    {

        $accessoires = $accessoireRepository->findAll();
        return $this->render('accessoire/accessoire.html.twig', [
            'accessoires' => $accessoires


        ]);
    }

    /**
     * @Route("/accessoire/show/{id}" , name="accessoireid")
     */

    public function AccessoireID(AccessoireRepository $accessoireRepository, $id)
    {

        $accessoire = $accessoireRepository->find($id);
        return $this->render('accessoire/accessoire_article.html.twig', [

            'accessoire' => $accessoire

        ]);
    }

    /**
     * @Route("/admin/accessoire/insert", name="accessoire_insert")
     */
    public function insertAccessoireForm(Request $request, EntityManagerInterface $entityManager)
    {
// J'utilise le gabarit de formulaire pour créer mon formulaire
// j'envoie mon formulaire à un fichier twig
// et je l'affiche
// je crée un nouveau Accessoire,
// en créant une nouvelle instance de l'entité Accessoire

        $accessoire = new Accessoire();
// J'utilise la méthode createForm pour créer le gabarit / le constructeur de
// formulaire pour le Author : AccessoireType (que j'ai généré en ligne de commandes)
// Et je lui associe mon entité Accessoire vide
        $accessoireForm = $this->createForm(AccessoireType::class, $accessoire);
// Si je suis sur une méthode POST
// donc qu'un formulaire a été envoyé
        if ($request->isMethod('Post')) {
// Je récupère les données de la requête (POST)
// et je les associe à mon formulaire
            $accessoireForm->handleRequest($request);
// Si les données de mon formulaire sont valides
// (que les types rentrés dans les inputs sont bons,
// que tous les champs obligatoires sont remplis etc)
            if ($accessoireForm->isValid()) {
// J'enregistre en BDD ma variable $accessoire
// qui n'est plus vide, car elle a été remplie
// avec les données du formulaire
                $entityManager->persist($accessoire);
                $entityManager->flush();
            }
        }
// à partir de mon gabarit, je crée la vue de mon formulaire
        $accessoireFormView = $accessoireForm->createView();
// je retourne un fichier twig, et je lui envoie ma variable qui contient
// mon formulaire
        return $this->render('accessoire/accessoire_form.html.twig', [
            'accessoireFormView' => $accessoireFormView,


        ]);

    }
    /**
     * @Route("/admin/accessoire", name="accessoire_admin")
     */
    //méthode qui permet de faire "un select" en BDD de l'ensemble de mes champs dans ma table Accessoire
    public function accessoireDbList(accessoireRepository $accessoireRepository)
    {

        //J'utilise le repository de accessoire pour pouvoir selectionner tous les élèments de ma table accessoire
        //Les repositorys en général servent à faire les requêtes select dans les tables
        $accessoires = $accessoireRepository->findAll();
        //méthode render qui permet d'afficher mon fichier html.twig, et le résultat de ma requëte SQL
        return $this->render('accessoire/accessoire_admin.html.twig', [
            'accessoires' => $accessoires,

        ]);
    }
    /**
     * @Route("/admin/accessoire/delete/{id}", name="accessoire_delete")
     */
    public function deleteAccessoire(AccessoireRepository $accessoireRepository, EntityManagerInterface $entityManager, $id)
    {

        // Je récupère un enregistrement accessoire en BDD grâce au repository de accessoire
        $accessoire = $accessoireRepository->find($id);
        // j'utilise l'entity manager avec la méthode remove pour enregistrer
        // la suppression du accessoire dans l'unité de travail
        $entityManager->remove($accessoire);
        // je valide la suppression en bdd avec la méthode flush
        $entityManager->flush();

        return $this->render('accessoire/accessoire_delete.html.twig', [
            'accessoire' => $accessoire,
        ]);
    }
    /**
     * @Route("/admin/accessoire/update_form/{id}", name="accessoire_update")
     */
    public function updateAccessoireForm(AccessoireRepository $accessoireRepository, Request $request, EntityManagerInterface $entityManager, $id)
    {

        $accessoire = $accessoireRepository->find($id);
        $accessoireForm = $this->createForm(AccessoireType::class, $accessoire);
        if ($request->isMethod('Post'))
        {
            $accessoireForm->handleRequest($request);
            if ($accessoireForm->isValid()) {
                $entityManager->persist($accessoire);
                $entityManager->flush();
            }
        }
        // à partir de mon gabarit, je crée la vue de mon formulaire
        $accessoireFormView = $accessoireForm->createView();
        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('accessoire/accessoire_form.html.twig', [
            'accessoireFormView' => $accessoireFormView,

        ]);
    }

}