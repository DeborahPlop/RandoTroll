<?php
echo '<h2>'.'Randotroll '.$uneAnnee['ANNEE'].'</h2>';
// Nota Bene : img_url($uneAnnee['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)

if ($uneAnnee['DATECOURSE'] >= date('Y'))
{
echo form_open('SuperAdmin/voirUneAnnee');

echo "Date de la course : ".form_input('txtDATECOURSE', $uneAnnee['DATECOURSE'], set_value('ValueDATECOURSE'))."<br>";
echo "Date de cloture : ".form_input('txtDATECLOTUREINSCRIPTION', $uneAnnee['DATECLOTUREINSCRIPTION'], set_value('ValueDATECLOTUREINSCRIPTION'))."<br>";
echo "Limite d'âge : ".form_input('txtLIMITEAGE', $uneAnnee['LIMITEAGE'], set_value('ValueLIMITEAGE'))."<br>";
echo "Frais d'inscription adulte : ".form_input('txtTARIFINSCRIPTIONADULTE', $uneAnnee['TARIFINSCRIPTIONADULTE'], set_value('ValueTARIFINSCRIPTIONADULTE'))."<br>";
echo "Tarif repas adulte : ".form_input('txtTARIFREPASADULTE', $uneAnnee['TARIFREPASADULTE'], set_value('ValueTARIFREPASADULTE'))."<br>";
echo "Frais d'inscription enfant : ".form_input('txtTARIFINSCRIPTIONENFANT', $uneAnnee['TARIFINSCRIPTIONENFANT'], set_value('ValueTARIFINSCRIPTIONENFANT'))."<br>";
echo "Tarif repas enfant : ".form_input('txtTARIFREPASENFANT', $uneAnnee['TARIFREPASENFANT'], set_value('ValueTARIFREPASENFANT'))."<br>";
echo "Maximum de participants : ".form_input('txtMAXPARTICIPANTS', $uneAnnee['MAXPARTICIPANTS'], set_value('ValueMAXPARTICIPANTS'))."<br>";
echo "Maximum par équipe : ".form_input('txtMAXPAREQUIPE', $uneAnnee['MAXPAREQUIPE'], set_value('ValueMAXPAREQUIPE'))."<br>";
echo "Mail d'organisation : ".form_input('txtMAILORGANISATION', $uneAnnee['MAILORGANISATION'], set_value('ValueMAILORGANISATION'))."<br>";
echo "Chemin PDF du livret : ".form_input('txtCHEMINPDFLIVRET', $uneAnnee['CHEMINPDFLIVRET'], set_value('ValueCHEMINPDFLIVRET'))."<br>";
echo "Chemin de l'image d'affichage : ".form_input('txtCHEMINIMAGEAFFICHE', $uneAnnee['CHEMINIMAGEAFFICHE'], set_value('ValueCHEMINIMAGEAFFICHE'))."<br>";
echo "Chemin image affichette : ".form_input('txtCHEMINIMAGEAFFICHETTE', $uneAnnee['CHEMINIMAGEAFFICHETTE'], set_value('ValueCHEMINIMAGEAFFICHETTE'))."<br>";

$this->session->ID ;
$this->session->ID = $uneAnnee['ANNEE'];
echo $this->session->item;

$var = $uneAnnee['ANNEE'];

echo form_submit('btnModifier', 'Modifier');

echo form_close();

}
else
{
echo "Date de la course : ".$uneAnnee['DATECOURSE']."<br>";
echo "Date de cloture : ".$uneAnnee['DATECLOTUREINSCRIPTION']."<br>";
echo "Limite d'âge : ".$uneAnnee['LIMITEAGE']."<br>";
echo "Frais d'inscription adulte : ".$uneAnnee['TARIFINSCRIPTIONADULTE']."<br>";
echo "Tarif repas adulte : ".$uneAnnee['TARIFREPASADULTE']."<br>";
echo "Frais d'inscription enfant : ".$uneAnnee['TARIFINSCRIPTIONENFANT']."<br>";
echo "Tarif repas enfant : ".$uneAnnee['TARIFREPASENFANT']."<br>";
echo "Maximum de participants : ".$uneAnnee['MAXPARTICIPANTS']."<br>";
echo "Maximum par équipe : ".$uneAnnee['MAXPAREQUIPE']."<br>";
echo "Mail d'organisation : ".$uneAnnee['MAILORGANISATION']."<br>";
echo "Chemin PDF du livret : ".$uneAnnee['CHEMINPDFLIVRET']."<br>";
echo "Chemin de l'image d'affichage : ".$uneAnnee['CHEMINIMAGEAFFICHE']."<br>";
echo "Chemin image affichette : ".$uneAnnee['CHEMINIMAGEAFFICHETTE']."<br>";
}

echo '<p>'.anchor('SuperAdmin/listerLesAnnees','Afficher les autres éditions randotrolls').'</p>';
?>