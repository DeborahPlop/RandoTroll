<html>
<h2><?php echo Accueil ?></h2>
<body>
<?php
echo validation_errors(); // mise en place de la validation
/* set_value : en cas de non validation les données déjà
saisies sont réinjectées dans le formulaire */
echo "dans se connecter"; 
echo form_open('visiteur/seConnecter');
echo form_label('Identifiant','txtIdentifiant'); // creation d'un label devant la zone de saisie
echo form_input('txtIdentifiant', array ('required'=>'required'));

echo form_label('Mot de passe','txtMotDePasse');
echo form_password('txtMotDePasse', array ('required'=>'required'));

echo form_submit('submit', 'Se connecter');
echo form_close();

?>
</body>
<html>