<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserExistsController extends AbstractController
{
    #[Route('/api/user/exists', name: 'app_user_exists', methods: ['GET'])]
    public function index(Request $request, ManagerRegistry $mr): Response
    {
        // parse query string to array
        parse_str($request->getQueryString(), $query);

        // check if `type` key exists in query
        if ( !$this->arrKeyExists('type', $query) )
        {
            return $this->json([
                'error' => 'No required parameters provided'
            ]);
        }

        // check if `q` key exists in query
        if ( !$this->arrKeyExists('q', $query) )
        {
            return $this->json([
                'error' => 'No required parameters provided'
            ]);
        }
        $entityManager = $mr->getManager();
        $userRepository = $entityManager->getRepository(User::class);

        switch ( $query['type'] )
        {
            case 'username':
                if ( !$userRepository->findBy(['username' => $query['q']]) )
                {
                    return $this->json(false);
                }

                return $this->json(true);

            case 'email':
                if ( !$userRepository->findBy(['email' => $query['q']]) )
                {
                    return $this->json(false);
                }

                return $this->json(true);
                
            default:
                return $this->json([
                    'error' => 'No required parameters provided'
                ]);
        }
    }

    public function arrKeyExists(string $key, array $query): bool
    {
        return array_key_exists($key, $query);
    }
}
