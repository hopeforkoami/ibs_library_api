<?php

namespace App\Controller;

use App\Entity\NsAuthorisation;
use App\Modele\NogSystemResponse;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MembreController extends AbstractController
{
    #[Route('/userLogin', name: 'app_membre_login')]
    public function login(Request $request, SerializerInterface $serializer, EntityManagerInterface $em,  MembreRepository $userRepositor): JsonResponse
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //checking the request method to be post
        if ($request->getMethod() != 'POST') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemResponse());
        }
        else{
            if (!$request->getContent()) {
                $response->statut = 400;
                $response->message = 'Bad request';
                return $this->json($response->getSystemResponse());
            }
            else{
                $data = json_decode($request->getContent(), true);
                $user = $userRepositor->findOneBy(['login' => $data['login'], 'password' =>md5($data['password'])]);
                if ($user) {
                    //on cree une nouvelle NsAuthorisation avec l'utilisateur en generant un token
                    $authorisation = new NsAuthorisation();
                    $authorisation->setUser($user);
                    $authorisation->setToken(md5(uniqid()));
                    $authorisation->setDateDebut(new \DateTime('now'));
                    $authorisation->setDateFin(new \DateTime('now + 1 hour'));
                    $authorisation->setValide(true);
                    $em->persist($authorisation);
                    $em->flush();
                    //on verifie si l'authorisation est bien enregistrer
                    if ($authorisation->getId()) {
                        $response->statut = 200;
                        $response->message = 'Login success';
                        $response->data = ['token' => $authorisation->getToken()];
                    } else {
                        $response->statut = 500;
                        $response->message = 'System error';
                    }
                } else {
                    $response->statut = 404;
                    $response->message = 'User not found';
                }
            }
            
        }
        
        
        return $this->json($response->getSystemResponse());
    }
}
