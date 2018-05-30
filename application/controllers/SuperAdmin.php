<?php

class SuperAdmin extends CI_Controller

{
    public function __construct()
    {
 
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper('assets'); // helper 'assets' ajouté a Application
       $this->load->library("pagination");
       $this->load->library('session');
       $this->load->model('ModeleSponsor'); // chargement modèle, obligatoire
       $this->load->model('ModeleContributeur'); // chargement modèle, obligatoire
       $this->load->model('ModeleAnnee'); // chargement modèle, obligatoire
       $this->load->model('ModeleAdmin'); // chargement modèle, obligatoire
       $this->load->model('ModeleCommission'); // chargement modèle, obligatoire
       $this->load->model('ModeleMail'); // chargement modèle, obligatoire
    } // __construct

    public function MenuSuperAdmin() // lister tous les articles
    {
       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/MenuSuperAdmin');
       $this->load->view('templates/PiedDePage');
    } // listerLesArticles

// ///////////////////////////////////////////////////////////////////////////////////////// Les méthodes sponsors \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

/////////////////////////////// Lister/Ajouter

    public function listerLesSponsors() // lister tous les articles
    {
        if($this->input->post('btnAjouter'))
        {
            $donneesAInserer = array
            (
                'NOM' => $this->input->post('txtNom'),
                'ADRESSE' => $this->input->post('txtAdresse'),
                'CODEPOSTAL' => $this->input->post('txtCodePostale'),
                'VILLE' => $this->input->post('txtVille'),
                'TELFIXE' => $this->input->post('txtTELFIXE'),
                'TELPORTABLECONTACT' => $this->input->post('txtTELPORTABLECONTACT'),
                'MAILCONTACT' => $this->input->post('txtMAILCONTACT')
            );
            $this->ModeleSponsor->insererUnSponsor($donneesAInserer); // appel du modèle
            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
            $this->load->view('SuperAdmin/RedirigerPagePrecedente');
        }
        else
        {
       $DonneesInjectees['lesSponsors'] = $this->ModeleSponsor->retournerSponsors();
       $DonneesInjectees['TitreDeLaPage'] = 'Tous les Sponsors';
 
       $this->load->library('table');
       $this->load->helper('form');

       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/listerLesSponsors', $DonneesInjectees);
       $this->load->view('templates/PiedDePage');
        }
    } // listerLesArticles

    /////////////////////////////// Modifier

