<?php

class Visiteur extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('assets'); // helper 'assets' ajouté a Application
    $this->load->library("pagination");
    $this->load->library('email');
    $this->load->model('modelSInscrire');
    $this->load->model('ModelImpayes');
    $this->load->library('session');
  } // __construct

  public function loadAccueil()
  {
    $AnneeEnCours = $this->ModelImpayes->getAnneeEnCours();
    //var_dump($AnneeEnCours);

    /*
    
Select NoEquipe 
From Sinscrire
Where Annee = 2018 AND noequipe Not In(
SELECT `NOEQUIPE` FROM Sinscrire WHERE `DATEVALIDATION` is null)

Select NoEquipe 
From Sinscrire
Where Annee = 2018 AND `DATEVALIDATION` is not null
    */
    
    $noEquipes = $this->modelSInscrire->getNoEquipesInscrites($AnneeEnCours[0]['ANNEE']);
    //var_dump($noEquipes);
    $somme = 0;
    foreach($noEquipes as $unNoequipe):
      
      $Infos =array(
        'NOEQUIPE'=>$unNoequipe['NoEquipe'],
        'ANNEE'=>$AnneeEnCours[0]['ANNEE'],
      
      );
      $nombreMembre=$this->modelSInscrire->getNbMembres($Infos);
      //var_dump($nombreMembre['count(*)']);
      $somme = $somme + $nombreMembre['count(*)'] ;
      //$DateCourse = date_create();($AnneeEnCours[0]['DATECOURSE'],"d/m/Y");

    endforeach;

    $Données = array(
      'AnneEnCours'=>$AnneeEnCours[0]['ANNEE'],
      'DateCourse'=>$AnneeEnCours[0]['DATECOURSE'],
      'MaxParticipants'=>$AnneeEnCours[0]['MAXPARTICIPANTS'],
      'nbInscrits'=>$somme,
    );

    //var_dump($Données);
    $this->load->view('templates/Entete');
    //$this->load->view('Visiteur/seConnecter'); // Pense peut être à le rajouter dans ma bare de menu ? 
    $this->load->view('Visiteur/loadAccueil',$Données);
    $this->load->view('templates/PiedDePage');
  }//fin loadAcceuil

  public function sInscrire()
  {
     $DonneesInjectees['Titre de la page']='Inscription';
     if ( $this->input->post('valider'))
     {
       if (($this->input->post('mdp'))==($this->input->post('confmdp')))
       {
        $donneeATester=$this->input->post('mail');
        $this->load->model('ModelSInscrire');
        $test = $this->ModelSInscrire->Test_Inscrit($donneeATester);
        if($test['count(*)']!=0)
        {
          $DonneesInjectees=array
          (
            'nom'=>$this->input->post('nom'),
            'prenom'=>$this->input->post('prenom'),
            'datenaiss'=>$this->input->post('datenaiss'),// la traduire à l'envers pour la bdd
            'sexe'=>$this->input->post('sexe'),
            'nomequipe'=>$this->input->post('nomequipe'),
            'mail' =>"" ,
            'tel' => $this->input->post('tel'),
            'message' => 'Vous êtes déjà inscrit avec cette adresse mail'
          );

           $this->load->view('templates/Entete');
           //var_dump($DonneesInjectees);
           $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
           $this->load->view('templates/PiedDePage');
        }
        else
        {
          $donneeATester=$this->input->post('nomequipe');     
          $this->load->model('ModelSInscrire');
          $test = $this->ModelSInscrire->Test_Equipe($donneeATester);
          if($test['count(*)']!=0)
          {
            $DonneesInjectees=array(
              'nom'=>$this->input->post('nom'),
              'prenom'=>$this->input->post('prenom'),
              'datenaiss'=>$this->input->post('datenaiss'),// la traduire à l'envers pour la bdd
              'sexe'=>$this->input->post('sexe'),
              'nomequipe'=>"",
              'mail' =>$this->input->post('mail') ,
              'tel' => $this->input->post('tel'),
              'message' => 'Ce nom d\'équipe a déjà été prit'
             );
  
             $this->load->view('templates/Entete');
             //var_dump($DonneesInjectees);
             $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
             $this->load->view('templates/PiedDePage');
          }
          else 
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
          }//else nom equipe
        }// else mail
       }// if mdp== confmdp
       else
       {
         $DonneesInjectees=array(
          'nom'=>$this->input->post('nom'),
          'prenom'=>$this->input->post('prenom'),
          'datenaiss'=>$this->input->post('datenaiss'),// la traduire à l'envers pour la bdd
          'sexe'=>$this->input->post('sexe'),
          'nomequipe'=>$this->input->post('nomequipe'),
          'mail' => $this->input->post('mail'),
          'tel' => $this->input->post('tel'),
          'message' => 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit'
         );
        $this->load->view('templates/Entete');
        //var_dump($DonneesInjectees);
        $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
        $this->load->view('templates/PiedDePage');
        //echo 'La confirmation de mot de passe n\'est pas similaire au mot de passe écrit';
       }
     }// if bouton valider
     else
     {
      $DonneesInjectees=array
      (
        'nom'=>"",
        'prenom'=>"",
        'datenaiss'=>"",// la traduire à l'envers pour la bdd
        'nomequipe'=>"",
        'mail' =>"",
        'tel' => "",
        'message'=>'',
      );
       $this->load->view('templates/Entete');
       //var_dump($DonneesInjectees);
       $this->load->view('Visiteur/sInscrire',$DonneesInjectees);
       $this->load->view('templates/PiedDePage');
     }
  }// fin function
  
  public function seConnecter()
  {
    $donneeCoAdmin=$this->input->post('mail');
     
    $this->load->model('ModelseConnecter');
    $testA = $this->ModelseConnecter->Test_Admin($donneeCoAdmin);
  
    $donneeConnexion=array(
      'mail'=>$this->input->post('mail'),
      'motdepasse'=>$this->input->post('mdp'),
    );

      $this->load->model('ModelseConnecter');
      $test = $this->ModelseConnecter->Test_Inscrit($donneeConnexion);
   
      if($test['count(*)']==0 && $testA['count(*)']==0){
        echo 'Vous n\'êtes pas encore inscrit';
        if ($this->session->statut==0) // 0 : statut visiteur
        {
          redirect('/visiteur/loadAccueil'); // pas les droits : redirection vers connexion
        }
      }else if ($test['count(*)']==1){
        echo'OK';
        $this->session->statut=1;//1 = Responsable equipe
        $mail=$this->input->post('mail');
        $this->load->model('ModelseConnecter');
        $DonneesInjectees = $this->ModelseConnecter->Recup_noequipe($mail);
        $this->load->library('table');
        $this->load->view('templates/Entete');
        $this->load->view('Gestionnaire/participants',$DonneesInjectees); //donnéesinjectées=noequipe
        $this->load->view('Gestionnaire/gestion_course');
        $this->load->view('templates/PiedDePage');
      }else if ($testA['count(*)']==1){
        $mail=$this->input->post('mail');

        $this->load->model('ModelseConnecter');
        $testA = $this->ModelseConnecter->Recup_profilAdmin($mail);
        $this->session->statut=$resultat;// resultat = profil de l'admin

      }else{
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/seConnecter',$DonneesInjectees);
      $this->load->view('templates/PiedDePage');
    }
  }// seConnecter
 
  public function recupmdp()
  {
    $mail =  $this->input->post('mail');
    $this->load->model('ModelseConnecter', '', TRUE);
    $test = $this->ModelseConnecter->Recup_mdp($mail);
    if ($test['motdepasse']!=null){
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
        echo 'vous n\'êtes pas encore inscrit';

      }
    }
    else{
      $this->load->view('Visiteur/recupmdp');
    }
  } // recup mdp

  public function seDeconnecter() 
  { // destruction de la session = déconnexion
    if ( $this->input->post('deco'))
    {
      //$this->session->sess_destroy();
      $this->load->view('templates/Entete');
      $this->load->view('Visiteur/seConnecter');
      $this->load->view('templates/PiedDePage');
    }
  }
  else{
    $this->load->view('templates/Entete');
    $this->load->view('Visiteur/recupmdp');
    $this->load->view('templates/PiedDePage');
  }
} // recup mdp

public function seDeconnecter() 
{ // destruction de la session = déconnexion
  if ( $this->input->post('deco'))
  {
    $this->session->sess_destroy();
    $this->load->view('templates/Entete');
    $this->load->view('Visiteur/seConnecter');
    $this->load->view('templates/PiedDePage');
  }
}// deconnexion

}  // Visiteur

