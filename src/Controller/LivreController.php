<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Langue;
use App\Entity\Livre;
use App\Entity\NsAuthorisation;
use App\Entity\SousCategorie;
use App\Modele\NogSystemResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LivreController extends AbstractController
{
    
    #[Route('/livre/add', name: 'app_livre_add', methods: ['POST'])]
    public function addLivre(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        
        // Check if the request method is GET
        if ($request->getMethod() != 'POST') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemHttpResponse());
        }
         $data = json_decode($request->getContent(), true);
        // Retrieve the token from GET parameters
        $token = $request->query->get('token', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            // Check if the user has the correct rights
            /**
             * les differents parametres de la requete
             * auteur, langue, libelle, categorie, nbrePage, nreExemplaire, image, isbn, edition, resume, tags, themes
             */
           
            if (!isset($data['libelle']) || !isset($data['resume']) || !isset($data['auteur'])|| !isset($data['langue'])|| !isset($data['sous_categorie'])|| !isset($data['isbn'])|| !isset($data['edition'])|| !isset($data['image']) || !isset($data['tags']) || !isset($data['themes'])|| !isset($data['nbreExemplaire'])|| !isset($data['nbrePage'])) {
                $response->statut = 400;
                $response->message = 'Bad request';
                return $this->json($response->getSystemHttpResponse());
            }
            //on si un libre existe avec le meme libelle et isbn
            $livre = $em->getRepository(Livre::class)->findOneBy(['libelle' => $data['libelle'], 'isbn' => $data['isbn']]);
            if($livre)
            {
                $response->statut = 409;
                $response->message = 'livre already exist';
                return $this->json($response->getSystemHttpResponse());
            }
            else{
                $livre = new Livre();
                $livre->setLibelle($data['libelle']);
                $livre->setImage($data['image']);
                $livre->setIsbn($data['isbn']);
                $livre->setEdition($data['edition']);
                $livre->setResume($data['resume']);
                $livre->setAuteurId($em->getRepository(Auteur::class)->find($data['auteur']));
                $livre->setLangueId($em->getRepository(Langue::class)->find($data['langue']));
                $livre->setSousCategorieId($em->getRepository(SousCategorie::class)->find($data['sous_categorie']));
                $livre->setNbreExemplaires( $data['nbreExemplaire']??1);
                $livre->setNbrePages( $data['nbrePage']??0);
                $livre->setTags( implode('|',$data['tags']??[]) );
                $livre->setThemes(implode('|',$data['themes']??[]) );
                $em->persist($livre->getLangueId());
                $em->persist($livre->getAuteurId());
                $em->persist($livre->getSousCategorieId());
                $em->persist($livre);
                $em->flush();
                if($livre->getId()){
                    $response->statut = 201;
                    $response->message = 'livre added';
                    $response->data = [];
                }
                else{
                    $response->statut = 500;
                    $response->message = 'System error';
                }
            }
            
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }

    
    #[Route('/livre/update', name: 'app_livre_update', methods: ['PUT'])]
    public function updateLivre(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $response = new NogSystemResponse(500, 'system error', []);
        // Check if the request method is PUT
        if ($request->getMethod() != 'PUT') {
            $response->statut = 405;
            $response->message = 'Method not allowed';
            return $this->json($response->getSystemHttpResponse());
        }
        //check token validity
        $token = $request->query->get('token', '');
        $auth = $em->getRepository(NsAuthorisation::class);
        if($auth->checkTokenValidity($token)){
            //check if the user has the right to update a book
            $data = json_decode($request->getContent(), true);
            if (!isset($data['libelle']) || !isset($data['resume']) || !isset($data['auteur'])|| !isset($data['langue'])|| !isset($data['sous_categorie'])|| !isset($data['isbn'])|| !isset($data['edition'])|| !isset($data['image']) || !isset($data['tags']) || !isset($data['themes'])|| !isset($data['nbreExemplaire'])|| !isset($data['nbrePage'])|| !isset($data['id'])) {
                $response->statut = 400;
                $response->message = 'Bad request';
                return $response->getSystemHttpResponse();
            }
            //on si un libre existe avec le meme libelle et isbn
            $livre = $em->getRepository(Livre::class)->find($data['id']);
            if($livre){
                //on met a jour le livre 
                $livre->setLibelle($data['libelle']);
                $livre->setImage($data['image']);
                $livre->setIsbn($data['isbn']);
                $livre->setEdition($data['edition']);
                $livre->setResume($data['resume']);
                $livre->setAuteurId($em->getRepository(Auteur::class)->find($data['auteur']));
                $livre->setLangueId($em->getRepository(Langue::class)->find($data['langue']));
                $livre->setSousCategorieId($em->getRepository(SousCategorie::class)->find($data['sous_categorie']));
                $livre->setNbreExemplaires( $data['nbreExemplaire']??$livre->getNbreExemplaires());
                $livre->setNbrePages( $data['nbrePage']??$livre->getNbrePages());
                $livre->setTags( implode('|',$data['tags']??$livre->getTags()) );
                $livre->setThemes(implode('|',$data['themes']??$livre->getThemes()) );
                $em->persist($livre->getLangueId());
                $em->persist($livre->getAuteurId());
                $em->persist($livre->getSousCategorieId());
                $em->persist($livre);
                $em->flush();
                if($livre->getId()){
                    $response->statut = 200;
                    $response->message = 'livre updated';
                    $response->data = [];
                }
                else{
                    $response->statut = 500;
                    $response->message = 'System error';
                }

            }
            else{
                $response->statut = 404;
                $response->message = 'livre not found';
                return $response->getSystemHttpResponse();
            }
        }
        else{
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        return $response->getSystemHttpResponse();
    }


    #[Route('/livre/listfull', name: 'app_livre_listFull', methods: ['GET'])]
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
            $livres = $em->getRepository(Livre::class)->findBy(array()
                , array('libelle' => 'ASC'));

            if (!$livres) {
                $response->statut = 404;
                $response->message = 'livre not found';
                return $this->json($response->getSystemResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'livres list';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($livres, 'json',['groups' => 'livresimple:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }

    #[Route('/livre/details', name: 'app_livre_details', methods: ['GET'])]
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
            $livre = $em->getRepository(Livre::class)->find($id);

            if (!$livre) {
                $response->statut = 404;
                $response->message = 'livre not found';
                return $this->json($response->getSystemHttpResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'livre details';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($livre, 'json',['groups' => 'livre:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        //return $this->json($response->getSystemResponse());
        return $response->getSystemHttpResponse();
    }
    #[Route('/livre/listcategoryfilter', name: 'app_livre_list_categoryFilter', methods: ['GET'])]
    public function listFilterCategory(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
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
        $sousCategorieID = $request->query->get('categorie', '');
        $auth = $em->getRepository(NsAuthorisation::class);

        if ($auth->checkTokenValidity($token)) {
            // Check if the sous categorie exist
            $sous_categorie = $em->getRepository(SousCategorie::class)->find($sousCategorieID);
            // Fetch all programmes

            $livres = $em->getRepository(Livre::class)->findBy(array(
                'sous_categorie_id'=> $sous_categorie
                )
                , array('libelle' => 'ASC'));

            if (!$livres) {
                $response->statut = 404;
                $response->message = 'livre not found in this category';
                return $this->json($response->getSystemResponse());
            }
            else{
                
                $response->statut = 200;
                $response->message = 'livres list';
                //A circular reference has been detected when serializing the object of class \"App\\Entity\\NsSerie\" (configured limit: 1)
                //return $this->json($series);
                $response->data = json_decode($serializer->serialize($livres, 'json',['groups' => 'livre:read'])); 
            }
        } else {
            $response->statut = 401;
            $response->message = 'Token expired';
        }

        return $this->json($response->getSystemResponse());
    }

    #[Route('/livre/update2', name: 'app_livre_update2')]
    public function update(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
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
                    if(!isset($data['libelle']) || !isset($data['resume']) || !isset($data['auteur'])|| !isset($data['langue'])|| !isset($data['sous_categorie'])|| !isset($data['isbn'])|| !isset($data['edition'])|| !isset($data['image'])|| !isset($data['id'])){
                        $response->statut = 400;
                        $response->message = 'Bad request';
                        return $this->json($response->getSystemResponse());
                    }
                    $livre = $em->getRepository(Livre::class)->find($data['id']);
                   // var_dump($pays);
                    if(!$livre){
                        $response->statut = 404;
                        $response->message = 'livre not found or already deleted';
                        return $this->json($response->getSystemResponse());
                    }
                    else{
                        //update the livre
                        //libelle,auteur_id_id, image, isbn, edition, resume,  langue_id_id, sous_categorie_id_id
                        $livre->setLibelle($data['libelle']);
                        $livre->setImage($data['image']);
                        $livre->setIsbn($data['isbn']);
                        $livre->setEdition($data['edition']);
                        $livre->setResume($data['resume']);
                        $livre->setAuteurId($em->getRepository(Auteur::class)->find($data['auteur']));
                        $livre->setLangueId($em->getRepository(Langue::class)->find($data['langue']));
                        $livre->setSousCategorieId($em->getRepository(SousCategorie::class)->find($data['sous_categorie']));
                        $livre->setNbreExemplaires( $data['nbreExemplaire']??$livre->getNbreExemplaires());
                        $livre->setTags($data['tags']??[]);
                        $livre->setThemes($data['themes']??[]);
                        $em->persist($livre->getLangueId());
                        $em->persist($livre->getAuteurId());
                        $em->persist($livre->getSousCategorieId());
                        $em->persist($livre);
                        $em->flush();
                        if($livre->getId()){
                            $response->statut = 200;
                            $response->message = 'livre updated';
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
