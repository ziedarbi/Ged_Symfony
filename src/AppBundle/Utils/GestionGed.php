<?php
/**
 * Created by PhpStorm.
 * User: zied
 * Date: 26/02/2019
 * Time: 01:26
 */


namespace AppBundle\Utils;


class GestionGed
{
    public function  createfolderPath($dossier ,$matriculeNom,$dossierdoc){
            if(!is_dir($dossier.'/'.$matriculeNom)){

            mkdir($dossier.'/'.$matriculeNom);

            $dossier=$dossier.'/'.$matriculeNom;
            mkdir($dossier.'/'.$dossierdoc);
            $dossier=$dossier.'/'.$dossierdoc;
        }
        else{
            $dossier=$dossier.'/'.$matriculeNom;
            if(!is_dir($dossier.'/'.$dossierdoc)){
                mkdir($dossier.'/'.$dossierdoc);
                $dossier=$dossier.'/'.$dossierdoc;
            }
            else{
                $dossier=$dossier.'/'.$dossierdoc;
            }
        }

        $path=$dossier;
        return $path;

    }
}