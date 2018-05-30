<?php

class Gestionnaire extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->library('session');
      if ($this->session->statut !=1)
       {
         redirect('Visiteur/loadAccueil');
       }

   } // __construct
public function gestion_compte()
  {
    if ( $this->input->post('ok'))
    {
      if (($this->input->post('mdp'))!= null && ($this->input->post('confmdp'))!= null && ($this->input->post('newmdp'))!= null)
      {
        $DonneesInjectees=array(
          'motdepasse'=>$this->input->post('newmdp'),
          'mdp'=>$this->input->post('mdp'),
        );
        $this->load->model('ModelEquipe');
        $test = $this->ModelEquipe->UpdateMDP($DonneesInjectees);
      
      }
      if ((($this->input->post('tel'))!= null && ($this->input->post('newtel'))!= null))
      {
        $DonneesInjectees=array(
          'newtel'=>$this->input->post('newtel'),
          'tel'=>$this->input->post('tel'),
        );
        $this->load->model('ModelEquipe');
        $test = $this->ModelEquipe->UpdateTel($DonneesInjectees);
      }
      $this->load->view('templates/Entete');
      $this->load->view('Gestionnaire/gestion_course');
      $this->load->view('templates/PiedDePage');
    }
    else
    {
      $this->load->view('templates/Entete');
      $this->load->view('Gestionnaire/gestion_compte');
      $this->load->view('templates/PiedDePage');
    }
  }

public function reinscrire_equipe()
{
  if ( $this->input->post('connexion'))
  {
    $donneeATester=$this->input->post('mail');
    $this->load->model('ModelSInscrire');
    $test=$this->ModelSInscrire->Test_Inscrit($donneeATester);
    if ($test['count(*)']==1)
    {
      $DonneesInjectees=array(
        // tout les membres de l'equipe où le responsable à cette adresse mail
        // + reinscrire=1 
      );
    $this->load->view('templates/Entete');
    $this->load->view('Gestionnaire/participant',$DonneesInjectees);
    $this->load->view('templates/PiedDePage');
    }
    if ( $this->input->post('reinscrire'))
    {
      // appel du model pour inscrire dans participant, randonneur et membrede (deja fait)
    }
  }
  else{
    $this->load->view('templates/Entete');
    $this->load->view('Gestionnaire/reinscrire_equipe');
    $this->load->view('templates/PiedDePage');
  }
}
public function gestion_course()
{

    $DonneesInjectees['Titre de la page']='Gestion Equipe';
   
    $DonneesInjectees=array(
      'annee'=>$this->session->Annee,
      'noparticipant'=>$this->session->NoParticipant,
    );
    var_dump($DonneesInjectees);
    $this->load->model('ModelEquipe');
    $membres = $this->ModelEquipe->Membre($DonneesInjectees);
    $donnee=array(
      'membres'=>$membres
    );
    var_dump($donnee);
    $this->load->library('table');
   

    if ($this->input->post('ajout'))
    {
      $donneeParticipant=array(
        'nom'=>$this->input->post('nom'),
        'prenom'=>$this->input->post('prenom'),
        'datedenaissance'=>$this->input->post('datenaiss'),// la traduire à l'envers pour la bdd
        'sexe'=>$this->input->post('sexe'),
      );
      $this->load->model('ModelSInscrire');
      $noparticipant =$this->ModelSInscrire->Insert_Participant($donneeParticipant);

      $donneeRandonneur=array(
        'noparticipant'=>$noparticipant,
        'mail'=>$this->input->post('mail'),
        'telportable'=>$this->input->post('tel'),
      );
      $this->ModelSInscrire->Insert_Randonneur($donneeRandonneur);
      $DonneeMembre=array(
        'noparticipant'=>$this->session->NoParticipant,
        'annee'=>$this->session->Annee,
      );
      $this->load->model('ModelEquipe');
     $noequipe= $this->ModelEquipe-> Recup_noequipe($DonneeMembre);
     if ($this->input->post('repas') == null)
     {
       $repassurplace=0;
     }
     else{
      $repassurplace=1;
     }
      $donneeaInserer=array(
        'noparticipant'=>$noparticipant,
        'annee'=>$this->session->Annee,
        'noequipe'=>$noequipe['noequipe'],
        'repassurplace'=>$repassurplace,
      );

      $this->load->model('ModelEquipe');
      $this->ModelEquipe->Insert_MembreDe($donneeaInserer);

      $this->load->view('templates/Entete');
      $this->load->view('Gestionnaire/participants',$donnee);
      $this->load->view('templates/PiedDePage');
    }
    else
    {
      $this->load->view('templates/Entete');

      $this->load->view('Gestionnaire/participants',$donnee);
      $this->load->view('templates/PiedDePage');
    }
    // $this->load->model('ModelEquipe');
    //  $test = $this->ModelEquipe->Recup_DateValid($DonneesInjectees);
    //  if ($test != null)
    // {
    //   $this->load->view('Gestionnaire/gestion_course');
    //  }
}
 
}  // Gestionnaire
?>