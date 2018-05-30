<html>
<body>
<?php 
 echo '<div class="container-fluid"><section class="section-inner">';
 //echo '<div class="table-responsive">';
 echo form_open('Gestionnaire/gestion_course');
 // echo le nom de l'équipe
 $this->table->set_heading('Nom','Prénom', 'Date de Naissance', 'Sexe','Mail','Tel', 'Repas','','');  
 $i = 0;
 echo '<a href="gestion_compte">Gestion du compte </a>';
var_dump($membres);
 foreach ($membres as $unMembre):

     //echo form_open('AdminInscription/MiseAJourImpayes');
     $this->table->add_row($unMembre['NOM'],$unMembre['PRENOM'],$unMembre['DATEDENAISSANCE'],$unMembre['SEXE'],$unMembre['MAIL'],$unMembre['TELPORTABLE'],$unMembre['REPASSURPLACE']); 
     $i += 1 ;

    // echo '<a href="http://localhost/Randotroll/index.php/AdminInscription//MiseAJourImpayes/'.($numEquipe).'"> coucou </a>';
     
     //echo form_close();  
     endforeach  ;
     $this->table->add_row(form_input('nom',''),form_input('prenom',''),form_input('datenaiss',''),form_dropdown('sexe', array('F'=>'Femme','M'=>'Homme','A'=>'Non Binaire'), 'default'),form_input('mail',''),form_input('tel',''),form_checkbox('repas',1, FALSE),form_submit('ajout', 'Ajouter'),form_submit('suppr', 'Supprimer'));
     
 $Style = array('table_open' => '<table class="table table-hover" >');
 $this->table->set_template($Style);

 echo $this->table->generate();

//  if ($reinscrire==1)
//  {
//     echo form_submit('Reinscrire', 'Réinscrire cette équipe');
//  }

 echo form_close();
 echo '</section></div>';



?>

</body>
<html>