<?php

namespace App\EventSubscriber;

use App\Repository\CategorieRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $entrepriseRepository;
    private $serviceRepository;
    private $categorieRepository;

    public function __construct(Environment $twig, EntrepriseRepository $entrepriseRepository, ServiceRepository $serviceRepository, CategorieRepository $categorieRepository)
    {
        $this->twig = $twig;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->categorieRepository = $categorieRepository;
        $this->serviceRepository = $serviceRepository;
    }
    public function onKernelController(ControllerEvent $event)
    {
        $this->twig->addGlobal('entreprise', $this->entrepriseRepository->findOneBy([]));
        $this->twig->addGlobal('services', $this->serviceRepository->findAll([]));
        $this->twig->addGlobal('categories', $this->categorieRepository->findAll([]));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
