<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Jeu;
use App\Entity\Livre;
use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StatsController extends AbstractController
{
    #[Route('/recette/stats', name: 'app_recette_stats')]
    public function stats(RecetteRepository $recetteRepository): Response
    {
        $stats = $recetteRepository->getStats(4);

        return $this->render('recette/stats/index.html.twig', [
            'stats' => $stats
        ]);
    }
}
