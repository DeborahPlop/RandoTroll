<?php
echo '<h2>'.$unContributeur['NOM'].'</h2>';
// Nota Bene : img_url($unContributeur['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)

echo form_open('SuperAdmin/voirUnContributeur');

echo "Nom : ".form_input('txtNOM', $unContributeur['NOM'], set_value('ValueNOM'))."<br>";
echo "Prenom : ".form_input('txtPRENOM', $unContributeur['PRENOM'], set_value('ValuePRENOM'))."<br>";
echo "Adresse : ".form_input('txtADRESSE', $unContributeur['ADRESSE'], set_value('ValueADRESSE'))."<br>";
echo "Code postale : ".form_input('txtCODEPOSTAL', $unContributeur['CODEPOSTAL'], set_value('ValueCODEPOSTAL'))."<br>";
echo "Ville : ".form_input('txtVILLE', $unContributeur['VILLE'], set_value('ValueVILLE'))."<br>";
echo "Telephone fixe : ".form_input('txtTELFIXE', $unContributeur['TELFIXE'], set_value('ValueTELFIXE'))."<br>";
echo "Telephone portable : ".form_input('txtTELPORTABLE', $unContributeur['TELPORTABLE'], set_value('ValueTELPORTABLE'))."<br>";
echo "Email : ".form_input('txtEMAIL', $unContributeur['EMAIL'], set_value('ValueEMAIL'))."<br><br>";

$this->session->ID ;
$this->session->ID = $unContributeur['NOCONTRIBUTEUR'];
echo $this->session->item;

echo form_submit('btnModifier', 'Modifier');

echo form_close();

echo '<p>'.anchor('SuperAdmin/listerLesContributeurs','Retour à la liste des Contributeurs').'</p>';
?>