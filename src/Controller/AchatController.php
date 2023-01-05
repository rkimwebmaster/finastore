<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\LigneAchat;
use App\Form\AchatType;
use App\Repository\AchatRepository;
use App\Repository\ClientRepository;
use App\Repository\MobileMoneyRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/achat')]
class AchatController extends AbstractController
{
    #[Route('/', name: 'app_achat_index', methods: ['GET'])]
    public function index(AchatRepository $achatRepository): Response
    {
        $email=$this->getUser()->getEmail();
        $achats= $achatRepository->findBy(['email'=>$email]);
        return $this->render('achat/index.html.twig', [
            'achats' => $achats,
        ]);
    }

    #[Route('/new', name: 'app_achat_new', methods: ['GET', 'POST'])]
    public function new(MailerInterface $mailer, SessionInterface $session,MobileMoneyRepository $mobileMoneyRepository, ClientRepository $clientRepository, ProduitRepository $produitRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        $user=$this->getUser();
        if(!$user){
            $this->addFlash("info", "Prière de vous connectez avant de confirmer votre achat");
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);

        }
        ///verifier que le mobile money sont déja configuré 
        $mobileMoneys = $mobileMoneyRepository->findAll();
        if(sizeof($mobileMoneys)==0){
            $this->addFlash('info','Contacter pour création des mobiles money....');
            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }
        dd("achat");

        $email=$user->getEmail();
        $client=$clientRepository->findOneBy(['email'=>$email]);
        $achat = new Achat($user);
        // dd($achat->getMobileMoney());
        //ici on recupere la session et on initialise les données dans l'achat 
        $panier=$session->get('panier',[]);
        if($panier==null){
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }
        $dataPanier=[];
        $total=0;
        foreach($panier as $id=>$quantite){
            $produit=$produitRepository->find($id);
            if($produit){
                $dataPanier[]=[
                    'produit'=>$produit,
                    'quantite'=>$quantite,
                ];
                $total +=$produit->getPrixVente() * $quantite;
                $ligneAchat= new LigneAchat();
                $ligneAchat->setProduit($produit);
                $ligneAchat->setQuantite($quantite);
                $ligneAchat->setTotalLigne($quantite * $produit->getPrixVente());
                $achat->addLigneAchat($ligneAchat);    
            }
            
        }
        ///initialiser l objet achat 
        $achat->setPrixTotal($total);

        ////
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($achat);
            $entityManager->flush();
            $session->set("panier",[]);
            $this->addFlash("info","Merci d'avoir effectué votre achat. Vous serez servie dans le delai.");

            $mail= (new Email())
            ->from('info@finasarl.com')
            ->to($achat->getEmail())
            ->text('Merci pour votre achat');
            try{
                $mailer->send($mail);
            }catch(TransportException $e){
                $this->addFlash("danger","Une erreur s'est produite.");
            }
            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/new.html.twig', [
            'mobileMoneys' => $mobileMoneys,
            'total' => $total,
            'dataPanier' => $dataPanier,
            'achat' => $achat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_achat_show', methods: ['GET'])]
    public function show(Achat $achat): Response
    {
        return $this->render('achat/show.html.twig', [
            'achat' => $achat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_achat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Achat $achat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/edit.html.twig', [
            'achat' => $achat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_achat_delete', methods: ['POST'])]
    public function delete(Request $request, Achat $achat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($achat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
    }
}
