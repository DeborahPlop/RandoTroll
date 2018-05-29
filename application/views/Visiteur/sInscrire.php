<html>
<body>
<h2><?php echo ('Inscription') ?></h2>
<?php

echo validation_errors(); // mise en place de la validation

/* set_value : en cas de non validation les données déjà
saisies sont réinjectées dans le formulaire */
echo form_open('visiteur/sInscrire');

echo ('<table class="table-responsive">');

echo('<tr><td>');
echo form_label('Nom: ','nom');

echo('</td><td>');

echo form_input('nom',$nom,array('required'=>'required')); 

echo('</td></tr>');

echo('<tr><td>');
echo form_label('Prénom: ','prenom');

echo('</td><td>');

echo form_input('prenom',$prenom,array('required'=>'required')); 

echo('</td></tr>');
echo('<tr><td>');

echo form_label('Date de Naisance: ','datenaiss');
echo('</td><td>');
echo form_input('datenaiss',$datenaiss,array('required'=>'required')); 
echo('</td></tr>');

echo('<tr><td>');
echo form_label('Sexe : ','sexe');
echo('</td><td>');
echo form_dropdown('sexe', array('F'=>'Femme','M'=>'Homme','A'=>'Non Binaire'), 'default');
echo('</td></tr>');

//
  //  <tr align="center">
//<td>Sexe: </td>
//<td><select name="Sexe">
//<option value="F">Femme</option>
//<option value="M">Homme</option><
//<option value="A">Non Binaire</option>
//</select></td>
//</tr>
//
echo '<tr></tr>' ;

echo ('</br>');
echo('<tr><td>');
echo form_label('Nom de l\'équipe: ','nomequipe'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_input('nomequipe',$nomequipe,array('required'=>'required')); // VERIF a faire sur la nouveauté du nom de l'équipe
echo('</td></tr>');

echo('<tr><td>');
echo form_label('Email d\'identification: ','mail'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_input('mail',$mail,array('required'=>'required'));
echo('</td></tr>');

echo('<tr><td>');
echo form_label('Téléphone du responsable: ','tel'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_input('tel',$tel,array('required'=>'required'));
echo('</td></tr>');

echo('<tr><td>');
echo form_label('Mot de Passe: ','mdp'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_password('mdp','',array('required'=>'required')).$message;
echo('</td></tr>');

echo('<tr><td>');
echo form_label('Confirmation du mot de passe: ','confmdp'); // creation d'un label devant la zone de saisie
echo('</td><td>');
echo form_password('confmdp','',array('required'=>'required'));// VERIF si confirme == mdp
echo('</td></tr>');
echo('</table>');
echo ('</br></br>');

echo form_submit('valider', 'Valider l\'inscription');

//echo form_submit('retour', 'Retour');
echo form_close();
?>


</body>
<html>