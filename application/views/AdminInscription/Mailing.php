<BR>
<div class="row">
<div class="col-sm-2">
</div>
<div class="col-sm-8">
<section >
<div class = "section-inner" style="background-color:#00021A;padding:20px">

<?php 
echo $titre;
echo form_open('AdminInscription/'.$lien);
echo form_textarea('mail', '',array('required'=>'required','class'=>"form-control"))."<BR>";
echo form_submit('submit', 'Envoyer')."<BR>";

?>
</div>
<section>
</div>
</div>