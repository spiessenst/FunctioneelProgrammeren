<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Stad</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>

<?php

require_once "config.php";
require_once "conn.php";
require_once "functions.php";


if ( $_GET["stad"] > "" ) {
    $steden = GetData("SELECT * FROM images where img_id = " . $_GET["stad"], $conn);
}
else{
    header("Location: steden.php");


}
?>

<div class="jumbotron text-center">
    <h1>Detail Stad</h1>

</div>

<div class="container">
    <div class="row">

        <?php

        foreach ($steden as $row =>$stad){
            print "<div class='col-sm-10'>";
            print "<h3> ". ucfirst($stad['img_title']) ."</h3>";
            print "<p>".$stad['img_width'] ." x ". $stad['img_height'] . " pixels" ."</p>";
            print "<p>Filename: ".  $stad['img_filename']  ."</p>";
            print "<img src=./images/". $stad['img_filename']." display=block width=100% height=auto >";
            print "<a href=steden.php>Terug naar overzicht</a>";
            print "</div>";
        }
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>