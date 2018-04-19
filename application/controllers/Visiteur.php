<?php
class Visiteur extends CI_Controller {
  public function __construct()
  {
     parent::__construct();

     $this->load->database();
     $this->load->helper('url');
     $this->load->helper('assets');

     $this->load->library('session');
    // if ($this->session->statut==0) // 0 : statut visiteur
     //{

    // $this->load->helper('url'); // pour utiliser redirect
    //redirect('/visiteur/seConnecter'); // pas les droits : redirection vers connexion
     //}
  } // __construct

 // public function accueil()
  //{
  //  $this->load->view('templates/PiedDePage');
  //}
  public function seConnecter()
{
   $this->load->helper('form');
   $this->load->library('form_validation');
   $this->load->view('templates/Entete');
   $this->load->view('Visiteur/seConnecter');
   $this->load->view('templates/PiedDePage');
   $DonneesInjectees['Accueil'] = 'Se connecter';
   $this->form_validation->set_rules('txtIdentifiant', 'Identifiant', 'required');
   $this->form_validation->set_rules('txtMotDePasse', 'Mot de passe', 'required');
   
   // Les champs txtIdentifiant et txtMotDePasse sont requis
   // Si txtMotDePasse non renseigné envoi de la chaine 'Mot de passe' requis

//    if ($this->form_validation->run() === FALSE)
//    {  // échec de la validation
// // cas pour le premier appel de la méthode : formulaire non encore appelé
  
// $this->load->view('visiteur/seConnecter', $DonneesInjectees); // on renvoie le formulaire
// $this->load->view('templates/PiedDePage');
//    }
//    else
//    {  // formulaire validé
// $Utilisateur = array( // cIdentifiant, cMotDePasse : champs de la table tabutilisateur
//    'cIdentifiant' => $this->input->post('txtIdentifiant'),
//    'cMotDePasse' => $this->input->post('txtMotDePasse'),
// ); // on récupère les données du formulaire de connexion

// // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
// $UtilisateurRetourne = $this->ModeleUtilisateur->retournerUtilisateur($Utilisateur);

// if (!($UtilisateurRetourne == null))
// {    // on a trouvé, identifiant et statut (droit) sont stockés en session
//      $this->load->library('session');
//      $this->session->identifiant = $UtilisateurRetourne->cIdentifiant;
//      $this->session->statut = $UtilisateurRetourne->cStatut;

//      $DonneesInjectees['Identifiant'] = $Utilisateur['cIdentifiant'];
//      //$this->load->view('templates/Entete');
//   $this->load->view('visiteur/connexionReussie', $DonneesInjectees);
//      $this->load->view('templates/PiedDePage');
// }
// else
// {    // utilisateur non trouvé on renvoie le formulaire de connexion

//      $this->load->view('templates/Entete');

//      $this->load->view('visiteur/seConnecter', $DonneesInjectees);

//      $this->load->view('templates/PiedDePage');

// }  

}
} // fin seConnecter

?>
