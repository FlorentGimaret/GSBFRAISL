<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\metier\GsbFrais;

class modifInfoController extends Controller
{
    
    public function affFormModifMdp(){
        $erreur="";
        return view('formModifInfo', compact('erreur'));
    }
    
    public function modifinfo(Request $request){
     

        $erreur="";
        $login=Session::get('login');
        $adr = $request->input('adr'); 
        $cp = $request->input('cp'); 
        $ville = $request->input('ville'); 
        $mail = $request->input('mail'); 
        $ntel = $request->input('ntel'); 
        $unFrais = new GsbFrais();
       
        if($cp > 5 && $cp < 5)
        {
             $erreur .= "votre code postal doit contenir 5 caractères ! \n";
        }
            
           if($ntel < 10)
         {
             $erreur .= "votre numéro de téléphone doit contenir 10 chiffres ! \n";
        }
            
            
            if($erreur!="")
            {
                return view('formModifInfo', compact('erreur'));
            }
            else
            {
                $unFrais->majInfo($login,$adr,$cp,$ville,$mail, $tel);
                return redirect()->back()->with('status', 'Mise à jour effectuée!');
            }
            }
        }
 

