<?php 
class ModelImpayes extends CI_Model 
{
    public  function __construct() 
    {
        $this->load->database();
    /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }

    public function getImpayes() 
    {
        
        $this->db->select('*');
        $this->db->from('equipe e');
        $this->db->join('participant p ','p.noparticipant=e.nopar_responsable');            
        $this->db->join('responsable r','e.nopar_responsable=r.noparticipant');
        $this->db->join('sinscrire s','s.noequipe = e.noequipe');
        $this->db->where('datevalidation', null);
        $requete = $this->db->get();
        return $requete->result_array();
        
    }

    public function getSommeDueParEquipe($noEquipe) 
    {  
        
        $Donnees['Annee'] = $this->getAnneeEnCours();

        $this->db->select('*');
        $this->db->from('MembreDe m');
        $this->db->join('participant p ','p.noparticipant=m.noparticipant');
        $this->db->where('m.noequipe', $noEquipe);
        $requete = $this->db->get();
        $Donnees['Membres'] = $requete->result_array();
        //var_dump($Donnees);
        $Solde = 0;
        foreach($Donnees['Membres'] as $unMembre):
            //echo "Nom : ".$unMembre['NOM']."<BR>";
            $d = strtotime($unMembre['DATEDENAISSANCE']);
            //echo strftime('%a %d %b %Y', $d).' > ';
            $Age = (int) ((time() - $d) / 3600 / 24 / 365.25);
            //echo "Age :".$Age."<BR>";
                
            if($Age < $Donnees['Annee']['0']['LIMITEAGE']) 
            {
                $Solde = $Solde + $Donnees['Annee']['0']['TARIFINSCRIPTIONENFANT']+($Donnees['Annee']['0']['TARIFREPASENFANT']*$unMembre['REPASSURPLACE']);
            }
            else 
            {
                $Solde = $Solde + $Donnees['Annee']['0']['TARIFINSCRIPTIONADULTE']+($Donnees['Annee']['0']['TARIFREPASADULTE']*$unMembre['REPASSURPLACE']);
            } 
            //echo "Somme : ".$Solde."<BR>";
        endforeach; 
            //echo "Somme totale : ".$Solde. "<BR><BR>";
        return $Solde;
    }

    public function getAnneeEnCours()
    {
        $AnneeMax = date('Y');

        $this->db->select('*');
        $this->db->from('Annee');
        $this->db->where('Annee',$AnneeMax); //date('Y')
        $requete = $this->db->get();
        return $requete->result_array();

    }

    public function getEquipe($noEquipe)
    {
        $this->db->select('*');
        $this->db->from('equipe e');
        $this->db->join('participant p ','p.noparticipant=e.nopar_responsable');            
        $this->db->join('responsable r','e.nopar_responsable=r.noparticipant');
        $this->db->join('sinscrire s','s.noequipe = e.noequipe');
        $this->db->where('e.noequipe', $noEquipe);
        $requete = $this->db->get();
        return $requete->result_array();
    }

    public function updateEquipe($noEquipe,$DonnesAChanger)
    {
        $this->db->where('noequipe', $noEquipe);
        $this->db->update('sinscrire',$DonnesAChanger); 
    }

}

?>