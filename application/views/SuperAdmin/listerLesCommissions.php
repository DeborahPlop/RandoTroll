<h2><?php echo $TitreDeLaPage ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesArticles : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->
<?php foreach ($lesCommissions as $uneCommission):
     echo '<h3>'.anchor('SuperAdmin/gererUneCommission/'.$uneCommission['NOCOMMISSION'], $uneCommission['LIBELLE']).'</h3>';
endforeach;
?>
<p>Pour gérer les bénévoles liés aux comissions cliquer sur la commission</p>