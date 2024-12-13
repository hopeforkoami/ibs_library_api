<?php

namespace App\Controller;

use App\Entity\NsAuthorisation;
use App\Entity\NsSerie;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SerieController extends AbstractController
{
    #[Route('/serie/add', name: 'app_serie')]
    public function add(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
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
                    //check if the user has the right to add a programme
                    if($auth->checkUserRight($token, 1)){
                        if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['displayName'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check if the programme already exist
                            $existSerie = $em->getRepository(NsSerie::class)->findBy(
                                array(
                                    'libelle' => $data['libelle'],
                                     'displayName' => $data['displayName'])
                            );
                            if($existSerie){
                                $response->statut = 409;
                                $response->message = 'Serie already exist';
                                //return $this->json($response->getSystemResponse());
                            }
                            else{
                                $serie = new NsSerie();
                                $serie->setLibelle($data['libelle']);
                                $serie->setDescription($data['description']);
                                $serie->setDisplayName($data['displayName']);
                                //check if data['tags'] is set and not empty
                                if(isset($data['tags'])&&(!empty($data['tags']))){
                                    $serie->setTags($data['tags']);
                                }
                                else{
                                    $serie->setTags('');
                                }
                                $em->persist($serie);
                                $em->flush();
                                if($serie->getId()){
                                    $response->statut = 200;
                                    $response->message = 'Serie added';
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
                        $response->message = 'Unauthorized';
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

    #[Route('/serie/update', name: 'app_serie_update')]
    public function update(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'PUT') {
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
                    //check if the user has the right to add a programme
                    if($auth->checkUserRight($token, 1)){
                        if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['displayName'])|| !isset($data['id'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        $serie = $em->getRepository(NsSerie::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$serie){
                            $response->statut = 404;
                            $response->message = 'serie not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check if the programme already exist
                            
                            $existSerie = $em->getRepository(NsSerie::class)->findBy(
                                array(
                                    'libelle' => $data['libelle'],
                                     'displayName' => $data['displayName'])
                            );
                            if($existSerie){
                                $response->statut = 409;
                                $response->message = 'Serie already exist';
                                //return $this->json($response->getSystemResponse());
                            }
                            else{
                                $serie->setLibelle($data['libelle']);
                                $serie->setDescription($data['description']);
                                $serie->setDisplayName($data['displayName']);
                                $serie->setTags($data['tags']??'');
                                $em->persist($serie);
                                $em->flush();
                                if($serie->getId()){
                                    $response->statut = 200;
                                    $response->message = 'Serie updated';
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
                        $response->message = 'Unauthorized';
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
    #[Route('/serie/delete', name: 'app_serie_delete')]
    public function delete(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'DELETE') {
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
                    //check if the user has the right to add a programme
                    if($auth->checkUserRight($token, 1)){
                        if(!isset($data['id'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        $serie = $em->getRepository(NsSerie::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$serie){
                            $response->statut = 404;
                            $response->message = 'serie not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check all the linked entity suppression cascade delete
                            
                            //delete the programme
                            $em->remove($serie);
                            $em->flush();
                            $response->statut = 200;
                            $response->message = 'Serie deleted';
                            $response->data = [];

                            
                            
                            
                        }
                        
                    }
                    else{
                        $response->statut = 401;
                        $response->message = 'Unauthorized';
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

    #[Route('/serie/listfull', name: 'app_serie_listFull', methods: ['GET'])]
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
            if ($auth->checkUserRight($token, 1)) {
                // Fetch all programmes
                $series = $em->getRepository(NsSerie::class)->findAll();

                if (!$series) {
                    $response->statut = 404;
                    $response->message = 'Series not found';
                    return $this->json($response->getSystemResponse());
                }
                else{
                    
                    $response->statut = 200;
                    $response->message = 'Series list';
                    //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                    //return $this->json($series);
                    $response->data = json_decode($serializer->serialize($series, 'json', ['circular_reference_handler' => function ($object) {
                        return $object->getId();
                    }])) ;
                }

            } else {
                $response->statut = 401;
                $response->message = 'Unauthorized';
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        return $this->json($response->getSystemResponse());
    }
}
