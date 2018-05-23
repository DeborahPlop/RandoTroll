<html>
<body>
<h2><?php echo ('Inscription') ?></h2>
<?php

echo validation_errors(); // mise en place de la validation

/* set_value : en cas de non validation les données déjà
saisies sont réinjectées dans le formulaire */
echo form_open('visiteur/sInscrire');

echo form_label('Nom de l\'équipe:</br> ','nomequipe'); // creation d'un label devant la zone de saisie
echo form_input('nomequipe','',array('required'=>'required')); // VERIF a faire sur la nouveauté du nom de l'équipe

echo form_label('</br>Email d\'identification:</br> ','mail'); // creation d'un label devant la zone de saisie
echo form_input('mail','',array('required'=>'required'));

echo form_label('</br>Téléphone du responsable: </br>','tel'); // creation d'un label devant la zone de saisie
echo form_input('tel','',array('required'=>'required'));

echo form_label('</br>Mot de Passe:</br> ','mdp'); // creation d'un label devant la zone de saisie
echo form_password('mdp','',array('required'=>'required'));

echo form_label('</br>Confirmation du mot de passe:</br> ','confmdp'); // creation d'un label devant la zone de saisie
echo form_password('confmdp','',array('required'=>'required'));// VERIF si confirme == mdp

echo form_submit('submit', 'Valider l\'inscription');

//echo form_submit('retour', 'Retour');
echo form_close();
?>
</body>
<html>