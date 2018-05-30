<?php
echo form_open('SuperAdmin/nouvelAdmin/'.$NOCONTRIBUTEUR);

echo "Mot de passe : ".form_input('txtMDP', set_value('ValueMDP'))."<br>";
$options = array(
    'AdminInscription'         => 'Administrateur inscription',
    'AdminOrganisation'           => 'Administrateur organisation',
    'SuperAdmin'         => 'Super administrateur',
);
echo 'Type administrateur : '.form_dropdown('typeAdmin', $options, 'SuperAdmin').'<br>';
echo form_submit('btnAjouter', 'Proumouvoir admin');

echo form_close();

$this->session->IDnouvelAdmin ;
$this->session->IDnouvelAdmin = $NOCONTRIBUTEUR;
echo $NOCONTRIBUTEUR;
?>