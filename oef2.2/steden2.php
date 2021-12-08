<?php


require_once "functions.php";
require_once "html_components.php";

print PrintHead("Leuke plekken in Europa");

$steden= GetData("SELECT * FROM images");


?>

<div class="jumbotron text-center">
    <h1>Leuke plekken in Europa</h1>
    <p>Tips voor citytrips voor vrolijke vakantiegangers!</p>
</div>

<div class="container">
    <div class="row">

        <?php

        foreach ($steden as $row =>$stad){
            print "<div class='col-sm-4'>";
            print "<h3> ". ucfirst($stad['img_title']) ."</h3>";
            print "<p>".$stad['img_width'] ." x ". $stad['img_height'] . " pixels" ."</p>";
            print "<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>";
            print "<img src=./images/". $stad['img_filename']." display=block width=100% height=240px>";
            print "</div>";
        }
        ?>
    </div>
</div>



<?php
//inlezen van een bestand, replace, en printen
$content = file_get_contents("endofpage.txt");

print "<div class='container'>".str_replace( "@@TEKST@@", "Copyright 2021", $content)."</div>";


/*//wegschrijven van gegevens naar een bestand
$file = fopen("log.txt","a");                   //$file = een filepointer
$logstring = date("Y-m-d H:i:s") . " -> Er doet iemand een request!\n";
fwrite( $file, $logstring);
fclose( $file );

$sql = "insert into log (log_txt) values ('$logstring')";
ExecSQL($sql);*/
?>

</body>
</html>

