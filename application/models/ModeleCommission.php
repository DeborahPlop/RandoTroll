<?php
class ModeleCommission extends CI_Model {

    public function __construct()

{
$this->load->database();
/* chargement database.php (dans config), obligatoirement dans le constructeur */
}
     public function retournerCommissions()
     {
          // on retourne tous les articlesAnnee
             $requete = $this->db->get('commission');
             return $requete->result_array(); // retour d'un tableau associatif
      // fin retournerAnnees
     }

     public function retournerUneCommission($pNoAnnee)
     {
        $requete = $this->db->get_where('commission', array('ANNEE' => $pNoAnnee));
        return $requete->row_array();
     }

     public function insererUneCommission($pDonneesAInserer)
    {
        return $this->db->insert('Commission', $pDonneesAInserer);
    } // insererUnArticle
    public function modifierUneCommission($pDonneesAInserer)
    {
        $NOCOMMISSION = $this->session->ID;
        return $this->db->update('Annee', $pDonneesAInserer, array('ANNEE' => $NOANNEE));
    }

    public function retournerBenevolesCommission($NOCOMMISSION)
     {
        $Date = date('Y');
        $this->db->select('p.NOCONTRIBUTEUR, c.NOM, c.PRENOM');
        $this->db->from('participer p');
        $this->db->join('contributeur c', 'c.NOCONTRIBUTEUR = p.NOCONTRIBUTEUR');
        $this->db->where('ANNEE ', $Date);
        $this->db->where('NOCOMMISSION',$NOCOMMISSION);
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
     }

     public function retournerBenevolesDispo()
     {
        $BenevoleDejaRataches = $this->session->BenevolesIndispo;
        if(!empty($BenevoleDejaRataches))
        {
            $this->db->select('*');
            $this->db->from('contributeur');
            $this->db->join('benevole b ','b.nocontributeur=contributeur.nocontributeur');
            $this->db->where_not_in('b.nocontributeur', $BenevoleDejaRataches);
            $requete = $this->db->get();
            return $requete->result_array(); // retour d'un tableau associatif
        }
        else
        {
            $this->db->select('*');
            $this->db->from('contributeur c');
            $this->db->join('benevole b ','b.nocontributeur=c.nocontributeur');
            $requete = $this->db->get();
            return $requete->result_array(); // retour d'un tableau associatif
        }
        
     }

     public function insererBenevolesCommission($Benevoles, $NB, $NOCOMMISSION)
    {
        $date = date('Y');
        for($I = 0; $I < $NB; $I++)
            {

                $donneesAInserer = array
                (
                    'ANNEE' => $date,
                    'NOCONTRIBUTEUR' => $Benevoles[$I],
                    'NOCOMMISSION' => $NOCOMMISSION,
                );
            $this->db->insert('participer', $donneesAInserer);
            }
    } // insererUnArticle
    public function detacherBenevoleCommission($NOCOMMISSION, $Benevole)
    {
        $this->db->where('NOCOMMISSION',$NOCOMMISSION);
        $this->db->delete('participer', array('NOCONTRIBUTEUR' => $Benevole));  // Produces: // DELETE FROM participer  // WHERE NOCONTRIBUTEUR = $Benevole
    }
} // Fin Classe