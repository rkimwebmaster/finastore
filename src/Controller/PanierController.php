<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Service\CartTools;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{

    
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier=$session->get('panier',[]);
        $dataPanier=[];
        $prixTotalPanier=0;
        $quantiteProduits=0;
        foreach($panier as $id=>$quantite){
            $produit=$produitRepository->find($id);
            if($produit){
                $dataPanier[]=[
                    'produit'=>$produit,
                    'quantite'=>$quantite,
                ];
                $prixTotalPanier +=$produit->getPrixVente() * $quantite;
                $quantiteProduits +=$quantite;
    
            }
        }
        return $this->redirectToRoute('app_achat_new', [], Response::HTTP_SEE_OTHER);

        // dd($quantiteProduits);
        return $this->render('panier/index.html.twig', [
            "dataPanier"=>$dataPanier,
            "total"=>$prixTotalPanier,
            "quantiteProduits"=>$quantiteProduits,
        ]);
    }


    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
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
        return $this->redirectToRoute('cart_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, ProduitRepository $produitRepository, SessionInterface $session)
    {
        
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            if($panier[$id]> 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }else{
            $this->addFlash('warning','Aucun produit pour cet identifiant');
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('cart_index', [], Response::HTTP_SEE_OTHER);

    }


    #[Route('/deleteAll', name: 'app_panier_delete_all')]
    public function deleteAll(SessionInterface $session): Response
    {
        
        $session->set("panier",[]);
        // dd($session);
        return $this->redirectToRoute('app_panier', [], Response::HTTP_SEE_OTHER);
    }
}
