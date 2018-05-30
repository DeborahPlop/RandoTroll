
<?php
echo form_open('SuperAdmin/envoiMailPerso');
$paramètres = array(
    'name' => 'tbxObjetMail',
    'placeholder' => 'Objet du mail'
);
echo '<br><br>'.form_input($paramètres).'<br><br>';

echo form_textarea('txtMail', '',array('required'=>'required','class'=>"form-control", 'placeholder' => 'Corps du mail'))."<BR>";
echo form_submit('btnEnvoyer', 'Envoyer')."<BR>";

?>
