<?php 
    class ModelSeConnecter extends CI_Model 
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }
        public function Test_Inscrit($donneeConnexion)
         {
            $array = array('mail' => $donneeConnexion['mail'], 'motdepasse' => $donneeConnexion['motdepasse']);
           
            $this->db->select('count(*)');
            $this->db->from('responsable r');
            $this->db->where($array);
            //$this->db->where('motdepasse',$donneeConnexion['motdepasse']);

            $requete = $this->db->get();
            return $requete->row_array();
            // Select
        }

        public function Test_Admin($donneeCoAdmin)
        {
        // $array = array('mail' => $donneeCoAdmin['mail'], 'motdepasse' => $donneeCoAdmin['motdepasse']);

           $this->db->select('count(*)');
           $this->db->from('contributeur');
           $this->db->where('email',$donneeCoAdmin);
           //$this->db->where('motdepasse',$donneeConnexion['motdepasse']);

           $requete = $this->db->get();
           return $requete->row_array();
           // Select
        } 

        public function Recup_profilAdmin($mail)
        {
            $this->db->select('profil');
            $this->db->from('administrateur a');
            $this->db->join('contributeur c ','a.nocontributeur=c.nocontributeur');
            $this->db->where('c.email', $mail);

            $requete = $this->db->get();
            return $requete->row_array();
        }
        public function Recup_mdp($mail)
        {
            $this->db->select('motdepasse');
            $this->db->from('responsable');
            $this->db->where('mail',$mail);
            $requete = $this->db->get();
            return $requete->row_array();
        }


        public function getMembresD_UneEquipe($donneeATester)
        {

            $this->db->select('*');
            $this->db->from('membrede');
            $this->db->where($donneeATester);
            $requete = $this->db->get();
            return $requete->result_array();
     
        }
        public function Recup_NoParticipant($donneeConnexion)
        {
            $donneeConnexion=array(
                'mail'=>$donneeConnexion['mail'],
                'mdp'=>$donneeConnexion['mdp'],
            );

            $this->db->select('noparticipant');
            $this->db->from('responsable');
            $this->db->where('mail',$donneeConnexion['mail'],'motdepasse',$donneeConnexion['mdp']);
            $requete = $this->db->get();
            return $requete->result_array();
        }
   }// fin classe


   ?>