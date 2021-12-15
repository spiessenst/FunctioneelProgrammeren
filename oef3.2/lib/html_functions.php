<?php
require_once "pdo.php";


function PrintNavbar() {

    $nav = file_get_contents("templates/navbar.html");
    print $nav;
}

function PrintHead()
{
    $head = file_get_contents("templates/head.html");
    print $head;
}

function PrintJumbo( $title = "", $subtitle = "" )
{
    $jumbo = file_get_contents("templates/jumbo.html");

    $jumbo = str_replace( "@jumbo_title@", $title, $jumbo );
    $jumbo = str_replace( "@jumbo_subtitle@", $subtitle, $jumbo );

    print $jumbo;
}

function MergeViewWithData( $template, $data )
{
    $returnvalue = "";

    foreach ( $data as $row )
    {
        $output = $template;

        foreach( array_keys($row) as $field )  //eerst "img_id", dan "img_title", ...
        {
            $output = str_replace( "@$field@", $row["$field"], $output );
        }

        $returnvalue .= $output;
    }

    return $returnvalue;
}


function MergeViewWithExtra( $template, $elements )
{

    foreach ( $elements as $key => $element )
    {
        $template = str_replace( "@$key@", $element, $template );
    }

    return $template;

}

function MakeSelect( $fieldname, $sql, $list_fields = [], $select_value  , $optional = true )
{
    $rows = GetData($sql);

    $myselect = "";

    $myselect .= "<select id=$fieldname name=$fieldname>";

    if ( $optional ) $myselect .= "<option></option>";

    foreach ( $rows as $row )

    {
        if ($row[$list_fields[0]] == $select_value) $myselect .= "<option value='" . $row[$list_fields[0]] . "' selected >" . $row[$list_fields[1]] . "</option>";
        else $myselect .= "<option value='" . $row[$list_fields[0]] . "' >" . $row[$list_fields[1]] . "</option>";

    }

    $myselect .= "</select>";

    return $myselect;


}