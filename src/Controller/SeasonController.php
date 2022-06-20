<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;

#[Route('/season', name: 'season_')]
class SeasonController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SeasonRepository $seasonRepository): Response
    {
        $seasons = $seasonRepository->findAll();

        return $this->render('season/index.html.twig', [
            'seasons' => $seasons,
         ]);
    }

    #[Route('/{id}', methods: ['GET'], requirements: ['id'=>'\d+'], name: 'show')]
    public function show(int $id, SeasonRepository $seasonRepository): Response
    {
        $season = $seasonRepository-> findOneBy(['id' => $id]);
        
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : '.$id.' found in season\'s table.'
            );
        }
        return $this->render('season/show.html.twig', [
            'season' => $season,
        ]);
    }
}