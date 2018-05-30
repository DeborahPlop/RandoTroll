<?php 
    class ModelVague extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }

        public function getEquipes_A_Affecter()
        {
            $this->db->select('*');
            $this->db->from('choisir c');
            $this->db->join('equipe e','c.noequipe=e.noequipe');
            $this->db->where('Annee',date('Y'));
            $this->db->where('vague',null);
            $requete = $this->db->get();
            return $requete->result_array();
        }

        public function updateChoisir($Valeurs)
        {
            //var_dump($Valeurs);
            $Données = array('vague' => $Valeurs['Vague']);

            $this->db->where('noequipe',$Valeurs['noEquipe']);
            $this->db->update('choisir',$Données);
        }
    }

/*
SELECT * FROM choisir c, equipe e
Where c.noequipe=e.noequipe and Annee = 2018
*/
?>