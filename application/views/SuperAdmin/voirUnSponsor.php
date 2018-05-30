<?php
echo '<h2>'.$unSponsor['NOM'].'</h2>';
// Nota Bene : img_url($unSponsor['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)

echo form_open('SuperAdmin/voirUnSponsor');

echo "Nom : ".form_input('txtNom', $unSponsor['NOM'], set_value('ValueNom'))."<br>";
echo "Adresse : ".form_input('txtAdresse', $unSponsor['ADRESSE'], set_value('ValueAdresse'))."<br>";
echo "Code postale : ".form_input('txtCodePostale', $unSponsor['CODEPOSTAL'], set_value('ValueCodePostale'))."<br>";
echo "Ville : ".form_input('txtVille', $unSponsor['VILLE'], set_value('ValueVille'))."<br>";
echo "Telephone fixe : ".form_input('txtTELFIXE', $unSponsor['TELFIXE'], set_value('ValueTELFIXE'))."<br>";
echo "Telephone portable : ".form_input('txtTELPORTABLECONTACT', $unSponsor['TELPORTABLECONTACT'], set_value('ValueTELPORTABLECONTACT'))."<br>";
echo "Email : ".form_input('txtMAILCONTACT', $unSponsor['MAILCONTACT'], set_value('ValueMAILCONTACT'))."<br><br>";

$this->session->ID ;
$this->session->ID = $unSponsor['NOSPONSOR'];
echo $this->session->item;

$var = $unSponsor['NOSPONSOR'];

echo form_submit('btnModifier', 'Modifier');

echo form_close();

echo '<p>'.anchor('SuperAdmin/listerLesSponsors','Retour à la liste des Sponsors').'</p>';
?>