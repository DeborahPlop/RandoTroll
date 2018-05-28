<html>
<body>
<?php 
 echo '<div class="container-fluid"><section class="section-inner">';
 //echo '<div class="table-responsive">';
 echo form_open('Gestionnaire/participants');
 // echo le nom de l'équipe
 $this->table->set_heading('Nom','Prénom', 'Date de Naissance', 'Sexe', 'Téléphone', 'Mail', 'Repas');  
 $i = 0;
 //var_dump($Equipes);
 foreach ($Equipes as $uneEquipe):
     //echo form_open('AdminInscription/MiseAJourImpayes');
     $this->table->add_row($uneEquipe['nom'],$uneEquipe['prenom'],$uneEquipe['datedenaissance']." ".$uneEquipe['sexe'],$uneEquipe['TELPORTABLE'],$uneEquipe['MAIL'],$uneEquipe['repassurplace'],'class="btn btn-default" > Modifier </a>'); 
     $i += 1 ;

    // echo '<a href="http://localhost/Randotroll/index.php/AdminInscription//MiseAJourImpayes/'.($numEquipe).'"> coucou </a>';
     
     //echo form_close();  
     endforeach  ;
 $Style = array('table_open' => '<table class="table table-hover" >');
 $this->table->set_template($Style);
 
 echo $this->table->generate();

 echo form_close();
 echo '</section></div>';



?>

</body>
<html>