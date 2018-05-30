<html>
<head>
<title>Randotroll</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div style="background-color:black">
<?php 
echo '
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="'.site_url('Visiteur/loadAccueil').'">RandoTroll</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="'.site_url('Visiteur/loadAccueil').'">Accueil</a></li>
            <li><a href="'.site_url('AdminInscription/RelanceImpayes').'">Gestion Impayes</a></li>
            <li><a href="'.site_url('AdminInscription/MailingPromo').'">Mailing promotionnel</a></li>
            <li><a href="'.site_url('AdminInscription/AffectationVague').'">Affectation à une vague</a></li>
            <li><a href="'.site_url('AdminInscription/Remboursement').'">Gestion Rembousements</a></li>
            <li><a href="'.site_url('Visiteur/seConnecter').'">Connexion</a></li>
            <li><a href="'.site_url('Visiteur/sInscrire').'">Inscription</a></li>
            <li><a href="'.site_url('Visiteur/seDeconnecter').'">Deconnexion</a></li>
            </ul>
    </div>
</nav>'

//Remboursement
?>

