<html>
<?php 

Class AdminInscription extends CI_Controller 
{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper('url');
       $this->load->helper('assets'); // helper 'assets' ajouté a Application
       $this->load->library("pagination");
       $this->load->model('ModelSInscrire');
       $this->load->model('ModelMembreDe');
        // chargement modèle, obligatoire
       //$this->load->model('');
    }

    public function RelanceImpayes()
    {
        if($this->input->post('submit'))
        {
            //Mailing
            //echo('Coucou tu as réussi à faire un submit correcte');
            $DonneesInjectees['Equipes'] = $this->ModelSInscrire->retournerImpayes();
            var_dump($DonneesInjectees);
        }
        else
        {
            $DonneesInjectees['Equipes'] = $this->ModelSInscrire->retournerImpayes();
            
            $this->load->library('table');
            $this->load->helper('form');
            $i = 0;
            foreach( $DonneesInjectees['Equipes'] as $uneEquipe):
            $Somme =  $this->ModelMembreDe->sommeDueParEquipe($uneEquipe['NOEQUIPE']); 
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

    public function Envoyer()
    {
        //Envoie du formulaire => mail

    }
    
    public function CalculAge($dateNaissance)
    {

    }
}

?>
</html>