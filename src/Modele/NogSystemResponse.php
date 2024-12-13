<?php
// src/Modele/NogSystemResponse.php
namespace App\Modele;


use Cassandra\Date;

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
}
