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
     
      //  $this->load->library('session');
    //  if ($this->session->statut==0) // 0 : statut visiteur
    //  {
    //    $this->load->helper('url'); // pour utiliser redirect
    //    redirect('/visiteur/loadAccueil'); // pas les droits : redirection vers connexion
    //  }
   } // __construct
public function gestion_compte()
  {
    $this->load->view('templates/Entete');
    $this->load->view('Gestionnaire/gestion_compte');
    $this->load->view('templates/PiedDePage');
  }
  public function reinscrire_equipe()
  {
    $this->load->view('templates/Entete');
    $this->load->view('Gestionnaire/reinscrire_equipe');
    $this->load->view('templates/PiedDePage');
  }
  public function gestion_course()
  {
    $this->load->library('table');
    $this->load->view('templates/Entete');
    $this->load->view('Gestionnaire/gestion_course');
    $this->load->view('Gestionnaire/participants');
    $this->load->view('templates/PiedDePage');
  }
 
}  // Gestionnaire
?>