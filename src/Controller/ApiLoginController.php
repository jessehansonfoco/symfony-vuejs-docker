<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

#[AsController]
class ApiLoginController extends AbstractController
{

    #[Route('/login/api', name: 'api_login', methods: ['POST'])]
    public function index(#[CurrentUser] ?User $user, EntityManagerInterface $entityManager): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $apiKey = sha1(microtime() . $user->getCreatedAt()->getTimestamp() . md5($user->getPassword()));
        $user->setApiKey($apiKey);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            'email' => $user->getUserIdentifier(),
            'api_key' => $apiKey,
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'roles' => $user->getRoles(),
        ]);
    }
}
