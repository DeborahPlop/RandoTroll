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
            $this->db->select('*');
            $this->db->from('equipe e');
            $this->db->join('participant p ','p.noparticipant=e.nopar_responsable');            
            $this->db->join('responsable r','e.nopar_responsable=r.noparticipant');
            $this->db->join('sinscrire s','s.noequipe = e.noequipe');
            $this->db->where('datevalidation', null);
            $requete = $this->db->get();
            return $requete->result_array();
            // SELECT e.NomEquipe, p.Prenom, p.nom, r.telportable,r.mail,s.montantpaye,s.modereglement 
            // FROM participant p, sinscrire s, equipe e, responsable r 
            // Where s.noequipe = e.noequipe and e.nopar_responsable=r.noparticipant and r.noparticipant = p.noparticipant
        }
        public function Inscription()
        {
            $this->db->select ('count(noparticipant)');
            $this->db->from('responsable');
            $requete=$this->db->get();
            return $requete->result_array();
            echo ($requete);
            $data=array(
            'noresponsable'=>$requete +1 ,
            'motdepasse'=>$mdp,
            'mail'=>$mail,
            'telportable'=>$tel,
            );
        $this->db->insert($this->responsable,$data);

        }// fin inscription
    }// fin classe


?>