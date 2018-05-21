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
      // $this->load->model('ModelSInscrire');
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
            $DonneesInjectees['Equipes'] = $this->ModelImpayes->retournerImpayes();
            //echo $Message;
            
            $DonnesUtiles = $this->ModelImpayes->AnneeEnCours();
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
                $Somme =  $this->ModelImpayes->sommeDueParEquipe($uneEquipe['NOEQUIPE']) - $uneEquipe['MONTANTPAYE'];
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
            //$DonneesInjectees['Equipes'] = $this->ModelSInscrire->retournerImpayes();
            $DonneesInjectees['Equipes'] = $this->ModelImpayes->retournerImpayes();
            //$DonneesInjectees['Equipes'] = $this->ModelImpayes->retournerImpayes("-1");
            
            $this->load->library('table');

            $this->load->helper('form');
            $this->load->library('form_validation');
            $i = 0;
            foreach($DonneesInjectees['Equipes'] as $uneEquipe):
                $Somme =  $this->ModelImpayes->sommeDueParEquipe($uneEquipe['NOEQUIPE']);
                //$Somme =  $this->ModelMembreDe->sommeDueParEquipe($uneEquipe['NOEQUIPE']); 
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

    public function MiseAJourImpayes() 
    {
       $EquipeAModifier = $this->input->post('submit');
        var_dump($EquipeAModifier);
        
    }

}

?>
</html>