<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setBlogPostSlug'],
        ];
    }

    public function setBlogPostSlug(BeforeEntityPersistedEvent $event)
    {
        $user = $event->getEntityInstance();

        if (!($user instanceof User)) {
            return;
        }

        $password = $user->getPassword();

        $user->setRoles(['ROLE_ADMIN']);
        $user->setRolePrincipal('Administrateur ');

        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                $password
            )
        );
        // dd($user);
        // $entity->setSlug($slug);
    }
}