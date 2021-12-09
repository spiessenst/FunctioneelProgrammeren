<?php

require_once "functions.php";
require_once "html_components.php";

$steden= GetData("SELECT * FROM images");

print PrintHead("Leuke plekken in Europa");
print PrintBody();
print PrintJumbo("Leuke plekken in Europa" , "Tips voor citytrips voor vrolijke vakantiegangers!");


?>


<div class="container">
    <div class="row">

        <?php

        foreach ($steden as $stad){
            print "<div class='col-sm-4'>";
            print "<h3> ". ucfirst($stad['img_title']) ."</h3>";
            print "<p>".$stad['img_width'] ." x ". $stad['img_height'] . " pixels" ."</p>";
            print "<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>";
            print "<img src=./images/". $stad['img_filename']." display=block width=100% height=240px>";
            print "<a href=stad.php?stad=".$stad['img_id'].">Meer info</a>";
            print "</div>";
        }

        ?>
    </div>
</div>
<?php
print PrintBodyEnd();
?>
