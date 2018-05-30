<?php
class ModeleAnnee extends CI_Model {

    public function __construct()

{
$this->load->database();
/* chargement database.php (dans config), obligatoirement dans le constructeur */
}
     public function retournerAnnees()
     {
          // on retourne tous les articlesAnnee
             $requete = $this->db->get('Annee');
             return $requete->result_array(); // retour d'un tableau associatif
      // fin retournerAnnees
     }

     public function retournerUneAnnee($pNoAnnee)
     {
        $requete = $this->db->get_where('Annee', array('ANNEE' => $pNoAnnee));
        return $requete->row_array();
     }

     public function insererUneAnnee($pDonneesAInserer)
    {
        return $this->db->insert('Annee', $pDonneesAInserer);
    } // insererUnArticle
    public function modifierUneAnnee($pDonneesAInserer)
    {
        $NOANNEE = $this->session->ID;
        return $this->db->update('Annee', $pDonneesAInserer, array('ANNEE' => $NOANNEE));
    }

} // Fin Classe