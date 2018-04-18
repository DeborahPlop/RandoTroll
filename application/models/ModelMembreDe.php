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
            // $this->db->select('max(Annee)');
            // $this->db->from('Annee');
            // $requete = $this->db->get();
            // $MAX = $requete->result_array();
            // echo $MAX;

            $this->db->select('*');
            $this->db->from('Annee');
            $this->db->where('Annee',$MAX);
            $requete = $this->db->get();
            $Donnees['Annee'] = $requete->result_array();

            $this->db->select('*');
            $this->db->from('MembreDe m');
            $this->db->join('participant p ','p.noparticipant=m.noparticipant');
            $this->db->where('m.noequipe', $noEquipe);
            $requete = $this->db->get();
            $Donnees['Membres'] = $requete->result_array();
            var_dump($Donnees);
            foreach($Donnees['Membres'] as $unMembre):
                //echo $unMembre['NOM']."<BR>";
                $d = strtotime($unMembre['DATEDENAISSANCE']);
                //echo strftime('%a %d %b %Y', $d).' > ';
                $Age = (int) ((time() - $d) / 3600 / 24 / 365.25);
                //echo $Age."<BR>";
                

                // if($Age <)
                // {

                // }
            endforeach; 
            
        }

    }


?>