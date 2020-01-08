<?php
//$cover_letter = $_POST['filename']; // TODO nie dziala
//echo $cover_letter;
echo $_FILES['filename']['name'];
if (isset($_FILES['filename'])) {
    $uploads_dir = 'uploads/';
    echo $_FILES['filename']['error'];
    foreach ($_FILES["filename"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["filename"]["tmp_name"][$key];
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = basename($_FILES["filename"]["name"][$key]);
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            //$connection = @new mysqli($host, $db_user, $db_pass, $db_name);
            //$id_app_query = $connection->query("select id_application from applications");
            //$id_app = $id_app_query->num_rows + 1;
            //$id_app_user_query = $connection->query("select id_applicants from applicants where id_user = '{$_SESSION['id_user']}'");
            //$id_app_user_table = $id_app_user_query->fetch_assoc();
            //$id_appuser = $id_app_user_table['id_applicants'];
            //$id_position_query = $connection->query("select id_position from positions where position = '{$position}'");
            //$id_pos_table = $id_position_query->fetch_assoc();
            //$id_position = $id_pos_table['id_position'];
            //$ret = $connection->query("insert into cl (id_cl, description, id_application) values (null, 'uploads/{$name}', {$id_app})");
            //$id_cl_query = $connection->query("select id_cl from cl");
            //$id_cl = $id_cl_query->num_rows;
            //$ret = $connection->query("insert into applications (id_application, id_applicants, id_decision, id_position, id_status, id_cl) values (null, {$id_appuser}, 3, {$id_position}, 1, {$id_cl})");
            echo 'bangla';
        }
    }
}
?>

<form action="" method="post" enctype='multipart/form-data'>
<input name="filename" type="file"/>
<input type="submit" name="submit-form" value="Upload"/>
</form>
