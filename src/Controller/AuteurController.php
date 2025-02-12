<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\NsAuthorisation;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AuteurController extends AbstractController
{
    #[Route('/auteur/listfull', name: 'app_auteur')]
    public function listFull(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
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
            $auteurs = $em->getRepository(Auteur::class)->findBy(array()
                , array('nomComplet' => 'ASC'));

            if (!$auteurs) {
                $response->statut = 404;
                $response->message = 'Auteur not found';
                return $this->json($response->getSystemResponse());
            }
            else{
                $auteurs_present =[];
                //filter les auteur dont la longueur de livre n'est pas superieur a 0
                foreach ($auteurs as $auteur) {
                    if(count($auteur->getLivres()) > 0){
                        $auteurs_present[] = $auteur;
                    }
                }
                //var_dump($auteurs_present);
                $response->statut = 200;
                $response->message = 'Auteurs list'.count($auteurs_present).' / '.count($auteurs);
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($auteurs_present, 'json',['groups' => 'auteur:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        return $response->getSystemHttpResponse();
    }
}
