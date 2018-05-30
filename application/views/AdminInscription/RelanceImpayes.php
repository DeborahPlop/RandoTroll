<div class="row">  

<div class="col-sm-12">
<section >
<div class = "section-inner" style="background-color:#00021A;padding:20px">

<?php 
    echo '<H1 align = "center" style="color:#EAF815"> Gestions des Impayés </H1>';

    echo'<div class="table-responsive">';
    //echo '<div class="table-responsive">';
    echo form_open('AdminInscription/MiseAJourImpayes');
    $this->table->set_heading('Num','Nom Equipe', 'Nom Responsable', 'Portable', 'Mail', 'Montant du', 'Restant à Payer','Mode règlement','');  
    $i = 0;
    //var_dump($Equipes);
    foreach ($Equipes as $uneEquipe):
        //echo form_open('AdminInscription/MiseAJourImpayes');

        $A_Payer = $Somme[$i][1] - $uneEquipe['MONTANTPAYE'];
        $Format_APayer = number_format($A_Payer, 2);
        $Format_Du = number_format($Somme[$i][1], 2);
        $numEquipe =$uneEquipe['NOEQUIPE'];
        $this->table->add_row($numEquipe,$uneEquipe['NOMEQUIPE'],$uneEquipe['PRENOM']." ".$uneEquipe['NOM'],$uneEquipe['TELPORTABLE'],$uneEquipe['MAIL'],$Format_Du." €",$Format_APayer." €",$uneEquipe['MODEREGLEMENT'],'<a href="http://localhost/Randotroll/index.php/AdminInscription//MiseAJourImpayes/'.($numEquipe).'" class="btn btn-default" > Modifier </a>'); 
        $i += 1 ;

       // echo '<a href="http://localhost/Randotroll/index.php/AdminInscription//MiseAJourImpayes/'.($numEquipe).'"> coucou </a>';
        
        //echo form_close();  
        endforeach  ;
    $Style = array('table_open' => '<table class="table" style="color:#CBCBCB">');
    $this->table->set_template($Style);
    
    echo $this->table->generate();
   
    echo form_close();
    echo'</div>';

    //Couleur de text
    //#CBCBCB
?>

</div>
<section>
</div>
</div>
<BR>