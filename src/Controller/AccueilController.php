<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\NewsLetter;
use App\Entity\Produit;
use App\Entity\Service;
use App\Repository\CategorieRepository;
use App\Repository\ContactRepository;
use App\Repository\NewsLetterRepository;
use App\Repository\PageQSNRepository;
use App\Repository\PartenaireRepository;
use App\Repository\ProduitRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(ProduitRepository $produitRepository, ServiceRepository $serviceRepository): Response
    {
        
        $produits = $produitRepository->findAll();
        $services = $serviceRepository->findAll();
        return $this->render('accueil/index.html.twig', [
            'produits' => $produits,
            'services' => $services,
        ]);
    }

    #[Route('/produits', name: 'app_produits')]
    public function produits(Request $request, ProduitRepository $produitRepository): Response
    {
        // dd($request->get('_route'));
        
        $produits = $produitRepository->findAll();
        return $this->render('accueil/produits.html.twig', [
            'produits' => $produits,
        ]);
    }


    #[Route('/arrivageProduits', name: 'app_arrivage_produits')]
    public function arrivageProduits(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findBy(['isArrivage'=>true]);
        return $this->render('accueil/arrivages.html.twig', [
            'produits' => $produits,
        ]);
    }


    #[Route('/productSearch', name: 'app_product_search')]
    public function soldeProduits(Request $request, ProduitRepository $produitRepository): Response
    {
        $key=$request->get('produit');
        $produits = $produitRepository->findOneBy(['nom'=>$key]);
        return $this->render('accueil/produits.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/categorieProduit/{id}', name: 'app_produits_categorie')]
    public function categorieProduit(Categorie $categorie): Response
    {
        $produits = $categorie->getProduits();
        return $this->render('accueil/produits.html.twig', [
            'produits' => $produits,
        ]);
    }

    
    #[Route('/qsn', name: 'app_qsn')]
    public function qsn(PageQSNRepository $pageQSNRepository, PartenaireRepository $partenaireRepository): Response
    {
        $page=$pageQSNRepository->findOneBy([],['createdAt'=>'desc']);
        $partenaires=$partenaireRepository->findAll([],['createdAt'=>'desc']);
        return $this->render('accueil/qsn.html.twig', [
            'page'=>$page,
            'partenaires'=>$partenaires,
        ]);
    }

    
    #[Route('/app_header', name: 'app_header')]
    public function header(CategorieRepository $categorieRepository, ServiceRepository $serviceRepository): Response
    {
        
        return $this->render('_partials/_header.html.twig', [
            'categories'=>$categorieRepository->findAll(),
            'services'=>$serviceRepository->findAll(),
        ]);
    }


    #[Route('/services/{id}', name: 'app_service')]
    public function services(Service $service): Response
    {
        return $this->render('accueil/services.html.twig', [
            'page' => $service,
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('accueil/contact.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    

    #[Route('/creationNewsLetter', name: 'app_creationNewsLetter', methods: 'GET')]
    public function creationNewsLetter(Request $request, NewsLetterRepository $newsLetterRepository): Response
    {

        $email = $request->get('email');
        // verifier doublon
        $check = $newsLetterRepository->findBy(['email' => $email]);
        if ($check) {
            $this->addFlash("info", "Merci vous êtes déja dans le système.");
            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }
        $newsLetter = new NewsLetter();
        $newsLetter->setEmail($email);
        $newsLetterRepository->save($newsLetter, true);
        $this->addFlash("success", "Merci pour votre inscription à la newsletter.");
        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        // return $this->redirect();
    }

    #[Route('/creationContact', name: 'app_creationContact', methods:['GET'])]
    public function creationContact(Request $request, ContactRepository $contactRepository): Response
    {
        $nom=$request->get('nom');
        $email=$request->get('email');
        $sujet=$request->get('sujet');
        $message=$request->get('message');
        $telephone=$request->get('telephone');
        $contact = new Contact($nom, $email, $telephone, $sujet, $message);
        $contactRepository->save($contact, true);

        // return $this->redirectToRoute('app_news_letter_index', [], Response::HTTP_SEE_OTHER);
        $this->addFlash("success", "Merci pour votre inscription.");
        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/detailService/{id}', name: 'app_service_show', methods: ['GET'])]
    public function detailService(Service $service): Response
    {
        return $this->render('accueil/detailService.html.twig', [
            'service' => $service,
        ]);
    }


    #[Route('/detailProduit/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function detailProduit(Produit $produit): Response
    {
        return $this->render('accueil/detailProduit.html.twig', [
            'produit' => $produit,
        ]);
    }


    #[Route('/garantieRemboursement', name: 'app_garantie_remboursement')]
    public function garantieRemboursement(): Response
    {
        return $this->render('accueil/remboursement.html.twig', []);
    }


    #[Route('/termeConditions', name: 'app_terme_conditions')]
    public function termeConditions(): Response
    {
        return $this->render('accueil/termeConditions.html.twig', []);
    }


    #[Route('/policy', name: 'app_policy')]
    public function policy(): Response
    {
        return $this->render('accueil/policy.html.twig', []);
    }
}
