<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
      $this->load->library('email');
      //$this->load->model('modelSInscrire');
      //  $this->load->library('session');
    //  if ($this->session->statut==0) // 0 : statut visiteur
    //  {
    //    $this->load->helper('url'); // pour utiliser redirect
    //    redirect('/visiteur/loadAccueil'); // pas les droits : redirection vers connexion
    //  }
   } // __construct

   public function loadAccueil()
   {
     $this->load->view('templates/Entete');
     //Modif ici!
     $this->load->view('Visiteur/menu'); // Pense peut être à le rajouter dans ma bare de menu ? 
    //modif ici ! 
     $this->load->view('Visiteur/loadAccueil');
     
     $this->load->view('templates/PiedDePage');
   }

   public function sInscrire()
   {
      $DonneesInjectees['Titre de la page']='Inscription';
     if ( $this->input->post('submit'))
     {
       $donneeParticipant=array(
         'nom'=>$this->input->post('nom'),
         'prenom'=>$this->input->post('prenom'),
         'datedenaissance'=>$this->input->post('datenaiss'),// la traduire à l'envers pour la bdd
         'sexe'=>$this->input->post('sexe'),
        );
       //var_dump($donneeParticipant);
       $this->load->model('ModelSInscrire', '', TRUE);
       $noparticipant = $this->ModelSInscrire->Insert_Participant($donneeParticipant);
      // $noparticipant = $this->ModelSInscrire->Insert_Participant($donneeParticipant);

       $donneeRandonneur=array(
         'noparticipant'=>$noparticipant,
         'mail'=>$this->input->post('mail'),
         'telportable'=>$this->input->post('tel'),
        );
       $this->ModelSInscrire->Insert_Randonneur($donneeRandonneur);
       $donneeResponsable = array(
         'noparticipant'=>$noparticipant,
         'motdepasse' => $this->input->post('mdp'),
         'mail' => $this->input->post('mail'),
         'telportable' => $this->input->post('tel')
        );
        $this->ModelSInscrire->Insert_Responsable($donneeResponsable);

        $donneeEquipe=array(
          'nopar_responsable'=>$noparticipant,
          'nomequipe'=>$this->input->post('nomequipe'),
        );
        $this->ModelSInscrire->Insert_Equipe($donneeEquipe);
        // appel du modèle
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/loadAccueil');
        $this->load->view('templates/PiedDePage');
      }else{
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
      }
   }
  

  public function seConnecter()
{
  $DonneesInjectees['Titre de la page']='Connexion';
  if ( $this->input->post('submit'))
  {
     $donneeResponsable=array(
       'mail'=>$this->input->post('mail'),
       'motdepasse'=>$this->input->post('mdp'),
      );
      $this->load->model('ModelseConnecter');
      $test = $this->ModelseConnecter->Test_Inscrit($donneeResponsable);
      if($test['count(*)']==0){
        echo 'Vous n\'êtes pas encore inscrit';
      }else if ($test['count(*)']==1){
        echo'OK';
        $this->load->view('templates/Entete');
        $this->load->view('Gestionnaire/participants');
        $this->load->view('Gestionnaire/gestion_course');
        $this->load->view('templates/PiedDePage');
      }else{
        echo 'Erreur';
      }   
  }else{
    $this->load->view('templates/Entete');
    $this->load->view('Visiteur/seConnecter',$DonneesInjectees);
    $this->load->view('templates/PiedDePage');
  }
}// seConnecter

public function recupmdp()
{
  $this->load->view('Visiteur/recupmdp');
  if ( $this->input->post('recupmail'))
  {
    $mail =  $this->input->post('mail');
    $this->load->model('ModelseConnecter', '', TRUE);
    //$this->load->model('ModelseConnecter');
    $test = $this->ModelseConnecter->Recup_mdp($mail);
    if ($test['motdepasse']!=null){
      //$test = $this->ModelseConnecter->Recup_mdp($mail);
      $this->email->from('mailing.randotroll@gmail.com');
      $this->email->to($mail); 
      $this->email->subject('Récupération du mot de passe');
      $this->email->message("Voici votre mot de passe : ".$test['motdepasse']);
      
      if (!$this->email->send())
      {
          $this->email->print_debugger();
          echo "Error";
      }
      else
      {
        $this->load->view('Visiteur/seConnecter');
        echo 'mail envoyé';
      }
    }
    else
    {
      echo 'vous n\'êtes pas encore inscrit';
      
    }
  }
} // recup mdp

//log the user out
function deconnexion()
{
  $this->data['title'] = "Deconnexion";
  //log the user out
  $deco = $this->ion_auth->deco();
  //redirect them back to the page they came from
  redirect('loadAccueil', 'refresh');
}
}  // Visiteur

