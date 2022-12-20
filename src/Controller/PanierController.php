<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier=$session->get('panier',[]);
        $dataPanier=[];
        $total=0;
        foreach($panier as $id=>$quantite){
            $produit=$produitRepository->find($id);
            $dataPanier[]=[
                'produit'=>$produit,
                'quantite'=>$quantite,
            ];
            $total +=$produit->getPrixVente() * $quantite;
        }
        return $this->render('panier/index.html.twig', [
            "dataPanier"=>$dataPanier,
            "total"=>$total,
        ]);
    }

    #[Route('/addProduit/{id}', name: 'app_panier_add')]
    public function add(Produit $produit, SessionInterface $session): Response
    {
        $id=$produit->getId();
        $panier=$session->get('panier',[]);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set("panier",$panier);
        // dd($session);
        return $this->redirectToRoute('app_panier', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/deleteAll', name: 'app_panier_delete_all')]
    public function deleteAll(SessionInterface $session): Response
    {
        
        $session->set("panier",[]);
        // dd($session);
        return $this->redirectToRoute('app_panier', [], Response::HTTP_SEE_OTHER);
    }
}
