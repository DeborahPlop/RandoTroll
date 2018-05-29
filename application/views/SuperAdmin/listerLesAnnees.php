<h2><?php echo 'Les éditions randotrolls' ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesArticles : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->
<?php foreach ($lesAnnees as $uneAnnee):
     echo '<h3>'.anchor('SuperAdmin/voirUneAnnee/'.$uneAnnee['ANNEE'],'Randotroll '.$uneAnnee['ANNEE']).'</h3>';
endforeach;
echo '<p>'.anchor('SuperAdmin/ajouterUneAnnee','Ajouter une année').'</p>';
?>
<p>Pour afficher les détails cliquez sur l'année</p>