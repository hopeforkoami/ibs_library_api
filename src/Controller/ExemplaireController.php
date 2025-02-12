<?php

namespace App\Controller;

use App\Entity\ExemplaireLivre;
use App\Entity\Livre;
use App\Entity\NsAuthorisation;
use App\Entity\Position;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ExemplaireController extends AbstractController
{
    #[Route('/exemplaire/add', name: 'app_exemplaire_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'PUT') {
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
                $token = $data['token'];
                //$nogCustomedFunctions = new NogCustomedFunctions();
                $auth = $em->getRepository(NsAuthorisation::class);
               
                if($auth->checkTokenValidity($token)){
                    //$nogCustomedFunctions->checkUserRight($token, $nogCustomedFunctions->ADMIN);
                    //check if the user has the right to add a programme
                    if (!isset($data['livre']) || !isset($data['position']) || !isset($data['numero'])) {
                        $response->statut = 400;
                        $response->message = 'Bad request';
                        return $this->json($response->getSystemHttpResponse());
                    }
                    $exemplaire = $em->getRepository(ExemplaireLivre::class)->findBy(array(
                        'livre' => $data['livre'], 
                        'numero' => $data['numero']));
                   // var_dump($pays);
                    if($exemplaire){
                        $response->statut = 409;
                        $response->message = 'exemplaire already existe already exist';
                        return $response->getSystemHttpResponse();
                    }
                    else{
                        
                        //update the livre
                        //libelle,auteur_id_id, image, isbn, edition, resume,  langue_id_id, sous_categorie_id_id
                        $exemplaire = new ExemplaireLivre();
                        $exemplaire->setNumero($data['numero']);
                        $exemplaire->setLibre(true);
                        $exemplaire->setDateDisponible(new \DateTime('now'));
                        $exemplaire->setLivre($em->getRepository(Livre::class)->find($data['livre']));
                        $exemplaire->setPosition($em->getRepository(Position::class)->find($data['position']));                          
                        $em->persist($exemplaire);
                        $em->flush();
                        if($exemplaire->getId()){
                            $response->statut = 200;
                            $response->message = 'exemplaire updated';
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
                    $response->message = 'Token expired';
                }


            }
        }

        return $this->json($response->getSystemResponse());
    }

    #[Route('/exemplaire/delete', name: 'app_exemplaire_delete', methods: ['DELETE'])]
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
            $exemplaire = $em->getRepository(ExemplaireLivre::class)->find($id);
            //on supprime si le livre existe
            if($exemplaire){
                $em->remove($exemplaire);
                $em->flush();
                $response->statut = 200;
                $response->message = 'Exemplaire deleted';
                return $response->getSystemHttpResponse();
            }
            else{
                $response->statut = 404;
                $response->message = 'exemplaire not found';
                return $response->getSystemHttpResponse();
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }

    #[Route('/exemplaire/update', name: 'app_exemplaire_update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500,'system error',[]);
        //on verifie la methode de la requete est post
        if ($request->getMethod() != 'PUT') {
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
                $token = $data['token'];
                //$nogCustomedFunctions = new NogCustomedFunctions();
                $auth = $em->getRepository(NsAuthorisation::class);
               
                if($auth->checkTokenValidity($token)){
                    //$nogCustomedFunctions->checkUserRight($token, $nogCustomedFunctions->ADMIN);
                    //check if the user has the right to add a programme
                    if (!isset($data['livre']) || !isset($data['position']) || !isset($data['numero'])|| !isset($data['id'])) {
                        $response->statut = 400;
                        $response->message = 'Bad request';
                        return $this->json($response->getSystemHttpResponse());
                    }
                    $exemplaire = $em->getRepository(ExemplaireLivre::class)->find($data['id']);
                    if(!$exemplaire){
                        $response->statut = 409;
                        $response->message = 'exemplaire not found or already deleted';
                        return $response->getSystemHttpResponse();
                    }
                    else{
                        
                        //update the exemplaire
                        $exemplaire = $em->getRepository(ExemplaireLivre::class)->find($data['id']);
                        $exemplaire->setNumero($data['numero']);
                        $exemplaire->setLibre($data['libre']??true);
                        $exemplaire->setDateDisponible(new \DateTime($data['dateDisponible']??'now'));
                        $exemplaire->setLivre($em->getRepository(Livre::class)->find($data['livre']));
                        $exemplaire->setPosition($em->getRepository(Position::class)->find($data['position']));                          
                        $em->persist($exemplaire);
                        $em->flush();
                        if($exemplaire->getId()){
                            $response->statut = 200;
                            $response->message = 'exemplaire updated';
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
                    $response->message = 'Token expired';
                }


            }
        }

        return $this->json($response->getSystemResponse());
    }
}
