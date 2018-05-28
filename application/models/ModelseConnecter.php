<?php 
    class ModelSeConnecter extends CI_Model 
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }
        public function Test_Inscrit($donneeResponsable)
         {
            $array = array('mail' => $donneeResponsable['mail'], 'motdepasse' => $donneeResponsable['motdepasse']);
           
            $this->db->select('count(*)');
            $this->db->from('responsable');
            $this->db->where($array);
            //$this->db->where('motdepasse',$donneeResponsable['motdepasse']);

            $requete = $this->db->get();
            return $requete->row_array();
            // Select
        }
        public function Recup_mdp($mail)
        {
            $this->db->select('motdepasse');
            $this->db->from('responsable');
            $this->db->where('mail',$mail);
            $requete = $this->db->get();
            return $requete->row_array();
        }
   }// fin classe


   ?>