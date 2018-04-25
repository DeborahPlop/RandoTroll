   
<?php 
    echo form_open('AdminInscription/RelanceImpayes');
    //$this->load->library('table');
    $this->table->set_heading('Nom Equipe', 'Nom Responsable', 'Portable', 'Mail', 'Montant du', 'Restant à Payer','Mode règlement');  
    $i = 0;
    echo form_open('AdminInscription/RelanceImpayes');
    
    echo form_textarea('mail', '',array('required'=>'required'))."<BR><BR>";


    foreach ($Equipes as $uneEquipe):
        $A_Payer = $Somme[$i][1] - $uneEquipe['MONTANTPAYE'];
        $Format_APayer = number_format($A_Payer, 2);
        $Format_Du = number_format($Somme[$i][1], 2);
 
        $this->table->add_row($uneEquipe['NOMEQUIPE'],$uneEquipe['PRENOM']." ".$uneEquipe['NOM'],$uneEquipe['TELPORTABLE'],$uneEquipe['MAIL'],$Format_Du." €",$Format_APayer." €",$uneEquipe['MODEREGLEMENT']);
        $i += 1 ;
        endforeach  ;
    $Style = array('table_open' => '<table border = "1" cellpadding ="2" cellspacing="1" class="mytable">');
    $this->table->set_template($Style);

    echo $this->table->generate();
    echo "<BR>".form_submit('submit', 'Envoyer');
    
    echo form_close();
?>

