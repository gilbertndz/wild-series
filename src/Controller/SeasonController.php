<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;

#[Route('/program/{id}/seasons', name: 'program_season_')]
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

    #[Route('/{seasonId}', methods: ['GET'], requirements: ['seasonId'=>'\d+'], name: 'show')]
    public function show(int $id, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository, ProgramRepository $programRepository): Response
    {
        $season = $seasonRepository-> findOneBy(['id' => $id]);
        $program = $programRepository->findOneBy(['id' => $id]);
        $episodes = $episodeRepository->findAll();
        
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : '.$id.' found in season\'s table.'
            );
        }
        return $this->render('season/show.html.twig', [
            'season' => $season,
            'program' => $program,
            'episodes' => $episodes,
        ]);
    }
}