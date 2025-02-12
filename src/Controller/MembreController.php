<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\NsAuthorisation;
use App\Modele\NogSystemResponse;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        
        $httpResponse = new Response(
            $this->json($response->getSystemResponse()),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
         //$response->headers->set('Access-Control-Allow-Headers', '*');
         $httpResponse->headers->set('Access-Control-Allow-Origin', '*');
         $httpResponse->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
         $httpResponse->headers->set('Content-Type', 'application/json');
        return $httpResponse;
    }

    #[Route('/user/delete', name: 'app_user_delete', methods: ['DELETE'])]
     public function deleteMembre(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'DELETE') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemResponse());
        }

        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $id = $request->query->get('id', 0);
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            // Check if the user has the correct rights
            // Fetch all programmes
            $membre = $em->getRepository(Membre::class)->find($id);
            //on supprime si le livre existe
            if($membre){
                $em->remove($membre);
                $em->flush();
                $response->statut = 200;
                $response->message = 'member deleted';
                return $this->json($response->getSystemResponse());
            }
            else{
                $response->statut = 404;
                $response->message = 'member not found';
                return $this->json($response->getSystemResponse());
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }

    #[Route('/user/details', name: 'app_user_details', methods: ['GET'])]
    public function details(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'GET') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemResponse());
        }

        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $id = $request->query->get('id', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            // Check if the user has the correct rights
            // Fetch all programmes
            $membre = $em->getRepository(Membre::class)->find($id);

            if (!$membre) {
                $response->statut = 404;
                $response->message = 'member not found';
                return $this->json($response->getSystemHttpResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'member details';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($membre, 'json',['groups' => 'member:fulldetails'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }

    #[Route('/user/listfull', name: 'app_user_list_full', methods: ['GET'])]
    public function listAll(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'GET') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemResponse());
        }

        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            // Check if the user has the correct rights
            // Fetch all programmes
            $membres = $em->getRepository(Membre::class)->findAll();

            if (!$membres) {
                $response->statut = 404;
                $response->message = 'member not found';
                return $this->json($response->getSystemHttpResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'members list';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($membres, 'json',['groups' => 'member:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }

}
