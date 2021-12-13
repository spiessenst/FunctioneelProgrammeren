<?php

require_once "functions.php";
require_once "html_components.php";


if (  is_numeric($_GET["stad"] )) {

    $steden = GetData("SELECT * FROM images where img_id = " . $_GET["stad"]);
    $rijnamen = GetData("SHOW COLUMNS from images");

    $stad = $steden[0];

}
else{
    header("Location: steden.php");
}

print PrintHead("Detail Stad");
print PrintBody();
print PrintJumbo("Bewerk Afbeelding" , "");

?>

<div class="container">
    <?php
    print MakeForm($rijnamen , $steden);
    print MakeFoto("./images/".$stad['img_filename']);
    print "<a href=steden.php>Terug naar overzicht</a>";
    ?>
</div>
<?php
print PrintBodyEnd();
?>


