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
}
