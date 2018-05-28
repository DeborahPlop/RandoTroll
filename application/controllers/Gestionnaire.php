<?php

class Gestionnaire extends CI_Controller {
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
public function gestion_compte()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->view('Gestionnaire/gestion_compte');
    
  }
  public function reinscrire_equipe()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->view('Gestionnaire/reinscrire_equipe');
  }
  public function gestion_course()
  {
    $this->load->library('table');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->view('Gestionnaire/gestion_course');
    $this->load->view('Gestionnaire/participants');
  }
  public function change_password()
  {
    $this->form_validation->set_rules('mdp', 'Mot de Passe', 'required');
    $this->form_validation->set_rules('newmdp', 'Nouveau Mot de Passe');
    $this->form_validation->set_rules('newconf', 'Confirmer le nouveau Mot de passe', 'required');
  }
  //forgot password
  
  //reset password - final step for forgotten password
  public function reset_password($code)
  {
    $reset = $this->ion_auth->forgotten_password_complete($code);
    if ($reset)
    {  //if the reset worked then send them to the login page
      $this->session->set_flashdata('message', $this->ion_auth->messages());
      redirect("auth/login", 'refresh');
    }
    else
    { //if the reset didnt work then send them back to the forgot password page
      $this->session->set_flashdata('message', $this->ion_auth->errors());
      redirect("auth/forgot_password", 'refresh');
    }
  }

}  // Gestionnaire
?>