    public function voirUnSponsor($noSponsor = NULL) // valeur par défaut de noSponsor = NULL
   {
    if($this->input->post('btnModifier'))
    {
        
        $donneesAInserer = array
        (
            'NOM' => $this->input->post('txtNom'),
            'ADRESSE' => $this->input->post('txtAdresse'),
            'CODEPOSTAL' => $this->input->post('txtCodePostale'),
            'VILLE' => $this->input->post('txtVille'),
            'TELFIXE' => $this->input->post('txtTELFIXE'),
            'TELPORTABLECONTACT' => $this->input->post('txtTELPORTABLECONTACT'),
            'MAILCONTACT' => $this->input->post('txtMAILCONTACT')
        );
        $DonneesInjectees['unSponsor'] = $this->ModeleSponsor->retournerUnSponsor($noSponsor);
        $test = $DonneesInjectees['unSponsor']['NOSPONSOR'];
        $this->ModeleSponsor->modifierUnSponsor($donneesAInserer, $test); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('SuperAdmin/RedirigerPagePrecedente');
    }
    else
    {
    $this->load->helper('form');
     $DonneesInjectees['unSponsor'] = $this->ModeleSponsor->retournerUnSponsor($noSponsor);
     if (empty($DonneesInjectees['unSponsor']))
     {   // pas de Sponsor correspondant au n° 
         show_404(); 
     }
     $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unSponsor']['NOM'];
     // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
     $this->load->view('templates/Entete');  
     $this->load->view('SuperAdmin/VoirUnSponsor', $DonneesInjectees);  
     $this->load->view('templates/PiedDePage');
   } // voirUnSponsor
}

// ////////////////////////////////////////////////////////////////////// Les méthodes contributeurs \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

/////////////////////////////// Lister/Ajouter

public function listerLesContributeurs() // lister tous les articles
{
    if($this->input->post('btnAjouter'))
    {
        $donneesAInserer = array
        (
            'NOM' => $this->input->post('txtNOM'),
            'PRENOM' => $this->input->post('txtPRENOM'),
            'EMAIL' => $this->input->post('txtEMAIL'),
            'TELPORTABLE' => $this->input->post('txtTELPORTABLE'),
            'TELFIXE' => $this->input->post('txtTELFIXE'),
            'ADRESSE' => $this->input->post('txtADRESSE'),
            'CODEPOSTAL' => $this->input->post('txtCODEPOSTAL'),
            'VILLE' => $this->input->post('txtVILLE'),
        );

        $EstApporteurDeSponsors = $this->input->post('cbxApporteurDeSponsors');
        $EstBenevole = $this->input->post('cbxBenevole');
        
        $this->ModeleContributeur->insererUnContributeur($donneesAInserer); // appel du modèle
        
        $IDduContributeurInserer = $this->ModeleContributeur->GetID();

        // Lancer l'insert dans aporteurDeBénévole

        if ($EstApporteurDeSponsors==true)
        {
            $this->ModeleContributeur->insererUnContributeurBenevole($IDduContributeurInserer);
        }

        // Lancer l'insert dans benevole

        if ($EstBenevole==true)
        {
            $this->ModeleContributeur->insererUnContributeurAporteurDeSponsors($IDduContributeurInserer);
        }

        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $this->load->view('SuperAdmin/RedirigerPagePrecedente');
    }
    else
    {
   $DonneesInjectees['lesContributeurs'] = $this->ModeleContributeur->retournerContributeurs();
   $DonneesInjectees['TitreDeLaPage'] = 'Tous les Contributeurs';

   $this->load->library('table');
   $this->load->helper('form');

   $this->load->view('templates/Entete');
   $this->load->view('SuperAdmin/listerLesContributeurs', $DonneesInjectees);
   $this->load->view('templates/PiedDePage');
    }
} // listerLesArticles

    /////////////////////////////////////////////// détail/modifier

public function voirUnContributeur($noContributeur = NULL) // valeur par défaut de noSponsor = NULL
{
if($this->input->post('btnModifier'))
{
    
    $donneesAInserer = array
    (
        'NOM' => $this->input->post('txtNOM'),
        'PRENOM' => $this->input->post('txtPRENOM'),
        'EMAIL' => $this->input->post('txtEMAIL'),
        'TELPORTABLE' => $this->input->post('txtTELPORTABLE'),
        'TELFIXE' => $this->input->post('txtTELFIXE'),
        'ADRESSE' => $this->input->post('txtADRESSE'),
        'CODEPOSTAL' => $this->input->post('txtCODEPOSTAL'),
        'VILLE' => $this->input->post('txtVILLE'),
    );
    $DonneesInjectees['unContributeur'] = $this->ModeleContributeur->retournerUnContributeur($noContributeur);
    $this->ModeleContributeur->modifierUnContributeur($donneesAInserer); // appel du modèle
    $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
    $this->load->view('SuperAdmin/RedirigerPagePrecedente');
}
else
{
$this->load->helper('form');
 $DonneesInjectees['unContributeur'] = $this->ModeleContributeur->retournerUnContributeur($noContributeur);
 if (empty($DonneesInjectees['unContributeur']))
 {   // pas de Contributeur correspondant au n° 
     show_404(); 
 }
 $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unContributeur']['NOM'];
 // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
 $this->load->view('templates/Entete');  
 $this->load->view('SuperAdmin/VoirUnContributeur', $DonneesInjectees);  
 $this->load->view('templates/PiedDePage');
} // voirUnContributeur
}

    // //////////////////////////////////////////////////////////////////////////////// Les Années \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    /////////////////////////////// Lister années

    public function listerLesAnnees() // lister tous les Annees
    {
       $DonneesInjectees['lesAnnees'] = $this->ModeleAnnee->retournerAnnees();
       $DonneesInjectees['TitreDeLaPage'] = 'Tous les Annees';
 
       $this->load->library('table');
       $this->load->helper('form');

       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/listerLesAnnees', $DonneesInjectees);
       $this->load->view('templates/PiedDePage');
        
    } // listerLesArticles

