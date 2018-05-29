<html>
<<<<<<< HEAD

    <body>
        <H1 align = "center" style="color:#EAF815">Bienvenue sur RandoTroll !</H1>
        <div class="row">  
            <div class="col-sm-9">
                <section >
                    <div class = "section-inner" style="background-color:#00021A;padding:20px">
                        <p style="color:#CBCBCB">
                            Petit texte au cas où genre type présentation
                        </p>
                    </div>
                </section>
            </div>

            <div class="col-sm-3">
                <section >
                    <div class = "section-inner" style="background-color:#00021A;padding:20px">
                        <H4 style="color:#CBCBCB">j-X suivant la date de la course</H4>
                        <H4 style="color:#CBCBCB">Plus que X place = 700 - les deja inscrits</H4>
                    </div>
                </div>
            </div>
            <BR><BR>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <section >
                    <div class = "section-inner" style="background-color:#00021A;padding:20px">
                        <?php 
                            //Affiche de l'année
                            echo '<p>'.img('Gloomy_Forest.jpg').'<p>';
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </body>
=======
<?php echo ("Bienvenue sur RandoTroll !") ?>
<body>
<?php
echo 'j-X suivant la date de la course';
echo 'plus que X place = 700 - les deja inscrits';
echo form_open('Visiteur/seDeconnecter');
echo form_submit('deco', 'Se Deconnecter');
echo form_close();
?>
</body>
>>>>>>> 7c45f900806ec9b4b00a6de6c734675a7697beb2
<html>