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
    public function index(ProduitRepository $produitRepository)
    {
        $session = new Session();
        $cartTools= new CartTools($session, $produitRepository);
        $totalItems=$session->get('totalItems', 0);
        $session->set('totalItems',$cartTools->getTotalItem());
        return $this->render('panier/index.html.twig', [
            'items' => $cartTools->getFullCart(),
            'totalTVA' => $cartTools->getTotalTVA(),
            'tva' => $cartTools->getTva(),
            'totalItems' => $totalItems,
            'totalTTC' => $cartTools->getTotalTTC()            
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, ProduitRepository $produitRepository)
    {
        
        $session = new Session();
        $cartTools= new CartTools($session, $produitRepository);

        $cartTools->add($id);

        return $this->redirectToRoute('app_produit_index');
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, ProduitRepository $produitRepository)
    {
        $session = new Session();
        $cartTools= new CartTools($session, $produitRepository);

         $cartTools->remove($id);       

        return $this->redirectToRoute('cart_index');
    }
}
