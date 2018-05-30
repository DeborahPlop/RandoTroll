<?php
class ModeleMail extends CI_Model {

    public function __construct()

{
$this->load->database();
/* chargement database.php (dans config), obligatoirement dans le constructeur */
}
     public function retournerSponsors()
     {
          // on retourne tous les articlesSponsor
             $this->db->select('NOSPONSOR, NOM, MAILCONTACT');
             $requete = $this->db->get('sponsor');
             return $requete->result_array(); // retour d'un tableau associatif
      // fin retournerSponsors
     }

     public function retournerUnSponsor($pNoSponsor)
     {
        $requete = $this->db->get_where('sponsor', array('NOSPONSOR' => $pNoSponsor));
        return $requete->row_array();
     }
     public function insererUnSponsor($pDonneesAInserer)
    {
        return $this->db->insert('sponsor', $pDonneesAInserer);
    } // insererUnArticle
    public function modifierUnSponsor($pDonneesAInserer, $test)
    {
        $NOSPONSOR = $this->session->ID;
        return $this->db->update('sponsor', $pDonneesAInserer, array('NOSPONSOR' => $NOSPONSOR));
    }

} // Fin Classe