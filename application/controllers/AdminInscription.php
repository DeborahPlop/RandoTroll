<html>
<?php 
//Randotroll0!

Class AdminInscription extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('assets'); // helper 'assets' ajouté a Application
        //$this->load->library("pagination");
        //$this->load->model('ModelSInscrire');
        //this->load->model('ModelMembreDe');
        $this->load->library('email');
        $this->load->model('ModelMailingPromo');
        $this->load->model('ModelImpayes');
       
        // chargement modèle, obligatoire
       //$this->load->model('');
    }

    public function RelanceImpayes()
    {
        if($this->input->post('submit'))
        {
            //Mailing
            //echo('Coucou tu as réussi à faire un submit correcte');
            $Message = $this->input->post('mail');
            $DonneesInjectees['Equipes'] = $this->ModelImpayes->getImpayes();
            //echo $Message;
            
            $DonnesUtiles = $this->ModelImpayes->getAnneeEnCours();
            $DateFin = $DonnesUtiles[0]['DATECLOTUREINSCRIPTION'];
            $DateFin = date_create($DateFin);
            $DateFin = date_format($DateFin,"d/m/Y");
           
            // var_dump($DonnesUtiles);

            // //var_dump($DonneesInjectees);
            $reussite = 0 ;
            $i = 0;
            $Mails;
            $j=0;            
            foreach($DonneesInjectees['Equipes'] as $uneEquipe) : 
                //echo($uneEquipe['MAIL']);
                $Somme =  $this->ModelImpayes->getSommeDueParEquipe($uneEquipe['NOEQUIPE']) - $uneEquipe['MONTANTPAYE'];
                $Somme = number_format($Somme,2);
                
                //$DateFin = $DonnesUtiles[]
                $this->email->from('mailing.randotroll@gmail.com');
                $this->email->to($uneEquipe['MAIL']); 
                $this->email->subject('Reste a payer');
                $this->email->message($Message."\n"."Vous nous devez la somme de : ".$Somme."€ à regler avant le : ".$DateFin."\n".
                "Merci
                ");
                
                if (!$this->email->send())
                {
                    $this->email->print_debugger();
                    echo "Error";
                    if($reussite != 0)
                    {
                        $reussite -= 1;
                    }
                    $Mails[$j] = $uneEquipe['MAIL'];
                    $j += 1;                    
                }
                else 
                {
                    $reussite += 1;
                }
                $i += 1 ;
            endforeach;
                $Données =  array
                (
                    "Reussite" => $reussite,
                    "TotalEnvois" => $i,
                //    "MailsErro" => $Mails
                );
                //var_dump($Données);
                $this->load->view('templates/Entete');
                $this->load->view('AdminInscription/MailingReussi',$Données); 
                $this->load->view('templates/PiedDePage');  
            
            
        }

        else
        {
            //$DonneesInjectees['Equipes'] = $this->ModelSInscrire->getImpayes();
            $DonneesInjectees['Equipes'] = $this->ModelImpayes->getImpayes();
            //$DonneesInjectees['Equipes'] = $this->ModelImpayes->getImpayes("-1");
            
            $this->load->library('table');

            $this->load->helper('form');
            //$this->load->library('form_validation');
            $i = 0;
            foreach($DonneesInjectees['Equipes'] as $uneEquipe):
                $Somme = $this->ModelImpayes->getSommeDueParEquipe($uneEquipe['NOEQUIPE']);
                //$Somme =  $this->ModelMembreDe->getSommeDueParEquipe($uneEquipe['NOEQUIPE']); 
                $DonneesInjectees['Somme'][$i]=array($uneEquipe['NOEQUIPE'],$Somme);
                $i += 1;
            endforeach;
            //var_dump($DonneesInjectees['Somme']);
            //var_dump($DonneesInjectees); //la somme de toutes les données précédentes. 
            $this->load->view('templates/Entete');
            $this->load->view('AdminInscription/RelanceImpayes',$DonneesInjectees); 
            $this->load->view('templates/PiedDePage');
        }
    }

    public function MiseAJourImpayes($noEquipe) 
    {
        if($this->input->post('submit'))
        {
            $Equipe = $this->ModelImpayes->getEquipe($noEquipe);

            $Montant = $this->input->post('MontantPaye');
            $ModePaiement = $this->input->post('ModePaiement');
                
            if($Equipe[0]['MONTANTPAYE']<=$Montant)
            {
                $Donnees = array
                (
                    "MONTANTPAYE"=>$Montant,
                    "MODEREGLEMENT"=>$ModePaiement,
                );
                $this->ModelImpayes->updateEquipe($noEquipe,$Donnees);
                $this->load->view('templates/Entete');
                $this->load->view('AdminInscription/MiseAJourImpayesReussi'); 
                $this->load->view('templates/PiedDePage'); 
            }
            else 
            {
                //Chargement de view d'erreur ^^ 
                //ou alors demande de confirmation de la baisse de la somme versée

                echo"<H1>ERROR</H1>";
            }
            
            
        
        }
        else
        {
            //echo $DonnéesEnvoyées;
            //$noEquipe = $DonnéesEnvoyées;
            $Equipe = $this->ModelImpayes->getEquipe($noEquipe);
            $SommeDue = $this->ModelImpayes->getSommeDueParEquipe($noEquipe);
        //var_dump($Equipe);
        
            $Données = array
            (
                "Equipe" => $Equipe,
                "SommeDue" => $SommeDue,
            );
        
            $this->load->library('table');
            $this->load->helper('form');

            $this->load->view('templates/Entete');
            $this->load->view('AdminInscription/MiseAJourImpayes',$Données); 
            $this->load->view('templates/PiedDePage'); 
        }
        

    }

    public function MailingPromo()
    {
        if($this->input->post('submit'))
        {
            $Mails = $this->ModelMailingPromo->getAnciensParticipants();
            $Message = $this->input->post('mail');
            var_dump($Mails);
            foreach($Mails as $Mail):

                $this->email->from('mailing.randotroll@gmail.com');
                $this->email->to($Mail['mail']); 
                $this->email->subject('Venez nombreux vous inscrire à notre nouvelle session');
                $this->email->message($Message);

                if (!$this->email->send())
                {
                    $this->email->print_debugger();
                    echo "Error";
                }
            endforeach;//Envoie du mail aux contactes
            
        }
        else 
        {
        
        $this->load->helper('form');
        $this->load->view('templates/Entete');
        $this->load->view('AdminInscription/MailingPromo');
        $this->load->view('templates/PiedDePage');

        }
        
    }

}

/*
SELECT distinct(mail), r.noparticipant
FROM membrede m, randonneur r
WHERE m.noparticipant=r.noparticipant AND noEquipe NOT In(
    
    SELECT noEquipe From Membrede Where Annee = 2018)

Union (
    
    	SELECT distinct(mail), r.noparticipant 
		FROM membrede m, responsable r
		WHERE m.noparticipant=r.noparticipant AND noEquipe NOT In(
    
    		SELECT noEquipe From Membrede Where Annee = 2018)
    
    	)

*/

?>
</html>