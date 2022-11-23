<?php

namespace App\Http\Controllers\Ouvrier;
use App\Http\Controllers\Globale\Controller;
use App\Models\Etablissement;
use App\Models\Bloc_etablissement;
use App\Models\Bloc_poubelle;
use App\Models\Etage_etablissement;
use App\Models\Ouvrier;

class PoubellePlusRemplisController extends Controller{
    public function PoubellePlusRemplisOuvrier(){
            $ouvrier=auth()->guard('ouvrier')->user();
            $camion= $ouvrier->camion_id;
            $etabs= Etablissement::with('poubelles')->where('camion_id',$camion)->get();
            $p=[];
            foreach ($etabs as $etab){
                 $topPoubelle= collect($etab->poubelles)->sortByDesc('Etat')->values();
                foreach ($topPoubelle as $poubelle){
                    $bloc_poubelle= Bloc_poubelle::where('id',$poubelle->bloc_poubelle_id )->first();
                    $etage= Etage_etablissement::where('id',$bloc_poubelle["etage_etablissement_id"] )->first();
                    $bloc_etablissement= Bloc_etablissement::where('id',$etage["bloc_etablissement_id"])->first();
                    array_push($p ,[
                    'id'=>$poubelle['id'],
                    'etat'=>$poubelle['Etat'],
                    'nom'=>$poubelle['nom'],
                    'type'=>$poubelle['type'],
                    'bloc_poubelle'=>$bloc_poubelle["id"],'etage'=>$etage["nom_etage_etablissement"],
                    'bloc_etablissement'=>$bloc_etablissement["nom_bloc_etablissement"]]);
                }
            }
            return  $p;
        }

        public function PoubellePlusRemplisOuvrierIdEtab($id){
                $ouvrier=auth()->guard('ouvrier')->user();
                $camion= $ouvrier->camion_id;
                $etabs= Etablissement::with('poubelles')->where('id',$id)->where('camion_id',$camion)->get();
                $p=[];
                foreach ($etabs as $etab){
                     $topPoubelle= collect($etab->poubelles);
                    foreach ($topPoubelle as $poubelle){
                        $bloc_poubelle= Bloc_poubelle::where('id',$poubelle->bloc_poubelle_id )->first();
                        $etage= Etage_etablissement::where('id',$bloc_poubelle["etage_etablissement_id"] )->first();
                        $bloc_etablissement= Bloc_etablissement::where('id',$etage["bloc_etablissement_id"])->first();
                        array_push($p ,[
                        'id'=>$poubelle['id'],
                        'etat'=>$poubelle['Etat'],
                        'nom'=>$poubelle['nom'],
                        'type'=>$poubelle['type'],
                        'bloc_poubelle'=>$bloc_poubelle["id"],'etage'=>$etage["nom_etage_etablissement"],
                        'bloc_etablissement'=>$bloc_etablissement["nom_bloc_etablissement"]]);
                    }
                }
                return  $p;
        }
}
