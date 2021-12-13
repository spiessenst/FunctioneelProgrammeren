<?php

require_once "functions.php";
require_once "html_components.php";





if (  is_numeric($_GET["stad"] )) {

    $steden = GetData("SELECT * FROM images where img_id = " . $_GET["stad"]);


}
else{
    header("Location: steden.php");
}


print PrintHead("Detail Stad");
print PrintBody();
print PrintJumbo("Bewerk Afbeelding" , "");
?>


<div class="container">

    <?php $stad = $steden[0]; ?>

    <form id="mainform" name="mainform" action="save.php " method="post">
        <div class="form-group row">
            <label for="id" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="number" readonly class="form-control-plaintext" name="img_id" id="id" value="<?=$stad['img_id'];  ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Tilte</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="img_title" id="title" value="<?=$stad['img_title'];  ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="filename" class="col-sm-2 col-form-label">Filename</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="img_filename" id="filename" value="<?=$stad['img_filename'];  ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="width" class="col-sm-2 col-form-label">Width</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="img_width" id="width"value="<?=$stad['img_width'];  ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="height" class="col-sm-2 col-form-label">Height</label>
            <div class="col-sm-10">
                <input type="number" class="form-control"  name="img_height" id="height" value="<?=$stad['img_height'];  ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <?php
                print "<img src=./images/". $stad['img_filename']." display=block width=100% height=auto >";
                print "<a href=steden.php>Terug naar overzicht</a>";
                ?>
            </div>
        </div>

    </form>

</div>
</div>
<?php
print PrintBodyEnd();
?>


