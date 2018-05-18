<html>
<body>
<h2><?php echo ('Gestion du compte') ?></h2>
<?php

echo validation_errors(); // mise en place de la validation

/* set_value : en cas de non validation les données déjà
saisies sont réinjectées dans le formulaire */
echo form_open('visiteur/gestion_compte');

echo form_label('Ancien Mot de Passe:</br> ','mdp'); // creation d'un label devant la zone de saisie
echo form_input('mdp','',array('required'=>'required')); // VERIF a faire sur la nouveauté du nom de l'équipe

echo form_label('</br>Nouveau Mot de Passe:</br> ','newmdp'); // creation d'un label devant la zone de saisie
echo form_input('newmdp','',array('required'=>'required'));

echo form_label('</br>Confirmation du Mot de Passe: </br>','confmdp'); // creation d'un label devant la zone de saisie
echo form_input('confmdp','',array('required'=>'required'));

echo form_label('</br>Ancien Téléphone:</br> ','tel'); // creation d'un label devant la zone de saisie
echo form_password('tel','',array('required'=>'required'));

echo form_label('</br>Nouveau téléphone:</br> ','newtel'); // creation d'un label devant la zone de saisie
echo form_password('newtel','',array('required'=>'required'));// VERIF si confirme == mdp

echo form_submit('submit', 'OK');

echo form_close();
?>
</body>
<html>