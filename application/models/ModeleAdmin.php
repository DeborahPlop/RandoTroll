<?php
class ModeleAdmin extends CI_Model {

    public function __construct()

{
$this->load->database();
/* chargement database.php (dans config), obligatoirement dans le constructeur */
}

     public function retournerAdmins()
     {
        $this->db->select('*');
        $this->db->from('contributeur c');
        $this->db->join('benevole b ','b.nocontributeur=c.nocontributeur');
        $this->db->join('administrateur a ','a.nocontributeur=c.nocontributeur');
        // $this->db->where('m.noequipe', $noEquipe); si j'ai besoin d'un where un moment donné
        $requete = $this->db->get();
        return $requete->result_array();
     }

     public function retournerBenevoles()
     {
        $this->db->select('*');
        $this->db->from('contributeur c');
        $this->db->join('benevole b ','b.nocontributeur=c.nocontributeur');
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
     }

     public function retournerUneAdmin($pNoAdmin)
     {
        $requete = $this->db->get_where('Admin', array('NOCONTRIBUTEUR' => $pNoAdmin));
        return $requete->row_array();
     }

     public function insererUnAdmin($pDonneesAInserer)
    {
        return $this->db->insert('administrateur', $pDonneesAInserer);
    } // insererUnArticle
    public function modifierUneAdmin($pDonneesAInserer)
    {
        $NOCONTRIBUTEUR = $this->session->ID;
        return $this->db->update('Admin', $pDonneesAInserer, array('NOCONTRIBUTEUR' => $NOCONTRIBUTEUR));
    }

} // Fin Classe