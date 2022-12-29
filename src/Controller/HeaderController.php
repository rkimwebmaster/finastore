<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HeaderController extends AbstractController
{
    #[Route('/header', name: 'app_header')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier=$session->get('panier',[]);
        $dataPanier=[];
        $prixTotalPanier=0;
        $quantiteProduits=0;
        foreach($panier as $id=>$quantite){
            $produit=$produitRepository->find($id);
            $dataPanier[]=[
                'produit'=>$produit,
                'quantite'=>$quantite,
            ];
            $prixTotalPanier +=$produit->getPrixVente() * $quantite;
            $quantiteProduits +=$quantite;
        }

        // dd($quantiteProduits);
        return $this->render('_partials/_headerAction.html.twig', [
            "dataPanier"=>$dataPanier,
            "total"=>$prixTotalPanier,
            "quantiteProduits"=>$quantiteProduits,
        ]);
    }

}
