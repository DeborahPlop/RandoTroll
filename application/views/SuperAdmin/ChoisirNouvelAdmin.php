<h2><?php echo 'Quel bénévole à rendre admin ?' ?></h2>

<?php foreach ($lesBénévoles as $unBénévole):
     echo '<h3>'.anchor('SuperAdmin/nouvelAdmin/'.$unBénévole['NOCONTRIBUTEUR'],$unBénévole['NOM']).'</h3>';
endforeach;