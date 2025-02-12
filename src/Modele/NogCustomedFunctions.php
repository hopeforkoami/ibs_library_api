<?php
// src/Modele/NogCustomedFunctions.php
namespace App\Modele;

use App\Entity\NsAuthorisation;
use Cassandra\Date;
use phpDocumentor\Reflection\Types\Boolean;

class NogCustomedFunctions{
    public $SHOPCODE='GNLSHP01SYS';
    public $db_name = 'u501205143_BDlpclle';
    public $onlineShopID = 4;
    public $agentSystemID = 1;
    public $orderPendingStatut_ID = 0;
    public $ADMIN = 1;
    public $OPS = 2;

    public function generateID($tablePref){
        $dte = new \DateTime('now');
        return $this->SHOPCODE .'_'.uniqid($tablePref) . $dte->getTimestamp();
    }
    public function save_base64_image($image, $path_with_end_slash="", $prefix="upload-") {
        $imageInfo = explode(";base64,", $image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        $data = str_replace(' ', '+', $imageInfo[1]);
        $imageName = $prefix.time().".".$imgExt;
        $path = $path_with_end_slash . $imageName;  // File path
        $dir = dirname($path); 
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents( $path_with_end_slash . $imageName, base64_decode($data) );

        return $imageName;
    }
    public function save_file($fichier, $path_with_end_slash="" ) {$temp1 = explode(';',$fichier);
        $temp2 = explode('/',$temp1[0]);
        $fileName = md5(uniqid()).'.'. $temp2[1];
        $imageInfo = explode(";base64,", $fichier);
        $data = str_replace(' ', '+', $imageInfo[1]);
        file_put_contents( $path_with_end_slash . $fileName, base64_decode($data) );
        return $fileName;
    }
    //verifier si le tocken est valide en comparant la dateDebut à la dateFin et retourner true ou false
    public function checkTokenValidity($token, $em):bool{
        //$em = $this->getDoctrine()->getManager();
        $authorisation = $em->getRepository(NsAuthorisation::class)->findOneBy(['token' => $token]);
        
        var_dump($authorisation);
        if ($authorisation) {
            $dateDebut = $authorisation->getDateDebut();
            $dateFin = $authorisation->getDateFin();
            $now = new \DateTime('now');
            if ($now >= $dateDebut && $now <= $dateFin) {
                return true;
            }
            else{
                //on desactive le token en mettant valide à false
                $authorisation->setValide(false);
                $em->persist($authorisation);
                $em->flush();
                return false;
            }

        }
        return false;
    }
    //on recupere l'utilisateur en fonction du token et on verifie si le droit de l'utilisateur est egale au parametre droit
    public function checkUserRight($token,$droit):bool
    {
        $em = $this->$this->getDoctrine()->getManager();
        $authorisation = $em->getRepository(NsAuthorisation::class)->findOneBy(['token' => $token]);
        if ($authorisation) {
            $user = $authorisation->getUser();
            //on verifie le droit de l'utilisateur est egale au parametre droit
            if ($user->getDroit()->getId() == $droit) {
                return true;
            }
        }
        return false;
    }


}
