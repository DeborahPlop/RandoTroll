<?php 
echo '<H1> Envoie de mails promotionnels </H1>';
echo form_open('AdminInscription/MailingPromo');
echo form_textarea('mail', '',array('required'=>'required','class'=>"form-control"))."<BR>";
echo form_submit('submit', 'Envoyer')."<BR>";
    

?>