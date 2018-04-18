   
<?php 
    echo form_open('AdminInscription/RelanceImpayes');
    //$this->load->library('table');
    $this->table->set_heading('Nom Equipe', 'Nom Responsable', 'Portable', 'Mail', 'Paye', 'Du', 'A Payer','Mode règlement');  
    foreach ($Equipes as $uneEquipe):
        $this->table->add_row($uneEquipe['NOMEQUIPE'],$uneEquipe['PRENOM']." ".$uneEquipe['NOM'],$uneEquipe['TELPORTABLE'],$uneEquipe['MAIL'],$uneEquipe['MONTANTPAYE']);
    endforeach  ;
    $Style = array('table_open' => '<table border = "1" cellpadding ="2" cellspacing="1" class="mytable">');
    $this->table->set_template($Style);

    echo $this->table->generate();
    
?>
<p>Petit test d'affichage...<p>
