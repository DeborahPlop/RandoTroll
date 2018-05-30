<div class="row"> 
<div class="col-sm-3">
</div>
    <div class="col-sm-6">
        <div class = "text-center">
            <section >
                <div class = "section-inner" style="background-color:#00021A;padding:20px">
                    <H1 align = "center" style="color:#EAF815"> Affectation de vagues </H1>
                    <?php
                        if(!empty($Equipes))
                        {
                            echo form_open('AdminInscription/AffectationVague');
                        //var_dump($Equipes);
                        foreach($Equipes as $uneEquipe) :
                            if(empty($Options))
                            {
                                $Options = array($uneEquipe['NOEQUIPE']=>$uneEquipe['NOMEQUIPE']);
                            }
                            else
                            {
                                $temp = array($uneEquipe['NOEQUIPE']=>$uneEquipe['NOMEQUIPE']);
                                $Options = $Options + $temp; 
                            }
                            //var_dump($Options);                           
                        endforeach;
                        //var_dump($Options);
                        echo 
                        form_dropdown('Equipes', $Options, 'default');
                        
                        echo 
                        form_input('Vague', '',array('placeholder'=>'Choisissez une vague','pattern'=>'[0-9]{1,2}','title'=>'un nombre compris entre 1 et 99'));
                        
                        //form_checkbox(name, value, TRUE);
                        
                        
                        echo 
                        form_submit('submit', 'Affecter');
                        
                        echo form_close();
                        }
                        else
                        {
                            echo '<h3 style="color:#CBCBCB"> La totalité des équipes actuellement inscrite se sont vues attribuées une vague. </h3>';
                            echo'<h3 style="color:#CBCBCB"> Merci. </H3>';
                            echo '<a href="'.site_url('Visiteur/loadAccueil').'" class="btn btn-default" > Retour </a>';
                        }
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>

