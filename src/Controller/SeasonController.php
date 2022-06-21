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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

#[Route('/program/{programId}/seasons', name: 'program_season_')]
#[Entity('program', options: ['id' => 'programId'])]
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
    #[Entity('season', options: ['id' => 'seasonId'])]
    public function show(Season $season, EpisodeRepository $episodeRepository, Program $program): Response
    {
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