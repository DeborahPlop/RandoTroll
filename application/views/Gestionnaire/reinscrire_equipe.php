<html>
<body>
<?php 
echo ('Confirmer que vous êtes le responsable');
echo validation_errors(); // mise en place de la validation

/* set_value : en cas de non validation les données déjà
saisies sont réinjectées dans le formulaire */
echo form_open('gestionnaire/reinscrire_equipe');

echo form_label('Email:</br> ','mail'); // creation d'un label devant la zone de saisie
echo form_input('mail','',array('required'=>'required')); // verif que l'email soit bon7

echo form_submit('submit', 'Connexion');

echo ('Afficher l equipe en question');
?>
</body>
<html>