<?php
namespace App\metier;

use Illuminate\Support\Facades\DB;

/** 
 * Classe d'accès aux données. 
 */
class GsbFrais{   		
/**
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un objet 
*/
    
    
public function getInfosUtilisateurs($login, $mdp){
        $req = "select utilisateurs.id as id, utilisateurs.nom as nom, utilisateurs.prenom as prenom, utilisateurs.statut as statut from utilisateurs
        where utilisateurs.login=:login and utilisateurs.mdp=:mdp";
        $ligne = DB::select($req, ['login'=>$login, 'mdp'=>$mdp]);
        return $ligne;
}

/**
 * Retourne sous forme d'un tableau d'objets toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un objet avec tous les champs des lignes de frais hors forfait 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur =:idVisiteur 
		and lignefraishorsforfait.mois = :mois AND codeSuppression IS NULL ";	
            $lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
//            for ($i=0; $i<$nbLignes; $i++){
//                    $date = $lesLignes[$i]['date'];
//                    $lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
//            }
            return $lesLignes; 
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un objet contenant les frais forfait du mois
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, ligneFraisForfait.mois as mois,
		lignefraisforfait.quantite as quantite, montant
                from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois=:mois
		order by lignefraisforfait.idfraisforfait";	
//                echo $req;
                $lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
		return $lesLignes; 
	}
/**
 * Retourne tous les id de la table FraisForfait
 * @return un objet avec les données de la table frais forfait
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$lesLignes = DB::select($req);
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait
 
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
    //            print_r($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = :qte
			where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois = :mois
			and lignefraisforfait.idfraisforfait = :unIdFrais";
                        DB::update($req, ['qte'=>$qte, 'idVisiteur'=>$idVisiteur, 'mois'=>$mois, 'unIdFrais'=>$unIdFrais]);
		}
		
	}
/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "update fichefrais set nbjustificatifs = :nbJustificatifs 
		where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
		DB::update($req, ['nbJustificatifs'=>$nbJustificatifs, 'idVisiteur'=>$idVisiteur, 'mois'=>$mois]);	
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = :mois and fichefrais.idvisiteur = :idVisiteur";
		$laLigne = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
                $nb = $laLigne[0]->nblignesfrais;
		if($nb == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = :idVisiteur";
		$laLigne = DB::select($req, ['idVisiteur'=>$idVisiteur]);
                $dernierMois = $laLigne[0]->dernierMois;
		return $dernierMois;
	}
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche->idEtat=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
				
		}
		$req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values(:idVisiteur,:mois,0,0,now(),'CR')";
		DB::insert($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais->idfrais;
			$req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
			values(:idVisiteur,:mois,:unIdFrais,0)";
			DB::insert($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois, 'unIdFrais'=>$unIdFrais]);
		 }
	}
        
        public function creeNouveauVisiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche,$statut,$mail,$ntel){//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		$req = "insert into utilisateurs(id,nom,prenom,login,mdp,adresse,cp,ville,dateEmbauche,statut,mail,ntel) 
		values(:id,:nom,:prenom,:login,:mdp,:adresse,:cp,:ville,:dateEmbauche,:statut,:mail,:ntel)";
                
		DB::insert($req, ['id'=>$id,
                    'nom'=>$nom,'prenom'=>$prenom,
                    'login'=>$login,'mdp'=>$mdp,'adresse'=>$adresse,'cp'=>$cp, 
                    'ville'=>$ville, 'dateEmbauche'=>$dateEmbauche,'statut'=>$statut,'mail'=>$mail,'ntel'=>$ntel]);
 
	}
        
        
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
//		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait(idVisiteur, mois, libelle, date, montant) 
		values(:idVisiteur,:mois,:libelle,:date,:montant)";
		DB::insert($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois, 'libelle'=>$libelle,'date'=>$date,'montant'=>$montant]);
	}

/**
 * Récupère le frais hors forfait dont l'id est passé en argument
 * @param $idFrais 
 * @return un objet avec les données du frais hors forfait
*/
	public function getUnFraisHorsForfait($idFrais){
		$req = "select * from lignefraishorsforfait where lignefraishorsforfait.id = :idFrais ";
		$fraisHF = DB::select($req, ['idFrais'=>$idFrais]);
//                print_r($unfraisHF);
                $unFraisHF = $fraisHF[0];
                return $unFraisHF;
	}
/**
 * Modifie frais hors forfait à partir de son id
 * à partir des informations fournies en paramètre
 * @param $id 
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function modifierFraisHorsForfait($id, $libelle,$date,$montant){
//		$dateFr = dateFrancaisVersAnglais($date);
		$req = "update lignefraishorsforfait set libelle = :libelle, date = :date, montant = :montant
		where id = :id";
		DB::update($req, ['libelle'=>$libelle,'date'=>$date,'montant'=>$montant, 'id'=>$id]);
	}
        
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id = :idFrais ";
		DB::delete($req, ['idFrais'=>$idFrais]);
	}
/**
 * Retourne les fiches de frais d'un visiteur à partir d'un certain mois
 * @param $idVisiteur 
 * @param $mois mois début
 * @return un objet avec les fiches de frais de la dernière année
*/
	public function getLesFrais($idVisiteur, $mois){
		$req = "select * from  fichefrais where idvisiteur = :idVisiteur
                and  mois >= :mois   
		order by fichefrais.mois desc ";
                $lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
                return $lesLignes;
	}
        
