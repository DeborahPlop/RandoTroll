<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
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
       $noparticipant=$this->ModelSInscrire->Insert_Participant($donneeParticipant);
       
       
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

         }else{
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
   }
  
  
  public function participants()
  {
    $this->load->view('Visiteur/participants');
    
  }

  public function seConnecter()
{
  $this->load->helper('form');
  $this->load->library('form_validation');
  $DonneesInjectees['Accueil'] = 'Se connecter';
  $this->form_validation->set_rules('txtIdentifiant', 'Identifiant', 'required');
  $this->form_validation->set_rules('txtMotDePasse', 'Mot de passe', 'required');
  $this->load->view('Visiteur/seConnecter');
}// seConnecter

public function recupmdp()
{
  $this->load->view('Visiteur/recupmdp');
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
//change password
public function forgot_password()
  {
    $this->form_validation->set_rules('email', 'Email Address', 'required');
    if ($this->form_validation->run() == false)
    {
      //setup the input
      $this->data['email'] = array('name' => 'email',
        'id' => 'email',
      );
      //set any errors and display the form
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $this->render();
    }
    else
    {
      //run the forgotten password method to email an activation code to the user
      $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));
      if ($forgotten)
      { //if there were no errors
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
      }
      else
      {
        $this->session->set_flashdata('message', $this->ion_auth->errors());
        redirect("auth/forgot_password", 'refresh');
      }
    }
  }
}  // Visiteur

