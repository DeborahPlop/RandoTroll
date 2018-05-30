<?php 
    class ModelSInscrire extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function Insert_Participant($donneeAinserer)
        {
            // Insert
            $this->db->insert('participant', $donneeAinserer);
            return $this->db->insert_id();
        }
        
        public function Insert_Randonneur($donneeAinserer)
        {
            $this->db->insert('randonneur',$donneeAinserer);
        }
        
        public function Insert_Responsable($donneeAinserer)
        {
            $this->db->insert('responsable',$donneeAinserer);
        }
        
        public function Insert_Equipe($donneeAinserer)
        {
            $this->db->insert('equipe',$donneeAinserer);
            
        }

        public function Test_Inscrit($donneeATester)
        {
          
           $this->db->select('count(*)');
           $this->db->from('responsable');
           $this->db->where('mail',$donneeATester);
           $requete = $this->db->get();
           return $requete->row_array();
           // Select
        }
        
        public function Test_Equipe($donneeATester)
        {          
            $this->db->select('count(*)');
            $this->db->from('equipe');
            $this->db->where('nomequipe',$donneeATester);
            $requete = $this->db->get();
            return $requete->row_array();
        }
        
        public function getNoEquipesInscrites($Annee)
        {
            $this->db->select('NoEquipe');
            $this->db->from('Sinscrire');
            $this->db->where('Annee',$Annee);
            $this->db->where('DATEVALIDATION is not null',NULL,FALSE);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function getNbMembres($DonneeEquipe)
        {
            $this->db->select('count(*)');
            $this->db->from('membrede');
            $this->db->where($DonneeEquipe);
            $requete = $this->db->get();
            return $requete->row_array();
        }

        public function getMembresD_UneEquipe($donneeATester)
        {
            $this->db->select('*');
            $this->db->from('membrede');
            $this->db->where($DonneeEquipe);
            $requete = $this->db->get();
            return $requete->result_array();
        }
        
        // public function Select_NoParticipant($donneeParticipant)
        // {
        //         // Select
        //         $this->db->select('*');
        //         $this->db->where('nom',$donneeParticipant['nom']);
        //         $this->db->where('prenom',$donneeParticipant['prenom']);
        //         $this->db->where('datedenaissance',$donneeParticipant['datedenaissance']);
        //         $this->db->where('sexe',$donneeParticipant['sexe']);
        //         $requete = $this->db->get('participant');
        //         return $requete->row_array();
        // }

    }// fin classe


?>