<html>
<body>
<h2><?php echo ('Gestion du compte') ?></h2>
<?php

echo validation_errors(); // mise en place de la validation

/* set_value : en cas de non validation les données déjà
saisies sont réinjectées dans le formulaire */
echo form_open('Gestionnaire/gestion_compte');
echo ('<table class="table-responsive">');
echo('<tr><td>');
echo form_label('Ancien Mot de Passe:</br> ','mdp'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_password('mdp',''); // VERIF a faire sur la nouveauté du nom de l'équipe
echo('</td></tr>');

echo('<tr><td>');
echo form_label('</br>Nouveau Mot de Passe:</br> ','newmdp'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_password('newmdp','');
echo('</td></tr>');

echo('<tr><td>');
echo form_label('</br>Confirmation du Mot de Passe: </br>','confmdp'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_password('confmdp','');
echo('</td></tr>');

echo('<tr><td>');
echo form_label('</br>Ancien Téléphone:</br> ','tel'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_input('tel','');
echo('</td></tr>');

echo('<tr><td>');
echo form_label('</br>Nouveau téléphone:</br> ','newtel'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_input('newtel','');// VERIF si confirme == mdp
echo('</td></tr>');
echo('</table>');
echo form_submit('ok', 'OK');

echo form_close();
?>
</body>
<html>