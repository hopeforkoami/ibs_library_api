<?php

namespace App\Controller;

use App\Entity\NsAuthorisation;
use App\Entity\NsPays;
use App\Entity\NsProgramme;
use App\Modele\NogCustomedFunctions;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProgrammeController extends AbstractController
{
    #[Route('/programme/add', name: 'app_programme')]
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
                        if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['pays'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        $pays = $em->getRepository(NsPays::class)->find($data['pays']);
                       // var_dump($pays);
                        if(!$pays){
                            $response->statut = 404;
                            $response->message = 'Country not found';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check if the programme already exist
                            $existProg = $em->getRepository(NsProgramme::class)->findBy(
                                array(
                                    'libelle' => $data['libelle'],
                                     'pays' => $pays)
                            );
                            if($existProg){
                                $response->statut = 409;
                                $response->message = 'Programme already exist';
                                //return $this->json($response->getSystemResponse());
                            }
                            else{
                                $programme = new NsProgramme();
                                $programme->setLibelle($data['libelle']);
                                $programme->setDescription($data['description']);
                                $programme->setPays($pays);
                                $em->persist($programme);
                                $em->flush();
                                if($programme->getId()){
                                    $response->statut = 200;
                                    $response->message = 'Programme added';
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

    #[Route('/programme/update', name: 'app_programme_update')]
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
                        if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['pays'])|| !isset($data['id'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        $pays = $em->getRepository(NsPays::class)->find($data['pays']);
                        $programe = $em->getRepository(NsProgramme::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$programe){
                            $response->statut = 404;
                            $response->message = 'program not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        if(!$pays){
                            $response->statut = 404;
                            $response->message = 'Country not found';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check if the programme already exist
                            
                            $existProg = $em->getRepository(NsProgramme::class)->findBy(
                                array(
                                    'libelle' => $data['libelle'],
                                     'pays' => $pays)
                            );
                            if($existProg){
                                $response->statut = 409;
                                $response->message = 'Programme already exist';
                                //return $this->json($response->getSystemResponse());
                            }
                            else{
                                $programe->setLibelle($data['libelle']);
                                $programe->setDescription($data['description']);
                                $programe->setPays($pays);
                                $em->persist($programe);
                                $em->flush();
                                if($programe->getId()){
                                    $response->statut = 200;
                                    $response->message = 'Programme updated';
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
    #[Route('/programme/delete', name: 'app_programme_delete')]
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
                        $programe = $em->getRepository(NsProgramme::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$programe){
                            $response->statut = 404;
                            $response->message = 'program not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check all the linked entity suppression cascade delete
                            
                            //delete the programme
                            $em->remove($programe);
                            $em->flush();
                            $response->statut = 200;
                            $response->message = 'Programme deleted';
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

    #[Route('/programme/listfull', name: 'app_programme_listFull', methods: ['GET'])]
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
                $programmes = $em->getRepository(NsProgramme::class)->findAll();

                if (!$programmes) {
                    $response->statut = 404;
                    $response->message = 'Programmes not found';
                    return $this->json($response->getSystemResponse());
                }
                else{
                    
                    $response->statut = 200;
                    $response->message = 'Programmes list';
                    //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsProgramme\" (configured limit: 1)
                    //return $this->json($programmes);
                    $response->data = json_decode($serializer->serialize($programmes, 'json', ['circular_reference_handler' => function ($object) {
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
