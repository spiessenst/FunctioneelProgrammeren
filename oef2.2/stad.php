<?php

require_once "functions.php";
require_once "html_components.php";

print PrintHead("Detail Stad");

$steden= GetData("SELECT * FROM images");


if (  is_numeric($_GET["stad"] )) {

    $steden = GetData("SELECT * FROM images where img_id = " . $_GET["stad"]);
}
else{
    header("Location: steden.php");
}
print PrintBody();

print PrintJumbo("Detail Stad" , "");
?>


<div class="container">
    <div class="row">

        <?php

        foreach ($steden as $stad){
            print "<div class='col-sm-10'>";
            print "<h3> ". ucfirst($stad['img_title']) ."</h3>";
            print "<p>".$stad['img_width'] ." x ". $stad['img_height'] . " pixels" ."</p>";
            print "<p>Filename: ".  $stad['img_filename']  ."</p>";
            print "<img src=./images/". $stad['img_filename']." display=block width=100% height=auto >";
            print "<a href=steden.php>Terug naar overzicht</a>";
            print "</div>";
        }

        ?>
    </div>
</div>
</body>
</html>



