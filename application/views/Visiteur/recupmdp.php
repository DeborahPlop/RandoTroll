<html>
<?php echo ("Récupération du Mot de Passe") ?>
<body>
<?php
echo'<br>';
echo form_open('visiteur/recupmdp');
echo form_label('Mail: ','mail'); // creation d'un label devant la zone de saisie
echo form_input('mail','',array('required'=>'required'));

echo ("Par email :");
echo form_submit('recupmail', 'Envoyer');
echo'<br>';
echo("Par SMS : ");
echo form_submit('sms', 'Envoyer');
echo '<a href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
echo form_close();
?>
</body>
<html>