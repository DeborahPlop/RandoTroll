<?php 
    class ModelMembreDe extends CI_Model 
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }
        
        public function sommeDueParEquipe($noEquipe) 
        {
            $this->db->select_max('Annee');
            $this->db->from('Annee');
            $requete = $this->db->get();
            $MAX=$requete->result_array();
            $AnneeMax= $MAX['0']['Annee'];

            $this->db->select('*');
            $this->db->from('Annee');
            $this->db->where('Annee',$AnneeMax); //date('Y')
            $requete = $this->db->get();
            $Donnees['Annee'] = $requete->result_array();

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

    }


?>