<div class="row"> 
  
    <div class="col-sm-12">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#00021A;padding:20px">
                    <H1 align = "center" style="color:#EAF815"> Mise à jour des sommes versées </H1>
                    
                    <?php 
                        
                            // echo "<BR>equipe : ";
                            // var_dump($Equipe);
                            // echo "somme due : ";
                            // var_dump($SommeDue);
                            
                            //var_dump($DonneesInjectees['Equipe']);
                        $A_Payer = $SommeDue - $Equipe[0]['MONTANTPAYE'];
                        //echo $Equipe[0]['MONTANTPAYE'];
                        $Format_APayer = number_format($A_Payer, 2);
                        $Format_Du = number_format($SommeDue, 2);
                        $noEquipe =$Equipe[0]['NOEQUIPE'];
                        $this->table->set_heading('Num','Nom Equipe', 'Nom Responsable', 'Portable', 'Mail', 'Montant du', 'Restant à Payer','Mode règlement');  
                        $this->table->add_row($noEquipe,$Equipe[0]['NOMEQUIPE'],$Equipe[0]['PRENOM']." ".$Equipe[0]['NOM'],$Equipe[0]['TELPORTABLE'],$Equipe[0]['MAIL'],$Format_Du." €",$Format_APayer." €",$Equipe[0]['MODEREGLEMENT']); 
                        $Style = array('table_open' => '<table class="table" style="color:#CBCBCB" >');
                        $this->table->set_template($Style);
                        echo $this->table->generate();

                        echo form_open('AdminInscription/MiseAJourImpayes/'.($Equipe[0]['NOEQUIPE']));//,array('class'=>"form-vertical"));
                        echo '<div class="container-fluid">';
                        //form_hidden('noEquipe', $Equipe[0]['NOEQUIPE']);
                        
                        echo form_input('MontantPaye', $Equipe[0]['MONTANTPAYE'],array('required'=>'required','pattern'=>'[0-9]+(\.[0-9]+)','title'=>'format de prix. Ex : 15.50'));
                        $Menu = array
                        (
                            "Cheque"=>"Chèque",
                            "Especes"=>"Espèces",
                            "CheqEsp"=>"Chèque et Espèces",
                            ""=>"Rien",
                        );
                        echo form_dropdown('ModePaiement', $Menu);
                        echo form_submit('submit', 'Mise à Jour').'</div>';
                        echo form_close();
                            

                    ?>
                    
                </div>
            </section>
        </div>
    </div>
</div>

