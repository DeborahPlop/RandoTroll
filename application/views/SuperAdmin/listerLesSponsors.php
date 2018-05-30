<h2><?php 
$TitreDeLaPage = "Les sponsors";
echo $TitreDeLaPage; ?></h2>
<!--
$TitreDeLaPage : variable récupérée depuis le contrôleur
$lesArticles : variable récupérée depuis le contrôleur (en 'mode tableau associatif')
 -->


<?php 

echo form_open('SuperAdmin/listerLesSponsors');


$this->table->set_heading('Nom', 'Adresse', 'Code postal', 'Ville', 'Téléphone fixe', 'Portable', 'Mail');

foreach ($lesSponsors as $unSponsor):
    $this->table->add_row((anchor('SuperAdmin/voirUnSponsor/'.$unSponsor['NOSPONSOR'],$unSponsor['NOM'])), $unSponsor['ADRESSE'], $unSponsor['CODEPOSTAL'], $unSponsor['VILLE'], $unSponsor['TELFIXE'], $unSponsor['TELPORTABLECONTACT'], $unSponsor['MAILCONTACT']);
endforeach ;
$this->table->add_row(form_input('txtNom', set_value('ValueNom')), form_input('txtAdresse', set_value('ValueAdresse')), form_input('txtCodePostale',
 set_value('ValueCodePostale')), form_input('txtVille', set_value('ValueVille')), form_input('txtTELFIXE', set_value('ValueTELFIXE')),
  form_input('txtTELPORTABLECONTACT', set_value('ValueTELPORTABLECONTACT')), form_input('txtMAILCONTACT', set_value('ValueMAILCONTACT')));


$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">' );
$this->table->set_template($tmpl);

echo $this->table->generate();
echo '<br>';
echo form_submit('btnAjouter', 'Ajouter');

echo form_close();


$js = array('onClick' => 'some_function();');
?>
<p>Pour modifier un Sponsor, cliquer le nom</p>