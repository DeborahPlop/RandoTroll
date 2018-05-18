<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
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
     $this->load->view('Visiteur/menu');
     $this->load->view('Visiteur/loadAccueil');
     
     $this->load->view('templates/PiedDePage');
   }
  public function sInscrire()
  {
    $DonneesInjectees['TitreDeLaPage'] = 'S\'inscrire';
    
    if ($this->form_validation->run() === FALSE)
    {   // formulaire non validé, on renvoie le formulaire
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/sInscrire', $DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
    else
    {
      $mdp = $this->input->post('mdp');
      echo $mdp;
      $confmdp = $this->input->post('confmdp');
      echo $confmdp;
      if ($mdp == $confmdp)
          {
            echo("MERDE");
            //$this->load->view('Visiteur/loadAccueil');
          }
      else {
        echo 'ICI';
        $donneesAInserer = array(
          'noEquipe' => $this->input->post('nomequipe'),
          'mail' => $this->input->post('mail'),
          'motdepasse' => $this->input->post('mdp'),
          'telportable' => $this->input->post('tel'));

          // $this->ModeleArticle->insererUnArticle($donneesAInserer); // appel du modèle
          $this->load->view('Visiteur/loadAccueil');
          $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
          $this->load->model('ModelSInscrire/Inscription');
          //$this->load->view('administrateur/insertionReussie');
      }
    }
  } // function sinscrire

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

