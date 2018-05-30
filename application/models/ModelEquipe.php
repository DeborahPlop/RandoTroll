<?php
class ModelEquipe extends CI_Model {

    public function __construct()
    {   
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }
    public function Membre($DonneeATester)
    {
        $this->db->select('*');
        $this->db->from('participant p');
        $this->db->join('membrede m','p.noparticipant=m.noparticipant');
        $this->db->join('randonneur r','p.noparticipant=r.noparticipant');
        $this->db->where('annee',$DonneeATester['annee']);
        $requete = $this->db->get();
        return $requete->result_array();
    }
    // public function Recup_DateValid($donneeATester)
    // {
    //     $this->db->select('datevalidation');
    //     $this->db->from('sinscrire');
    //     $this->db->where('noequipe',$donneeATester['noequipe'],'annee',$donneeATester['annee']);

    //     $requete = $this->db->get();
    //     return $requete->row_array();
    // }

    public function UpdateMDP($DonneeMAJ)
    {
        $Donnees = array(
            'MOTDEPASSE'=>$DonneeMAJ['motdepasse'],
        );
        $this->db->where('motdepasse', $DonneeMAJ['mdp']);
        $this->db->update('responsable',$Donnees);

    }

    public function UpdateTel($DonneeMAJ)
    {
        $Donnees = array(
            'telportable'=>$DonneeMAJ['newtel'],
        );
        $this->db->where('telportable', $DonneeMAJ['tel']);
        $this->db->update('responsable', $Donnees);

    
    }

    public function Recup_noequipe($DonneeMembre)
    {
        $DonneeMembre=array(
            'noparticipant'=>$DonneeMembre['noparticipant'],
            'annee'=>$DonneeMembre['annee'],
        );
        $this->db->select('noequipe');
        $this->db->from('membrede ');
        $this->db->where('noparticipant',$DonneeMembre['noparticipant'],'annee',$DonneeMembre['annee']);
        $requete = $this->db->get();
        return $requete->row_array();
    }

    public function Insert_MembreDe($DonneeaInserer)
    {
        $this->db->insert('membrede',$DonneeaInserer);
    }

    public function Delete_MembreDe($DonneeADelete)
    {
        $this->db->where('noparticipant', $DonneeADelete);
        $this->db->delete('membrede');

// Produces:
// DELETE FROM mytable
// WHERE id = $id
    }
    public function Update($Donnee)
    {

    }
} // Fin Classe