    /////////////////////////////// détail/modifier année

    public function voirUneAnnee($noAnnee = NULL) // valeur par défaut de noAnnee = NULL
{
    if($this->input->post('btnModifier'))
{
    
    $donneesAInserer = array
    (
        'DATECOURSE' => $this->input->post('txtDATECOURSE'),
        'DATECLOTUREINSCRIPTION' => $this->input->post('txtDATECLOTUREINSCRIPTION'),
        'LIMITEAGE' => $this->input->post('txtLIMITEAGE'),
        'TARIFINSCRIPTIONADULTE' => $this->input->post('txtTARIFINSCRIPTIONADULTE'),
        'TARIFREPASADULTE' => $this->input->post('txtTARIFREPASADULTE'),
        'TARIFINSCRIPTIONENFANT' => $this->input->post('txtTARIFINSCRIPTIONENFANT'),
        'TARIFREPASENFANT' => $this->input->post('txtTARIFREPASENFANT'),
        'MAXPARTICIPANTS' => $this->input->post('txtMAXPARTICIPANTS'),
        'MAXPAREQUIPE' => $this->input->post('txtMAXPAREQUIPE'),
        'MAILORGANISATION' => $this->input->post('txtMAILORGANISATION'),
        'CHEMINPDFLIVRET' => $this->input->post('txtCHEMINPDFLIVRET'),
        'CHEMINIMAGEAFFICHE' => $this->input->post('txtCHEMINIMAGEAFFICHE'),
        'CHEMINIMAGEAFFICHETTE' => $this->input->post('txtCHEMINIMAGEAFFICHETTE'),
    );
    $this->ModeleAnnee->modifierUneAnnee($donneesAInserer); // appel du modèle
    $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
    $this->load->view('SuperAdmin/RedirigerPagePrecedente');
}
    else
    { 
    $this->load->helper('form');
    $DonneesInjectees['uneAnnee'] = $this->ModeleAnnee->retournerUneAnnee($noAnnee);
    if (empty($DonneesInjectees['uneAnnee']))
         { // pas de Annee correspondant au n° 
            show_404(); 
         }
    $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['uneAnnee']['ANNEE'];
    // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
    $this->load->view('templates/Entete');  
    $this->load->view('SuperAdmin/voirUneAnnee', $DonneesInjectees);  
    $this->load->view('templates/PiedDePage');
        }
    }

    /////////////////////////////// Ajouter une année

