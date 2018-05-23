   
<?php 
    echo form_open('AdminInscription/RelanceImpayes');
    //$this->load->library('table');
    $this->table->set_heading('Num','Nom Equipe', 'Nom Responsable', 'Portable', 'Mail', 'Montant du', 'Restant à Payer','Mode règlement','');  
    $i = 0;
    echo form_open('AdminInscription/RelanceImpayes');
    
    echo form_textarea('mail', '',array('required'=>'required'))."<BR><BR>";

    echo "<BR>".form_submit('submit', 'Envoyer');
    
    echo form_close();

    echo form_open('AdminInscription/MiseAJourImpayes');
    //var_dump($Equipes);
    foreach ($Equipes as $uneEquipe):
        //echo form_open('AdminInscription/MiseAJourImpayes');

        $A_Payer = $Somme[$i][1] - $uneEquipe['MONTANTPAYE'];
        $Format_APayer = number_format($A_Payer, 2);
        $Format_Du = number_format($Somme[$i][1], 2);
        $numEquipe =$uneEquipe['NOEQUIPE'];
        $this->table->add_row($numEquipe,$uneEquipe['NOMEQUIPE'],$uneEquipe['PRENOM']." ".$uneEquipe['NOM'],$uneEquipe['TELPORTABLE'],$uneEquipe['MAIL'],$Format_Du." €",$Format_APayer." €",$uneEquipe['MODEREGLEMENT'],'<a href="http://localhost/Randotroll/index.php/AdminInscription//MiseAJourImpayes/'.($numEquipe).'" > Modifier </a>'); 
        $i += 1 ;

       // echo '<a href="http://localhost/Randotroll/index.php/AdminInscription//MiseAJourImpayes/'.($numEquipe).'"> coucou </a>';
        
        //echo form_close();  
        endforeach  ;
    $Style = array('table_open' => '<table border = "1" cellpadding ="2" cellspacing="1" >');
    $this->table->set_template($Style);

    echo $this->table->generate();
    
    echo form_close();
    
    
    
    
    
?>

