<?php

namespace App\Controller;

use App\Entity\NsAuthorisation;
use App\Entity\NsNiveau;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class NiveauController extends AbstractController
{
    #[Route('/niveau/add', name: 'app_niveau')]
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
                        if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['nbreAnnees'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                       // var_dump($pays);
                        //check if the programme already exist
                        $existNiv = $em->getRepository(NsNiveau::class)->findBy(
                            array(
                                'libelle' => $data['libelle'],
                                'description' => $data['description'])
                        );
                        if($existNiv){
                            $response->statut = 409;
                            $response->message = 'Niveau already exist';
                            //return $this->json($response->getSystemResponse());
                        }
                        else{
                            $niveau = new NsNiveau();
                            $niveau->setLibelle($data['libelle']);
                            $niveau->setDescription($data['description']);
                            $niveau->setNbreAnnees($data['nbreAnnees']);
                            $em->persist($niveau);
                            $em->flush();
                            if($niveau->getId()){
                                $response->statut = 200;
                                $response->message = 'Niveau added';
                                $response->data = [];
                            }
                            else{
                                $response->statut = 500;
                                $response->message = 'System error';
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

    #[Route('/niveau/update', name: 'app_niveau_update')]
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
                        if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['nbreAnnees'])|| !isset($data['id'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        $niveau = $em->getRepository(NsNiveau::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$niveau){
                            $response->statut = 404;
                            $response->message = 'program not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check if the programme already exist
                            
                            $existNiv = $em->getRepository(NsNiveau::class)->findBy(
                                array(
                                    'libelle' => $data['libelle'],
                                     'description' => $data['description'])
                            );
                            if($existNiv){
                                $response->statut = 409;
                                $response->message = 'Niveau already exist';
                                //return $this->json($response->getSystemResponse());
                            }
                            else{
                                $niveau->setLibelle($data['libelle']);
                                $niveau->setDescription($data['description']);
                                $niveau->setNbreAnnees($data['nbreAnnees']);
                                $em->persist($niveau);
                                $em->flush();
                                if($niveau->getId()){
                                    $response->statut = 200;
                                    $response->message = 'Niveau updated';
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
    #[Route('/niveau/delete', name: 'app_niveau_delete')]
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
                        $niveau = $em->getRepository(NsNiveau::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$niveau){
                            $response->statut = 404;
                            $response->message = 'Niveau not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check all the linked entity suppression cascade delete
                            
                            //delete the programme
                            $em->remove($niveau);
                            $em->flush();
                            $response->statut = 200;
                            $response->message = 'Niveau deleted';
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

    #[Route('/niveau/listfull', name: 'app_niveau_listFull', methods: ['GET'])]
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
                $niveaus = $em->getRepository(NsNiveau::class)->findAll();

                if (!$niveaus) {
                    $response->statut = 404;
                    $response->message = 'Niveaus not found';
                    return $this->json($response->getSystemResponse());
                }
                else{
                    
                    $response->statut = 200;
                    $response->message = 'Niveaus list';
                    //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsProgramme\" (configured limit: 1)
                    //return $this->json($niveaus);
                    $response->data = json_decode($serializer->serialize($niveaus, 'json', ['circular_reference_handler' => function ($object) {
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