    public function ajouterUneAnnee() // valeur par défaut de noAnnee = NULL
    {
        if($this->input->post('btnAjouter'))
    {
        
        $donneesAInserer = array
        (
            'ANNEE' => $this->input->post('txtANNEE'),
            'DATECOURSE' => $this->input->post('txtDATECOURSE'),
            'DATECLOTUREINSCRIPTION' => $this->input->post('txtDATECLOTUREINSCRIPTION'),
            'LIMITEAGE' => $this->input->post('txtLIMITEAGE'),
            'TARIFINSCRIPTIONADULTE' => $this->input->post('txtTARIFINSCRIPTIONADULTE'),
            'TARIFREPASADULTE' => $this->input->post('txtTARIFREPASADULTE'),
            'TARIFINSCRIPTIONENFANT' => $this->input->post('txtTARIFINSCRIPTIONENFANT'),
            'TARIFREPASENFANT' => $this->input->post('txtTARIFREPASENFANT'),
            'MAXPARTICIPANTS' => $this->input->post('txtMAXPARTICIPANTS'),
            'MAXPAREQUIPE' => $this->input->post('txtMAXPAREQUIPE'),
            'MAILORGANISATION' => $this->input->post('txtMAILORGANISATION'),
            'CHEMINPDFLIVRET' => $this->input->post('txtCHEMINPDFLIVRET'),
            'CHEMINIMAGEAFFICHE' => $this->input->post('txtCHEMINIMAGEAFFICHE'),
            'CHEMINIMAGEAFFICHETTE' => $this->input->post('txtCHEMINIMAGEAFFICHETTE'),
        );
        $this->ModeleAnnee->insererUneAnnee($donneesAInserer); // appel du modèle
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        
        $DonneesInjectees['lesAnnees'] = $this->ModeleAnnee->retournerAnnees();
        $DonneesInjectees['TitreDeLaPage'] = 'Tous les Annees';
 
        $this->load->library('table');
        $this->load->helper('form');

        $this->load->view('templates/Entete');
        $this->load->view('SuperAdmin/listerLesAnnees', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
    }
        else
        { 
        $this->load->helper('form');
        // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
        $this->load->view('templates/Entete');  
        $this->load->view('SuperAdmin/ajouterUneAnnee');  
        $this->load->view('templates/PiedDePage');
            }
        }


        
        // ///////////////////////////////////////////////////////////////// Administrateur \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


        public function listerLesAdmins() // lister tous les Admins
        {
            $DonneesInjectees['lesAdmins'] = $this->ModeleAdmin->retournerAdmins();
            $DonneesInjectees['TitreDeLaPage'] = 'Tous les Admins';
 
            $this->load->helper('form');

            $this->load->view('templates/Entete');
            $this->load->view('SuperAdmin/listerLesAdmins', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        
        } // listerLesAdmins

        public function ChoisirNouvelAdmin() // lister tous les Admins
        {
            $DonneesInjectees['lesBénévoles'] = $this->ModeleAdmin->retournerBenevoles();
            $DonneesInjectees['TitreDeLaPage'] = 'Tous les Quel bénévole à rendre admin ?';
 
            $this->load->helper('form');

            $this->load->view('templates/Entete');
            $this->load->view('SuperAdmin/ChoisirNouvelAdmin', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        
        } // listerLesAdmins

        public function nouvelAdmin($nocontributeur)
        {
            if($this->input->post('btnAjouter'))
    {
            $donneesAInserer = array
            (
                'NOCONTRIBUTEUR' => $this->session->IDnouvelAdmin,
                'MOTDEPASSE' => $this->input->post('txtMDP'),
                'PROFIL' => $this->input->post('typeAdmin'),
            );
            $this->ModeleAdmin->insererUnAdmin($donneesAInserer); // appel du modèle
            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
            
            $DonneesInjectees['lesAdmins'] = $this->ModeleAdmin->retournerAdmins();
            $DonneesInjectees['TitreDeLaPage'] = 'Tous les Admins';
 
            $this->load->helper('form');

            $this->load->view('templates/Entete');
            $this->load->view('SuperAdmin/listerLesAdmins', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
        else
    {
    $this->load->helper('form');

    $DonneesInjectees['NOCONTRIBUTEUR'] = $nocontributeur;
    
    $this->load->view('templates/Entete');  
    $this->load->view('SuperAdmin/nouvelAdmin', $DonneesInjectees);  
    $this->load->view('templates/PiedDePage');
    }
    }

    
        // ///////////////////////////////////////////////////////////////// Commission \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        public function listerLesCommissions() // lister tous les Annees
    {
       $DonneesInjectees['lesCommissions'] = $this->ModeleCommission->retournerCommissions();
       $DonneesInjectees['TitreDeLaPage'] = 'Tous les Commissions';
 
       $this->load->library('table');
       $this->load->helper('form');

       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/listerLesCommissions', $DonneesInjectees);
       $this->load->view('templates/PiedDePage');
        
    } // listerLesArticles
    public function gererUneCommission($NoCommission) // lister tous les Annees
    {
        $DonneesInjectees['lesBenevoles'] = $this->ModeleCommission->retournerBenevolesCommission($NoCommission);
        $DonneesInjectees['TitreDeLaPage'] = 'Tous les Commissions';
        $DonneesInjectees['NoCommission'] = $NoCommission;

       $this->load->library('table');
       $this->load->helper('form');

       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/gererUneCommission', $DonneesInjectees);
       $this->load->view('templates/PiedDePage');
    }

    public function ajoutBenevoleCommission($NoCommission) // lister tous les Annees
    {
        if($this->input->post('btnAjouter'))
        {
            $BenevolesARatacher = array();
            $NBbenevolesDispos = $this->session->NBBenevoleARatacher;
            $J = 0;
            $NBbenevolesCoches = 0;
            for($I = 0; $I < $NBbenevolesDispos; $I++)
            {
                if ($this->input->post($I)==true)
                {
                    $BenevolesARatacher[$J] = $this->input->post($I);
                    $J++;
                    $NBbenevolesCoches++;
                }
            }
            
            $this->ModeleCommission->insererBenevolesCommission($BenevolesARatacher, $NBbenevolesCoches, $NoCommission);
            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)

            $DonneesInjectees['lesBenevoles'] = $this->ModeleCommission->retournerBenevolesCommission($NoCommission);
        $DonneesInjectees['TitreDeLaPage'] = 'Tous les Commissions';
        $DonneesInjectees['NoCommission'] = $NoCommission;

       $this->load->library('table');
       $this->load->helper('form');

       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/gererUneCommission', $DonneesInjectees);
       $this->load->view('templates/PiedDePage');
        }
        else
        {
        $DonneesInjectees['lesBenevoles'] = $this->ModeleCommission->retournerBenevolesDispo($NoCommission);
        $DonneesInjectees['TitreDeLaPage'] = 'Tous les Commissions';
        $DonneesInjectees['NoCommission'] = $NoCommission;

       $this->load->library('table');
       $this->load->helper('form');

       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/ajoutBenevoleCommission', $DonneesInjectees);
       $this->load->view('templates/PiedDePage');
        }
    }

    public function detacherBenevole($NoCommission, $nocontributeur) // lister tous les Annees
    {
        $this->ModeleCommission->detacherBenevoleCommission($NoCommission, $nocontributeur);

        $DonneesInjectees['lesBenevoles'] = $this->ModeleCommission->retournerBenevolesCommission($NoCommission);
        $DonneesInjectees['TitreDeLaPage'] = 'Tous les Commissions';
        $DonneesInjectees['NoCommission'] = $NoCommission;

       $this->load->library('table');
       $this->load->helper('form');

       $this->load->view('templates/Entete');
       $this->load->view('SuperAdmin/gererUneCommission', $DonneesInjectees);
       $this->load->view('templates/PiedDePage');
    }

    // ///////////////////////////////////////////////////////////// Gestion des mails \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    public function gestionMail() // lister tous les Annees
    {
        $this->load->helper('form');

        $this->load->view('templates/Entete');
        $this->load->view('SuperAdmin/gestionMail');
        $this->load->view('templates/PiedDePage');
    }

    public function envoiMailPerso() // lister tous les Annees
    {
        
        if($this->input->post('btnEnvoyer'))
        {
            $this->load->library('email');

            $Sujet = $this->input->post('tbxObjetMail');
            $Mail = $this->input->post('txtMail');

            $this->email->from('mailing.randotroll@gmail.com', 'fff');

            $this->email->to('jl.veloso@laposte.net');
            $this->email->subject('Tu me dois du fric');
            $this->email->message('Coucou Jean-Paul ”. ”\n”.” Tu me dois du fric xD”.”\n”.”\n”.”Merci de me rembourser');

            $this->email->send();

            // ///////////////////////////



            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)

            $DonneesInjectees['LesSponsors'] = $this->ModeleMail->retournerSponsors();
            $DonneesInjectees['Utilies'] =  $Utilies = array(
                'lien' => 'MailingPromo',
                'titre'=> '<H1>Envoie de mails promotionnels</H1>',
            );
            $this->load->helper('form');
            

            $this->load->view('templates/Entete');
            $this->load->view('SuperAdmin/mailPerso', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
        else
        {
            $DonneesInjectees['LesSponsors'] = $this->ModeleMail->retournerSponsors();
            $DonneesInjectees['Utilies'] =  $Utilies = array(
                'lien' => 'MailingPromo',
                'titre'=> '<H1>Envoie de mails promotionnels</H1>',
            );
            $this->load->helper('form');
            

            $this->load->view('templates/Entete');
            $this->load->view('SuperAdmin/mailPerso', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        }
    }
}