<h2><?php echo 'Bénévole de tel commission' ?></h2>


<?php
$BenevolesRataches = array();
$I = 0;
foreach ($lesBenevoles as $unBénévole):
     $array = array('nocommission' => $NoCommission, 'nocontributeur' => $unBénévole['NOCONTRIBUTEUR']);
     $str = $this->uri->assoc_to_uri($array);

     $this->table->add_row('<h3>'.$unBénévole['NOM'].' '.$unBénévole['PRENOM'].'</h3>', ' &nbsp;&nbsp <a href="http://127.0.0.1/randotroll_perso/index.php/SuperAdmin/detacherBenevole/'.$NoCommission.'/'.$unBénévole['NOCONTRIBUTEUR'].'" class="btn btn-default" role="button">Détacher</a>');
     $BenevolesRataches[$I] = $unBénévole['NOCONTRIBUTEUR'];
     $I++;
endforeach;
$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="2" cellspacing="1" class="mytable">' );
$this->table->set_template($tmpl);

echo $this->table->generate();
$this->session->BenevolesIndispo = $BenevolesRataches ;
echo '<h3>'.anchor('SuperAdmin/ajoutBenevoleCommission/'.$NoCommission,"Ajout d'un bénévole à cette commission").'</h3>';