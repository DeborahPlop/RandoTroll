<?php 
    class ModelSInscrire extends CI_Model 
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }
        
        public function retournerImpayes() 
        {
            $requete = $this->db->get('sinscrire');
            return $requete->result_array(); // retour d'un tableau associatif
        }
    }


?>