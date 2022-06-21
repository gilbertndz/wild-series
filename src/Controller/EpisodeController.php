<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

#[Route('/episode', name: 'program_episode_')]
class EpisodeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EpisodeRepository $episodeRepository): Response
    {
        $episodes = $episodeRepository->findAll();

        return $this->render('episode/index.html.twig', [
            'episodes' => $episodes,
         ]);
    }

    #[Route('/program/{programId}/season/{seasonId}/episode/{episodeId}', methods: ['GET'], requirements: ['episodeId'=>'\d+'], name: 'show')]
    #[Entity('program', options: ['id' => 'programId'])]
    #[Entity('season', options: ['id' => 'seasonId'])]
    #[Entity('episode', options: ['id' => 'episodeId'])]
    public function show(Season $season, Episode $episode, Program $program): Response
    {
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : '.$id.' found in season\'s table.'
            );
        }
        return $this->render('episode/show.html.twig', [
            'season' => $season,
            'program' => $program,
            'episode' => $episode,
        ]);
    }
}