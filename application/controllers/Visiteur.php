<?php

class Visiteur extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('url');
      $this->load->helper('assets'); // helper 'assets' ajouté a Application
      $this->load->library("pagination");
      $this->load->model('ModelSInscrire');
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
     //$plop=1;
      $DonneesInjectees['Titre de la page']='Inscription';
     if ( $this->input->post('submit'))
     {
    $donneesAInserer = array(
      //'noEquipe' => $this->input->$plop,
      'mail' => $this->input->post('mail'),
      'motdepasse' => $this->input->post('mdp'),
      'telportable' => $this->input->post('tel'));

      $this->ModelSInscrire->Inscription($donneesAInserer); // appel du modèle
      //$this->load->view('Visiteur/loadAccueil');
      //$this->load->view('administrateur/insertionReussie');
    }else{
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
   }
  public  function index()
  {
    if(isset($_POST['Valider l\'inscription'])){
    
  }
    //Including validation library
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    //Validating Name Field
    $this->form_validation->set_rules('nomequipe', 'Nom de l\'equipe', 'required');
      
    //Validating Email Field
    $this->form_validation->set_rules('mail', 'Email d\'identification:', 'required|valid_email');
      
    //Validating Mobile no. Field
    $this->form_validation->set_rules('tel', 'Téléphone du responsable', 'required|regex_match[/^[0-9]{10}$/]');
      
    //Validating Password Field
    $this->form_validation->set_rules('mdp', 'Mot de Passe', 'required|min_length[8]|max_length[15]');
      
    if ($this->form_validation->run() == FALSE) 
    {
      echo ('pas run');
      $this->load->view('Visiteur/sInscrire');
    } else 
    {
      echo ('run');
      $plop=1;
      //Setting values for tabel columns
      $data = array(
      'noparticipant'=>$this-> input->$plop, // test apres faire noparticipant +=1
      //'noparticipant' => $this->input->post('nomequipe'), le nomequipe est dans la table equipe
      'mail' => $this->input->post('mail'),
      'telportable' => $this->input->post('tel'),
      'motdepasse' => $this->input->post('mdp')
      );
      //Transfering data to Model
      $this->insert_model->form_insert($data);
      $data['message'] = 'Data Inserted Successfully';
      //Loading View
      $this->load->view('Visiteur/sInscrire', $data);
      }// fin else
    }//fin index
  
   

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

