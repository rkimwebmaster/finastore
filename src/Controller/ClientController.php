<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client_index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        // dd("jambo");
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //creation du client associé 
            $email = $client->getAdresse()->getEmail();
            // $password = $email.$email;
            // dd($password);

            // $user = $this->creationUser($client, $userPasswordHasher, $entityManager);
            // dd($user->getPassword());
            // if($user->getEmail()===null){
            //     return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);

            // }
            ///// creation user 
            $email = $client->getAdresse()->getEmail();
            $user = new User();
            $user->setRoles(['ROLE_CLIENT']);        
            $checkUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
            if ($checkUser) {
                $this->addFlash('danger', 'Un utilisateur existe déja avec la même adresse mail.');
                return $user;
            }
            $user->setEmail($email);
            $password = $client->getPassword();
            // dd($password);
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $password
                )
            );
            // dd($user->getPassword());
            // $entityManager->persist($user);
            // $entityManager->flush();
            $this->addFlash('success', 'Vous êtes enregistré comme client. Login: ' . $email . ' Mot de passe : ' . $password);
            /////fin creation user 

            $client->setUtilisateur($user);
            $client->setPassword($password);
            $entityManager->persist($user);
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_show', methods: ['GET'])]
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    }

    private function creationUser(Client $client, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): User
    {
        // $email = $client->getAdresse()->getEmail();
        // $user = new User();
        // $user->setRoles(['ROLE_CLIENT']);        
        // $checkUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        // if ($checkUser) {
        //     $this->addFlash('danger', 'Un utilisateur existe déja avec la même adresse mail.');
        //     return $user;
        // }
        // $user->setEmail($email);
        // $password = $email.$email;
        // dd($password);
        // // encode the plain password
        // $user->setPassword(
        //     $userPasswordHasher->hashPassword(
        //         $user,
        //         $password
        //     )
        // );
        // // dd('test');
        // // $entityManager->persist($user);
        // // $entityManager->flush();
        // $this->addFlash('success', 'Vous êtes enregistré comme client. Login: ' . $email . ' Mot de passe : ' . $password);
        // return $user;
    }
}
