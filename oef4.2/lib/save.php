<?php
require_once "autoload.php";

SaveFormData();

function SaveFormData()
{
    if ( $_SERVER['REQUEST_METHOD'] == "POST" )
    {
        //controle CSRF token
        if ( ! key_exists("csrf", $_POST)) die("Missing CSRF");
        if ( ! hash_equals( $_POST['csrf'], $_SESSION['lastest_csrf'] ) ) die("Problem with CSRF");

        $_SESSION['lastest_csrf'] = "";

        //sanitization




        $table = $pkey = $update = $insert = $where = $str_keys_values = "";

        //get important metadata
        if ( ! key_exists("table", $_POST)) die("Missing table");
        if ( ! key_exists("pkey", $_POST)) die("Missing pkey");

        $table = $_POST['table'];
        $pkey = $_POST['pkey'];

        //validation
        $sending_form_uri = $_SERVER['HTTP_REFERER'];
        CompareWithDatabase( $table, $pkey );


        if (  key_exists("usr_password", $_POST)) {

            ValidateUsrPassword($_POST['usr_password'] , $_POST['usr_password2']);
            $_POST['usr_password'] = password_hash( $_POST['usr_password'], PASSWORD_BCRYPT );
        }

        if (  key_exists("usr_email", $_POST))  {
            ValidateUsrEmail($_POST['usr_email']);
            CheckUniqueUsrEmail(($_POST['usr_email']));
        }

        ValidateEmpty($_POST);

        //terugkeren naar afzender als er een fout is
        if ( count($_SESSION['errors']) > 0 ) {
            header( "Location: " . $sending_form_uri );
            $_SESSION['OLD_POST'] = $_POST;
            exit();
        }

        //insert or update?
        if ( $_POST["$pkey"] > 0 ) $update = true;
        else $insert = true;

        if ( $update ) $sql = "UPDATE $table SET ";
        if ( $insert ) $sql = "INSERT INTO $table SET ";

        //make key-value string part of SQL statement
        $keys_values = [];

        foreach ( $_POST as $field => $value )
        {
            //skip non-data fields
            if ( in_array( $field, [ 'table', 'pkey', 'afterinsert', 'afterupdate', 'csrf' , 'msgs', 'usr_password2' ] ) ) continue;

            //handle primary key field
            if ( $field == $pkey )
            {
                if ( $update ) $where = " WHERE $pkey = $value ";
                continue;
            }



            //all other data-fields
            $keys_values[] = " $field = '$value' " ;
        }

        $str_keys_values = implode(" , ", $keys_values );

        //extend SQL with key-values
        $sql .= $str_keys_values;

        //extend SQL with WHERE
        $sql .= $where;

        //run SQL
        $result = ExecuteSQL( $sql );



        //output if not redirected
        print $sql ;
        print "<br>";
        print $result->rowCount() . " records affected";

        $_SESSION['msgs'] = $_POST['msgs'];

        //redirect after insert or update
        if ( $insert AND $_POST["afterinsert"] > "" ) header("Location: ../" . $_POST["afterinsert"] );
        if ( $update AND $_POST["afterupdate"] > "" ) header("Location: ../" . $_POST["afterupdate"] );
    }
}

