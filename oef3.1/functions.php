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

function MakeFoto($path){

  $foto = '<div class="form-group row">';
      $foto .= '<div class="col-sm-10">';
    $foto .=    '<img src="'.$path.'" display="block" width="100%" height="auto" >';
   $foto .=  '</div>';
   $foto .=  '</div>';

return $foto;
}
function MakeForm($labels, $values){

    $value = $values[0];
    $form =  '<form id="mainform" name="mainform" action="save.php" method="post">';

    for( $i=0 ; $i<count($labels) ; $i++){

        //check of de veldnaam een _ bevat geef alles achter de _ als labelnaam
        if (($pos = strpos($labels[$i]["Field"], "_")) !== FALSE) {
            $label = substr($labels[$i]["Field"], $pos+1);
        }
        else{
            $label = $labels[$i]["Field"];
        }
        // check of het een id readonly field is
        if($label == "id"){
            $class = "form-control-plaintext";
            $readonly = "readonly";
        }else{
            $class = "form-control";
            $readonly = "";
        }
        //check of het een int of text is
        $arr = explode("(", $labels[$i]["Type"], 2);
        $type = $arr[0];

        if($type == "int") $fieldtype = "number";
        else $fieldtype = "text";

        //print form
        $form .= '<div class="form-group row">';
        $form .= '<label for="'.$label.'" class="col-sm-2 col-form-label">'.ucfirst($label).'</label>';
        $form .=  '<div class="col-sm-10">';
        $form .= '<input type="'.$fieldtype.'" '.$readonly.' class="'.$class.'"  name="'.$labels[$i]["Field"].'" id="'.$labels[$i]["Field"].'" value="'.$value[$labels[$i]["Field"]].'">';
        $form .=  '</div>';
        $form .=  '</div>';
    }
    $form .= '<div class="form-group row">';
    $form .=  '<label for="" class="col-sm-2 col-form-label"></label>';
    $form .= '<div class="col-sm-10">';
    $form .= '<button type="submit" class="btn btn-primary">Save</button>';
    $form .=  '</div>';
    $form .=  '</div>';
    $form .= '</form>';

    return $form;
    }
