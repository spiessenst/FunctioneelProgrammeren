<?php
require_once "config.php";

function GetData($sql)
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    $sqlarray = array();

    while ($row = mysqli_fetch_assoc($result))
        $sqlarray[] = $row;



    $conn->close();

    return $sqlarray;
}

function ExecSQL( $sql )
{
    // create connection

    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // execute given query
    $result = $conn->query($sql);

    return $result;
}

function MakeSelect( $fieldname, $sql, $list_fields = [], $optional = true )
{
    $rows = GetData($sql);

    $myselect = "";

    $myselect .= "<select id=$fieldname name=$fieldname>";

    if ( $optional ) $myselect .= "<option></option>";

    foreach ( $rows as $row )
    {
        $myselect .= "<option value='" . $row[$list_fields[0]] . "'>" . $row[$list_fields[1]] . "</option>";
    }

    $myselect .= "</select>";

    print $myselect;

}


function MakeForm($labels, $values){


    $form =  '<form id="mainform" name="mainform" action="save.php" method="post">';

    //toon eventueel alle velden
    foreach($values as $value){

       foreach ($labels as $label){

        //check of de veldnaam een _ bevat. geef alles achter de _ als labelnaam
        if (($pos = strpos($label["Field"], "_")) !== false) {
            $labeltext = substr($label["Field"], $pos+1);
        }
        else{
            $labeltext = $label["Field"];
        }
        // check of het een id readonly field is
        if($labeltext == "id"){
            $class = "form-control-plaintext";
            $readonly = "readonly";
        }else{
            $class = "form-control";
            $readonly = "";
        }
        //check of het een int of text is
        $arr = explode("(", $label["Type"]);
        $type = $arr[0];


        if($type == "int") $fieldtype = "number";
        else $fieldtype = "text";

        //print form
        $form .= '<div class="form-group row">';
        $form .= '<label for="'.$labeltext.'" class="col-sm-2 col-form-label">'.ucfirst($labeltext).'</label>';
        $form .=  '<div class="col-sm-10">';
        $form .= '<input type="'.$fieldtype.'" '.$readonly.' class="'.$class.'"  name="'.$label["Field"].'" id="'.$label["Field"].'" value="'.$value[$label["Field"]].'">';
        $form .=  '</div>';
        $form .=  '</div>';


    }
        //print button
        $form .= '<div class="form-group row">';
        $form .=  '<label for="" class="col-sm-2 col-form-label"></label>';
        $form .= '<div class="col-sm-10">';
        $form .= '<button type="submit" class="btn btn-primary">Save</button>';
        $form .=  '</div>';
        $form .=  '</div>';
        $form .= '</form>';

        $form .= '<div class="form-group row">';
        $form .= '<div class="col-sm-10">';
        $form .=    '<img src="./images/'.$value["img_filename"].'" display="block" width="100%" height="auto" >';
        $form .=  '</div>';
        $form .=  '</div>';
    }



    return $form;
    }
