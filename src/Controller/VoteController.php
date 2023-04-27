<?php

namespace App\Controller;

use App\Entity\Vote;
use App\Entity\Bet;
use App\Form\VoteType;
use App\Repository\VoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

#[Route('/vote')]
class VoteController extends AbstractController
{
    #[Route('/', name: 'app_vote_index', methods: ['GET'])]
    public function index(VoteRepository $voteRepository): Response
    {
        return $this->render('vote/index.html.twig', [
            'votes' => $voteRepository->findAll(),
        ]);
    }

    #[Route('/new/{bet_id}', name: 'app_vote_new', methods: ['GET', 'POST'])]
    #[Entity('bet', expr: 'repository.find(bet_id)')]
    public function new(Request $request, VoteRepository $voteRepository, Bet $bet): Response
    {
        $vote = new Vote();
        $vote->setBet($bet);
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voteRepository->save($vote, true);

            return $this->redirectToRoute('app_bet_show', ['id' => $bet->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vote/new.html.twig', [
            'vote' => $vote,
            'form' => $form,
            'bet' => $bet,
        ]);
    }

    #[Route('/{id}', name: 'app_vote_show', methods: ['GET'])]
    public function show(Vote $vote): Response
    {
        return $this->render('vote/show.html.twig', [
            'vote' => $vote,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vote_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vote $vote, VoteRepository $voteRepository): Response
    {
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $voteRepository->save($vote, true);

            return $this->redirectToRoute('app_vote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vote/edit.html.twig', [
            'vote' => $vote,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vote_delete', methods: ['POST'])]
    public function delete(Request $request, Vote $vote, VoteRepository $voteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vote->getId(), $request->request->get('_token'))) {
            $voteRepository->remove($vote, true);
        }

        return $this->redirectToRoute('app_vote_index', [], Response::HTTP_SEE_OTHER);
    }
}
