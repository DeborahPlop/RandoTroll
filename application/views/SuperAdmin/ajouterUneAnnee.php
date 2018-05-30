<?php
echo '<h2>'."Ajout d'une course".'</h2>';
// Nota Bene : img_url($uneAnnee['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)

echo form_open('SuperAdmin/ajouterUneAnnee');

echo "Année : ".form_input('txtANNEE', set_value('ValueANNEE'))."<br>";
echo "Date de la course : ".form_input('txtDATECOURSE', set_value('ValueDATECOURSE'))."<br>";
echo "Date de cloture : ".form_input('txtDATECLOTUREINSCRIPTION', set_value('ValueDATECLOTUREINSCRIPTION'))."<br>";
echo "Limite d'âge : ".form_input('txtLIMITEAGE', set_value('ValueLIMITEAGE'))."<br>";
echo "Frais d'inscription adulte : ".form_input('txtTARIFINSCRIPTIONADULTE', set_value('ValueTARIFINSCRIPTIONADULTE'))."<br>";
echo "Tarif repas adulte : ".form_input('txtTARIFREPASADULTE', set_value('ValueTARIFREPASADULTE'))."<br>";
echo "Frais d'inscription enfant : ".form_input('txtTARIFINSCRIPTIONENFANT', set_value('ValueTARIFINSCRIPTIONENFANT'))."<br>";
echo "Tarif repas enfant : ".form_input('txtTARIFREPASENFANT', set_value('ValueTARIFREPASENFANT'))."<br>";
echo "Maximum de participants : ".form_input('txtMAXPARTICIPANTS', set_value('ValueMAXPARTICIPANTS'))."<br>";
echo "Maximum par équipe : ".form_input('txtMAXPAREQUIPE', set_value('ValueMAXPAREQUIPE'))."<br>";
echo "Mail d'organisation : ".form_input('txtMAILORGANISATION', set_value('ValueMAILORGANISATION'))."<br>";
echo "Chemin PDF du livret : ".form_input('txtCHEMINPDFLIVRET', set_value('ValueCHEMINPDFLIVRET'))."<br>";
echo "Chemin de l'image d'affichage : ".form_input('txtCHEMINIMAGEAFFICHE', set_value('ValueCHEMINIMAGEAFFICHE'))."<br>";
echo "Chemin image affichette : ".form_input('txtCHEMINIMAGEAFFICHETTE', set_value('ValueCHEMINIMAGEAFFICHETTE'))."<br><br>";

echo form_submit('btnAjouter', 'Ajouter');

echo form_close();

echo '<p>'.anchor('SuperAdmin/listerLesAnnees','Afficher les autres éditions randotrolls').'</p>';
?>