        public function listeVisiteursSuivi(){
            $req = "select distinct id from utilisateurs inner join fichefrais on fichefrais.idVisiteur = utilisateurs.id where statut = 'v' and idEtat IN ('RB','VA')";
            $lesLignes = DB::select($req);
            return $lesLignes;
        }
        
        public function listeMoisSuivi(){
            $req = "select distinct mois from utilisateurs inner join fichefrais on fichefrais.idVisiteur = utilisateurs.id where statut = 'v' and idEtat IN ('RB','VA') order by mois desc limit 12";
            $lesLignes = DB::select($req);
            return $lesLignes;
        }
        
        
        
       
/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un objet avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
		$lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur,'mois'=>$mois]);			
		return $lesLignes[0];
	}
/** 
 * Modifie l'état et la date de modification d'une fiche de frais
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = :etat, dateModif = now() 
		where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
		DB::update($req, ['etat'=>$etat, 'idVisiteur'=>$idVisiteur, 'mois'=>$mois]);
	}
        
        public function majMdp($login,$npwd){
		$req = "update utilisateurs set mdp = :npwd where login= :login";
		DB::update($req, ['npwd'=>$npwd, 'login'=>$login]);
        }
        
        public function VisiteursFichesClo(){
		$req = 'SELECT utilisateurs.id, utilisateurs.nom, utilisateurs.prenom, mois, montantValide, nbJustificatifs
                FROM utilisateurs INNER JOIN fichefrais ON utilisateurs.id = fichefrais.idVisiteur
		WHERE fichefrais.idEtat = "CL"
                AND  utilisateurs.statut LIKE "v"
		ORDER BY utilisateurs.nom ASC';
		$lesLignes = DB::select($req);
		return $lesLignes;
	}
        
        
        
        
        // Requete détail suivi fiche frais
        
        public function getPaiementFicheFrais($idVisiteur, $mois){
            $req = "SELECT utilisateurs.id, utilisateurs.nom, utilisateurs.prenom, mois, montantValide, nbJustificatifs, dateModif
                FROM utilisateurs INNER JOIN fichefrais ON utilisateurs.id = fichefrais.idVisiteur
		WHERE utilisateurs.statut LIKE 'v'
                AND fichefrais.idEtat = 'VA' or 'RB'
                AND fichefrais.idVisiteur = :idVisiteur
                AND fichefrais.mois = :mois";
		$lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur,'mois'=>$mois]);			
		return $lesLignes[0];
	}
        
        
        
        
        // Calcul montant fiche clôture
        public function montantFicheCloture($mois, $idVisiteur){
            $req_1 = 'select sum(quantite*montant) as montantFrais from fraisforfait inner join lignefraisforfait on lignefraisforfait.idFraisForfait = fraisforfait.id where idVisiteur = :idVisiteur and mois = :mois';
      
            $req_2 = 'select sum(montant) as montantHorsForfait from lignefraishorsforfait  where idVisiteur = :idVisiteur and mois = :mois';
            
            $ligneFraisForfait = DB::select($req_1, ['idVisiteur'=>$idVisiteur,'mois'=>$mois]);
            $ligneFraisHorsForfait = DB::select($req_2, ['idVisiteur'=>$idVisiteur,'mois'=>$mois]);
            
            
            $SommeFraisForfait = $ligneFraisForfait[0]->montantValide;
            $SommeFraisHorsForfait = $ligneFraisHorsForfait[0]->montantHorsForfait;
            
            
            $total = $SommeFraisForfait + $SommeFraisHorsForfait;
            
            $req_3 = 'update fichefrais set montantValide = :total, idEtat = "CL" where idVisiteur = :idVisiteur and mois = :mois';
            DB::update($req_3, ['idVisiteur'=>$idVisiteur, 'mois'=>$mois, 'total'=>$total]);
                    
      
        }
        
        
        
        

        public function laFicheVisiteur($idVisiteur, $mois){
		$req = "SELECT utilisateurs.id, utilisateurs.nom, utilisateurs.prenom, mois, montantValide, nbJustificatifs, dateModif
                FROM utilisateurs INNER JOIN fichefrais ON utilisateurs.id = fichefrais.idVisiteur
		WHERE utilisateurs.statut LIKE 'v'
                AND fichefrais.idEtat = 'CL'
                AND fichefrais.idVisiteur = :idVisiteur
                AND fichefrais.mois = :mois";
		$lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur,'mois'=>$mois]);			
		return $lesLignes[0];
	}
        
        public function validerFicheFrais($idVisiteur, $mois, $montantTotal)
        {
            	$req = "UPDATE fichefrais SET montantValide = :montantTotal, idEtat = 'VA', dateModif = DATE(NOW()) WHERE idVisiteur=:idVisiteur AND mois=:mois";
		$lesLignes = DB::update($req, ['idVisiteur'=>$idVisiteur,'mois'=>$mois,'montantTotal'=>$montantTotal]);
                return $lesLignes;
        }
        
        public function majFF($idVisiteur, $mois, $ETP, $KM, $NUI, $REP)
        {
                $req1 = "UPDATE lignefraisforfait SET quantite=:ETP WHERE idVisiteur=:idVisiteur AND mois=:mois AND idFraisForfait='ETP' ";
		DB::update($req1, ['idVisiteur'=>$idVisiteur,'mois'=>$mois,'ETP'=>$ETP]);
                
                $req2 = "UPDATE lignefraisforfait SET quantite=:KM WHERE idVisiteur=:idVisiteur AND mois=:mois AND idFraisForfait='KM' ";
		DB::update($req2, ['idVisiteur'=>$idVisiteur,'mois'=>$mois,'KM'=>$KM]);
                
                $req3 = "UPDATE lignefraisforfait SET quantite=:NUI WHERE idVisiteur=:idVisiteur AND mois=:mois AND idFraisForfait='NUI' ";
		DB::update($req3, ['idVisiteur'=>$idVisiteur,'mois'=>$mois,'NUI'=>$NUI]);
                
                $req4 = "UPDATE lignefraisforfait SET quantite=:REP WHERE idVisiteur=:idVisiteur AND mois=:mois AND idFraisForfait='REP' ";
		DB::update($req4, ['idVisiteur'=>$idVisiteur,'mois'=>$mois,'REP'=>$REP]);
        }
        
        public function affFHF($idVisiteur,$mois,$id,$date,$montant)
        {
                $req = "SELECT id, idVisiteur, mois, libelle, date, montant FROM lignefraishorsforfait WHERE idVisiteur=:idVisiteur AND mois=:mois AND id=:id AND date=:date AND montant=:montant ";
		$lesLignes = DB::select($req, ['idVisiteur'=>$idVisiteur,'mois'=>$mois,'id'=>$id,'date'=>$date,'montant'=>$montant]);
                return $lesLignes;
        }
        
        public function supprimerFHF($id, $txt)
        {
            	$req = "UPDATE lignefraishorsforfait SET codeSuppression='s', motifSuppression=:txt WHERE id=:id ";
		$lesLignes = DB::select($req, ['id'=>$id, 'txt'=>$txt]);
                return $lesLignes;
        }
        
        
         public function majInfo($login,$adr,$cp,$ville,$mail, $ntel){
		$req = "update utilisateurs set adresse = :adr, cp= :cp,ville= :ville, mail= :mail, ntel= :ntel where login= :login";
		DB::update($req, ['adr'=>$adr,'cp'=>$cp,'ville'=>$ville,'mail'=>$mail,'ntel'=>$ntel, 'login'=>$login]);
        }
}
?>
