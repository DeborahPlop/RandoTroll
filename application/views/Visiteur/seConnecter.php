<html>

<body>
<div class="row"> 
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
        <div class = "text-center">
            <section >
                    <div class = "section-inner" style="background-color:#00021A;padding:20px">
                        <?php
                        echo'<H1 align = "center" style="color:#EAF815">Connexion</H1><BR>';
                        echo validation_errors(); // mise en place de la validation
                            /* set_value : en cas de non validation les données déjà
                            saisies sont réinjectées dans le formulaire */
                        $blanc=array('style'=>'color:#CBCBCB');
                        
                        echo form_open('visiteur/seConnecter');
                        echo form_label('Mail : ','mail',$blanc); // creation d'un label devant la zone de saisie
                        echo form_input('mail','',array('required'=>'required'));
                        echo' ';
                        echo form_label('Mot de passe : ','mdp',$blanc);
                        echo form_password('mdp','',array('required'=>'required'));
                        echo' ';
                        echo form_submit('submit', 'Se connecter');
                        echo' ';
                        echo '<a href="'.site_url('Visiteur/recupmdp').'">Mot de passe oublié ?</a>';
                        echo form_close();

                        echo '<a href="'.site_url('Visiteur/sInscrire').'">S\'inscrire ? </a>';
                        
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
<html>