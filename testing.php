<?php
echo $_FILES['filename']['name'];
if (isset($_FILES['filename']['name'])) {
    $uploads_dir = 'uploads/';
    echo $_FILES['filename']['error'];
    if ($_FILES['filename']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["filename"]["tmp_name"];
        $name = basename($_FILES["filename"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
    }
}
?>

<form action="" method="post" enctype='multipart/form-data'>
<input name="filename" type="file"/>
<input type="submit" name="submit-form" value="Upload"/>
</form>


