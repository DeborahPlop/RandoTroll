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
       $this->load->model('ModelSInscrire'); // chargement modèle, obligatoire
       //$this->load->model('');
    }

    public function RelanceImpayes()
    {
        $DonneesInjectees['Equipes'] = $this->ModelSInscrire->retournerImpayes();
        var_dump($DonneesInjectees);
        $this->load->library('table');
        $this->load->helper('form');
        $this->CalculDuDu($DonneesInjectees);
        $this->load->view('templates/Entete');
        $this->load->view('AdminInscription\RelanceImpayes.php',$DonneesInjectees); 
        $this->load->view('templates/PiedDePage');
    }

    public function Envoyer()
    {
        //Envoie du formulaire => mail

    }
    
    public function CalculDuDu($Equipes)
    {
        foreach ($Equipes as $uneEquipe):
        $DonneesInjectees['Membres'] = $this->ModelMembreDe->retournerMembres($uneEquipe['NOEQUIPE']);
        endforeach  ;
        var_dump($DonneesInjectees);
    }
    
    public function CalculAge($dateNaissance)
    {

    }
}

?>
</html>