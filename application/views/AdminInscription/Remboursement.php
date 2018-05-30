<div class="row"> 
    <div class="col-sm-12">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#00021A;padding:20px">
                    <H1 align = "center" style="color:#EAF815"> Remboursements </H1>
                    <?php
                        echo form_open('AdminInscription/Remboursement'); 
                        $this->table->set_heading('Nom Equipe', 'Nom Responsable', 'Montant du', 'Montant Paye','Montant Rembourser','Mode règlement');
                        foreach($Equipes as $uneEquipe):
                            $Format_Du = number_format($uneEquipe['SommeAPayer'], 2);
                            $MontantPayé = number_format($uneEquipe['MONTANTPAYE']);
                            $this->table->add_row($uneEquipe['NOMEQUIPE'],$uneEquipe['NOM']." ".$uneEquipe['PRENOM'],$Format_Du,$MontantPayé,$uneEquipe['MONTANTREMBOURSE'],$uneEquipe['MODEREGLEMENT']);
                        
                            if(empty($Options))
                            {
                                $Options = array($uneEquipe['NOEQUIPE']=>$uneEquipe['NOMEQUIPE']);
                            }
                            else
                            {
                                $temp = array($uneEquipe['NOEQUIPE']=>$uneEquipe['NOMEQUIPE']);
                                $Options = $Options + $temp; 
                            }

                        endforeach;

                        $Style = array('table_open' => '<table class="table" style="color:#CBCBCB">');
                        $this->table->set_template($Style);
    
                        echo $this->table->generate();

                        echo 
                        form_dropdown('Equipes', $Options, 'default');
                        
                        echo 
                        form_input('Montant', '',array('required'=>'required','pattern'=>'[0-9]+(\.[0-9]+)','title'=>'format de prix. Ex : 15.50'));
                        echo form_submit('Remboursement', 'Mise à Jour');
                        echo form_close();
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>
         
