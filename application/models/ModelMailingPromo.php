<?php 
class ModelMailingPromo extends CI_Model
{
    public  function __construct() 
    {
        $this->load->database();
    /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }

    public function getAncienRandonneur($EquipesNonConcernées)
    {
        $this->db->distinct('mail');
        $this->db->from('membrede m');
        $this->db->join('randonneur r ','m.noparticipant=r.noparticipant');
        $this->db->where_not_in('noequipe',$EquipesNonConcernées);
        
    }

    public function getEquipesAnneeEnCour($Annee)
    {
        $this->db->select('noEquipe');
        $this->db->from('membrede m');
        $this->db->where('ANNEE',$Annee);
        $requete = $this->db->get();
        return $requete->result_array();
    }
    
    public function getAncienResponsable($EquipesNonConcernées)
    {
        $this->db->distinct('mail');
        $this->db->from('membrede m');
        $this->db->join('responsable r ','m.noparticipant=r.noparticipant');
        $this->db->where_not_in('noequipe',$EquipesNonConcernées);
        
    }

    public function getAnciensParticipants()
    {
        $requete = $this->db->query('
        SELECT distinct(mail), r.noparticipant
        FROM membrede m, randonneur r
        WHERE m.noparticipant=r.noparticipant AND noEquipe NOT In(
            
            SELECT noEquipe From Membrede Where Annee = 2018)
        
        Union (
            
                SELECT distinct(mail), r.noparticipant 
                FROM membrede m, responsable r
                WHERE m.noparticipant=r.noparticipant AND noEquipe NOT In(
            
                    SELECT noEquipe From Membrede Where Annee = 2018)
            
            )'
        );
        //$requete = $this->db->get();
        return $requete->result_array();
    }

}
?>