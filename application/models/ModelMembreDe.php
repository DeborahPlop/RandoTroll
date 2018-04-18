<?php 
    class ModelMembreDe extends CI_Model 
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }
        
        public function retournerMembres($noEquipe) 
        {
            $this->db->select('*');
            $this->db->from('MembreDe m');
            $this->db->join('participant p ','p.noparticipant=m.noparticipant');            
            $this->db->join('Annee a','a.annee=m.annee');
            $this->db->where('m.noequipe', $noEquipe);
            $requete = $this->db->get();
            return $requete->result_array();

        }
    }


?>