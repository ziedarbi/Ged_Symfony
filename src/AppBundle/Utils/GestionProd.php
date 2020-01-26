<?php
/**
 * Created by PhpStorm.
 * User: zied
 * Date: 26/02/2019
 * Time: 04:26
 */

namespace AppBundle\Utils;


class GestionProd
{
    public function  createPath($dossier){
        $aa=date("d/m/Y");

        list($day, $month,$year )=explode("/", $aa);
        //echo $year;
        //echo $month;
// echo $day;
        if(!is_dir($dossier.'/'.$year)){

            mkdir($dossier.'/'.$year);
            $dossier=$dossier.'/'.$year;
        }
        else{
            $dossier=$dossier.'/'.$year;
        }
        if(is_dir($dossier.'/'.$month)){

            // echo "Le dossier existe";
            $dossier=$dossier.'/'.$month;

            // if(is_dir($dossier.'/'.$month.'/'.$day)){
            if(is_dir($dossier.'/'.$day)){
                //echo "Le dossier existe";
                $dossier=$dossier.'/'.$day;

            } else{
                // echo "Le dossier n'existe pas";
                mkdir($dossier.'/'.$day);
                $dossier=$dossier.'/'.$day;
            }

        } else{
            // echo "Le dossier n'existe pas";
            mkdir($dossier.'/'.$month);
            $dossier=$dossier.'/'.$month;
            mkdir($dossier.'/'.$day);
            $dossier=$dossier.'/'.$day;
        }
        $path=$dossier;
        return $path;

}
}