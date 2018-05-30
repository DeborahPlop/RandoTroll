<h2><?php 
echo 'Tous les contributeurs'; ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesArticles : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->


<?php 

echo form_open('SuperAdmin/listerLesContributeurs');


$this->table->set_heading('Nom', 'Prenom', 'Adresse', 'Code postal', 'Ville', 'Téléphone fixe', 'Portable', 'Mail');

foreach ($lesContributeurs as $unContributeur):
    $this->table->add_row((anchor('SuperAdmin/voirUnContributeur/'.$unContributeur['NOCONTRIBUTEUR'],$unContributeur['NOM'])), $unContributeur['PRENOM'], $unContributeur['ADRESSE'], $unContributeur['CODEPOSTAL'], $unContributeur['VILLE'], $unContributeur['TELFIXE'], $unContributeur['TELPORTABLE'], $unContributeur['EMAIL']);
endforeach ;
$this->table->add_row(form_input('txtNOM', set_value('ValueNOM')), form_input('txtPRENOM', set_value('ValuePRENOM')),
 form_input('txtADRESSE', set_value('ValueADRESSE')), form_input('txtCODEPOSTAL', set_value('ValueCODEPOSTAL')),
  form_input('txtVILLE', set_value('ValueVILLE')), form_input('txtTELFIXE', set_value('ValueTELFIXE')), form_input('txtTELPORTABLE', set_value('ValueTELPORTABLE')),
   form_input('txtEMAIL', set_value('ValueEMAIL')), 'Bénévole'.form_checkbox('cbxBenevole', 'EstBenvole', FALSE),
    'Apporteur de sponsors'.form_checkbox('cbxApporteurDeSponsors', 'EstApporteurDeSponsors', FALSE));


$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">' );
$this->table->set_template($tmpl);

echo $this->table->generate();

/*
echo 'Benevole'.form_checkbox('cbxBenevole', 'EstBenvole', FALSE);
echo 'Apporteur de sponsors'.form_checkbox('cbxApporteurDeSponsors', 'EstApporteurDeSponsors', FALSE);
*/

echo '<br>';
echo form_submit('btnAjouter', 'Ajouter');

echo form_close();