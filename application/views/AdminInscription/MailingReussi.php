<div class="row"> 
    <div class="col-sm-4">
    </div> 
    <div class="col-sm-4">
        <div class = "text-center">
            <section>
                <div class = "section-inner" style="background-color:#00021A;padding:20px">
                    <div style='color:#CBCBCB'>
                        <?php 
                        
                            echo "Envoie de mail réussit :  <BR>";
                            echo $Reussite." emails envoyés sur ".$TotalEnvois."<BR>";
                            echo '<a href="'.site_url('AdminInscription/RelanceImpayes').'" class="btn btn-default"> Retour </a>'

                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>