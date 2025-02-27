<?php

namespace App\Controller;

use App\Entity\Colonne;
use App\Entity\NsAuthorisation;
use App\Entity\Position;
use App\Entity\Ranger;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PositionController extends AbstractController
{
    #[Route('/position/add', name: 'app_position_add', methods: ['POST', 'OPTIONS'])]
    public function addIfNotExist(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'POST') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $response->getSystemHttpResponse();
        }
        else{
            if (!$request->getContent()) {
                $response->statut = 400;
                $response->message = 'Bad request';
                return $response->getSystemHttpResponse();
            }
            else{
                //on verifie si le token dans le post est valide
                $data = json_decode($request->getContent(), true);
                $token = $request->query->get('token', '');
                //$nogCustomedFunctions = new NogCustomedFunctions();
                $auth = $em->getRepository(NsAuthorisation::class);
               
                if($auth->checkTokenValidity($token)){
                    //$nogCustomedFunctions->checkUserRight($token, $nogCustomedFunctions->ADMIN);
                    //check if the user has the right to add a programme
                    if (!isset($data['ranger']) || !isset($data['colonne']) || !isset($data['numero']) ) {
                        $response->statut = 400;
                        $response->message = 'Bad request';
                        return $this->json($response->getSystemHttpResponse());
                    }
                    $ranger = $em->getRepository(Ranger::class)->findBy(array('libelle' => $data['ranger']));
                    $colonne = $em->getRepository(Colonne::class)->findBy(array('libelle' => $data['colonne']));
                    $position = $em->getRepository(Position::class)->findBy(array(
                        'ranger' => $ranger[0], 
                        'colonne' => $colonne[0],
                        'numero' => $data['numero']));
                   // var_dump($pays);
                    if($position){
                        $response->statut = 409;
                        $response->message = 'la Position already exist';
                        $response->data = json_decode($serializer->serialize($position[0], 'json',['groups' => 'position:read']));
                        return $response->getSystemHttpResponse();
                    }
                    else{
                        
                        //update the livre
                        //libelle,auteur_id_id, image, isbn, edition, resume,  langue_id_id, sous_categorie_id_id
                        $position = new Position();
                        $position->setRanger($ranger[0]);
                        $position->setColonne($colonne[0]);
                        $position->setNumero($data['numero']);
                        $libelle = "R".$position->getRanger()->getId()."C".$position->getColonne()->getId()."_".$position->getNumero();
                        $position->setLibelle($data['libelle']?? $libelle);
                        $em->persist($position);
                        $em->flush();
                        if($position->getId()){
                            $response->statut = 200;
                            $response->message = 'position created';
                            $response->data = json_decode($serializer->serialize($position, 'json',['groups' => 'position:read']));
                        }
                        else{
                            $response->statut = 500;
                            $response->message = 'System error';
                        }
                        
                        
                        
                    }
                    
                }
                else{
                    $response->statut = 401;
                    $response->message = 'Token expired';
                }


            }
        }

        return $response->getSystemHttpResponse();
    }
    #[Route('/colonnes/list', name: 'app_colonne_list', methods: ['GET'])]
    public function listColonne(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'GET') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $response->getSystemHttpResponse();
        }

        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            $colonnes = $em->getRepository(Colonne::class)->findAll();
            // Fetch all colonnes

            if (!$colonnes) {
                $response->statut = 404;
                $response->message = 'colonnes not found ';
                return $response->getSystemHttpResponse();
            }
            else{
                
                $response->statut = 200;
                $response->message = 'colonnes list';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($colonnes, 'json',['groups' => 'colonne:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        return $response->getSystemHttpResponse();
    }

    #[Route('/rangers/list', name: 'app_ranger_list', methods: ['GET'])]
    public function listRanger(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'GET') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $response->getSystemHttpResponse();
        }

        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            $rangers = $em->getRepository(Ranger::class)->findAll();
            // Fetch all colonnes

            if (!$rangers) {
                $response->statut = 404;
                $response->message = 'rangerd not found ';
                return $response->getSystemHttpResponse();
            }
            else{
                
                $response->statut = 200;
                $response->message = 'rangers list';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($rangers, 'json',['groups' => 'ranger:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        return $response->getSystemHttpResponse();
    }
}
