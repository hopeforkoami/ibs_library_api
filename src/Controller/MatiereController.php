<?php

namespace App\Controller;

use App\Entity\NsAuthorisation;
use App\Entity\NsMatiere;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MatiereController extends AbstractController
{
    #[Route('/matiere/add', name: 'app_matiere')]
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
                        if(!isset($data['libelle']) || !isset($data['description']) ){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check if the programme already exist
                            $existMatiere = $em->getRepository(NsMatiere::class)->findBy(
                                array(
                                    'libelle' => $data['libelle'],
                                     'description' => $data['description'])
                            );
                            if($existMatiere){
                                $response->statut = 409;
                                $response->message = 'the matiere already exist';
                                //return $this->json($response->getSystemResponse());
                            }
                            else{
                                $matiere = new NsMatiere();
                                $matiere->setLibelle($data['libelle']);
                                $matiere->setDescription($data['description']);
                                $em->persist($matiere);
                                $em->flush();
                                if($matiere->getId()){
                                    $response->statut = 200;
                                    $response->message = 'the matiere added';
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

    #[Route('/matiere/update', name: 'app_matiere_update')]
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
                        if(!isset($data['libelle']) || !isset($data['description']) || !isset($data['id'])){
                            $response->statut = 400;
                            $response->message = 'Bad request';
                            return $this->json($response->getSystemResponse());
                        }
                        $matiere = $em->getRepository(NsMatiere::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$matiere){
                            $response->statut = 404;
                            $response->message = 'program not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check if the programme already exist
                            
                            $existMatiere = $em->getRepository(NsMatiere::class)->findBy(
                                array(
                                    'libelle' => $data['libelle'],
                                     'description' => $data['description'])
                            );
                            if($existMatiere){
                                $response->statut = 409;
                                $response->message = 'the matiere already exist';
                                //return $this->json($response->getSystemResponse());
                            }
                            else{
                                $matiere->setLibelle($data['libelle']);
                                $matiere->setDescription($data['description']);
                                $em->persist($matiere);
                                $em->flush();
                                if($matiere->getId()){
                                    $response->statut = 200;
                                    $response->message = 'the matiere updated';
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
    #[Route('/matiere/delete', name: 'app_matiere_delete')]
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
                        $matiere = $em->getRepository(NsMatiere::class)->find($data['id']);
                       // var_dump($pays);
                        if(!$matiere){
                            $response->statut = 404;
                            $response->message = 'program not found or already deleted';
                            return $this->json($response->getSystemResponse());
                        }
                        else{
                            //check all the linked entity suppression cascade delete
                            
                            //delete the programme
                            $em->remove($matiere);
                            $em->flush();
                            $response->statut = 200;
                            $response->message = 'the matiere deleted';
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

    #[Route('/matiere/listfull', name: 'app_matiere_listFull', methods: ['GET'])]
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
                $matieres = $em->getRepository(NsMatiere::class)->findAll();

                if (!$matieres) {
                    $response->statut = 404;
                    $response->message = 'the matieres not found';
                    return $this->json($response->getSystemResponse());
                }
                else{
                    
                    $response->statut = 200;
                    $response->message = 'the matieres list';
                    //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsProgramme\" (configured limit: 1)
                    //return $this->json($matieres);
                    $response->data = json_decode($serializer->serialize($matieres, 'json', ['circular_reference_handler' => function ($object) {
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
