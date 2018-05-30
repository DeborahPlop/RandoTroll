<html>


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
                        <div class="text-sm-left">
                        <?php
                            $Aujourd_hui = date('Y/m/d');
                            
                            $nbJours= date_diff(date_create($DateCourse),date_create($Aujourd_hui))->days;
                            // var_dump($nbJours);
                            echo'
                            <H4 style="color:#CBCBCB">J-'.$nbJours  .' avant la course</H4>
                            <H4 style="color:#CBCBCB">'.($MaxParticipants-$nbInscrits) .' places restantes </H4>';
                        ?>
                        </div>
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

