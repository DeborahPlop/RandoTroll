<html>
<?php 

Class RelanceMail extends CI_Controller 
{
    public function AfficherTableau()
    {
       $this->load->view('AdminInscription\RelanceMail.php'); 

    }

    public function Envoyer()
    {
        //Envoie du formulaire => mail

    }
}

?>
</html>