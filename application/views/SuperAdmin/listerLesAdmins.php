<h2><?php echo 'Les administrateurs' ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesArticles : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->
<?php foreach ($lesAdmins as $unAdmin):
     echo '<h3>'.($unAdmin['NOM'].' '.$unAdmin['PRENOM']).'</h3>';
endforeach;

echo form_open('SuperAdmin/listerLesContributeurs');

//form_checkbox();
//echo form_radio('newsletter', 'accept', TRUE);

echo form_close();

echo '<h3>'.anchor('SuperAdmin/ChoisirNouvelAdmin', 'Ajouter un admin');

?>