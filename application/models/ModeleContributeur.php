<?php
class ModeleContributeur extends CI_Model {

    public function __construct()

{
$this->load->database();
/* chargement database.php (dans config), obligatoirement dans le constructeur */
}
     public function retournerContributeurs()
     {
             $requete = $this->db->get('contributeur');
             return $requete->result_array(); // retour d'un tableau associatif
     }

     public function retournerUnContributeur($pNoSponsor)
     {
        $requete = $this->db->get_where('contributeur', array('NOCONTRIBUTEUR' => $pNoSponsor));
        return $requete->row_array();
     }

// ///////////////////// Contributeur

     public function insererUnContributeur($pDonneesAInserer)
    {
        return $this->db->insert('contributeur', $pDonneesAInserer);
    } 

    public function modifierUnContributeur($pDonneesAInserer)
    {
        $nocontributeur = $this->session->ID;
        return $this->db->update('contributeur', $pDonneesAInserer, array('NOCONTRIBUTEUR' => $nocontributeur));
    }

//////// Retourner le dernier ID insérer dans contributeur

    public function GetID()
    {
    return $this->db->insert_id();
    }

    // ///////////////////// héritage de contributeur

    public function insererUnContributeurBenevole($IDContributeur)
    {
        return $this->db->insert('benevole', array('NOCONTRIBUTEUR' => $IDContributeur));
    }

    public function insererUnContributeurAporteurDeSponsors($IDContributeur)
    {
        return $this->db->insert('apporteurdesponsors', array('NOCONTRIBUTEUR' => $IDContributeur));
    }

} // Fin Classe