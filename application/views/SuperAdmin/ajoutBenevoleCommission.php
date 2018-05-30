<h2><?php echo 'Bénévole à ajouter' ?></h2>

<?php
$I = 0;
echo form_open('SuperAdmin/ajoutBenevoleCommission/'.$NoCommission);
$this->table->set_heading('Nom', 'Prenom');
 foreach ($lesBenevoles as $unBénévole):
    $this->table->add_row(form_checkbox($I, $unBénévole['NOCONTRIBUTEUR'], FALSE),'<h3>'.$unBénévole['NOM'].' '.$unBénévole['PRENOM'].'</h3>');
     $I++;
endforeach;

$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="2" cellspacing="1" class="mytable">' );
$this->table->set_template($tmpl);

echo $this->table->generate();

$this->session->NBBenevoleARatacher = $I;

echo form_submit('btnAjouter', 'Ratacher');
echo form_close();