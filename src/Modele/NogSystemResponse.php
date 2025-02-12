<?php
// src/Modele/NogSystemResponse.php
namespace App\Modele;


use Cassandra\Date;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NogSystemResponse{
    public $statut ='';
    public $message= '';
    public $data ='';
    public function __construct($st,$msg,$dt)
    {
        $this->data = $dt;
        $this->message = $msg;
        $this->statut = $st;
    }

    public function getSystemResponse(){
        return [
            'statut'=>$this->statut,
            'message'=>$this->message,
            'data'=>$this->data
        ];
    }
    public function getSystemHttpResponse(): Response{
        
        $httpResponse = new Response(
            json_encode($this->getSystemResponse()),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
         $httpResponse->headers->set('Access-Control-Allow-Headers', '*');
         $httpResponse->headers->set('Access-Control-Allow-Origin', '*');
         $httpResponse->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
         $httpResponse->headers->set('Content-Type', 'application/json');
        return $httpResponse;
        
    }
}
