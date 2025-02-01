<?php

namespace App\Controller;

use App\Entity\NsAuthorisation;
use App\Entity\SousCategorie;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CategorieController extends AbstractController
{
    #[Route('/categorie/add', name: 'app_categorie')]
    public function addCategorie(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
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
                //on verifie si le token dans le post est valide
                $data = json_decode($request->getContent(), true);
                $token = $data['token'];
                //$nogCustomedFunctions = new NogCustomedFunctions();
                $auth = $em->getRepository(NsAuthorisation::class);
               
                if($auth->checkTokenValidity($token)){
                    //$nogCustomedFunctions->checkUserRight($token, $nogCustomedFunctions->ADMIN);
                    if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['displayName'])){
                        $response->statut = 400;
                        $response->message = 'Bad request';
                        return $this->json($response->getSystemResponse());
                    }
                    else{
                        //check if the programme already exist
                        $existCategorie = $em->getRepository(SousCategorie::class)->findBy(
                            array(
                                'libelle' => $data['libelle'])
                        );
                        if($existCategorie){
                            $response->statut = 409;
                            $response->message = 'the Category already exist';
                            //return $this->json($response->getSystemResponse());
                        }
                        else{
                            $categorie = new SousCategorie();
                            $categorie->setLibelle($data['libelle']);
                            $categorie->setDescription($data['description']);
                            
                            $em->persist($categorie);
                            $em->flush();
                            if($categorie->getId()){
                                $response->statut = 200;
                                $response->message = 'categorie added';
                                $response->data = [];
                            }
                            else{
                                $response->statut = 500;
                                $response->message = 'System error';
                            }
                        }
                        
                    }
                    
                    
                }
                else{
                    $response->statut = 401;
                    $response->message = 'Token expired';
                }


            }
        }

        return $this->json($response->getSystemResponse());
    }

    #[Route('/categorie/listfull', name: 'app_categorie_listFull', methods: ['GET'])]
    public function listFull(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
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
            $categorie = $em->getRepository(SousCategorie::class)->findBy(array()
                , array('libelle' => 'ASC'));

            if (!$categorie) {
                $response->statut = 404;
                $response->message = 'Category not found';
                return $this->json($response->getSystemResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'categorie list';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($categorie, 'json',['groups' => 'categorie:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        return $this->json($response->getSystemResponse());
    }
}
