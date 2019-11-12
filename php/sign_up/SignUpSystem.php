<?php


class SignUpSystem
{
/* pobierz z formularza
 * sprawdz poprawność
 * dodaj to $_SESSION
 *
 *
 *
 */
function rememberValue ($value_name)
{
    if (isset($_SESSION["$value_name"]))
    {
        echo $_SESSION["$value_name"];
        unset($_SESSION["$value_name"]);
    }
}

function setError($error_name)
{
    if (isset($_SESSION["$error_name"]))
    {
        echo '<div class="error">'.$_SESSION["$error_name"].'</div>';
        unset($_SESSION["$error_name"]);
    }
}
}

