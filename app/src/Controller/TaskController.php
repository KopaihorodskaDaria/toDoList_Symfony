<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TaskRepository;


final class TaskController extends AbstractController
{
    #[Route('/task', name: 'task_index')]
    public function index(TaskRepository $taskRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw new AccessDeniedException('You must be logged in to view tasks.');
        }

        $tasks = $taskRepository->findBy(['user' => $user]);

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

}
