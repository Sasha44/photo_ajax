<?php

class PhotoUpload {

    protected $src;

    const AVAILIBLE_TYPES = array(
        "image/jpeg",
        "image/jpg",
        "image/png"
    );
    const IMAGE_SIZE = 2 * 1024 * 1024;
    const UPLOAD_DIR = 'photos';

    public function validate() {
        $file = $_FILES['photo'];
        if (empty($_FILES['photo'])) {
            return FALSE;
        } else if (!in_array($file['type'], self::AVAILIBLE_TYPES)) {
            return FALSE;
        } else if ($file['size'] > self::IMAGE_SIZE) {
            return FALSE;
        }
        return TRUE;
    }

    public function upload() {
        $file = $_FILES['photo'];
        $file_name_parts = explode(".", $file['name']);
        $file_extention = array_pop($file_name_parts);
        $file_base_name = implode("", $file_name_parts);
        $file_name = md5($file_base_name . rand(1, getrandmax()));
        $file_name .= '.' . $file_extention;
        $this->src = self::UPLOAD_DIR . '/' . $file_name;
        move_uploaded_file($file['tmp_name'], $this->src);
        return $this;
    }

    public function addToDB() {
        if ($this->src) {
            $query = "INSERT INTO images (src) values ('{$this->src}')";
            $dbn = new PDO('mysql:host=localhost;dbname=gallery', 'root', '');
            $dbn->query($query);
        }
    }

}

$pu = new PhotoUpload();
if ($pu->validate()) {
    $pu->upload()->addToDB();
}
//--------------------------------------------------------
$query = "SELECT*FROM images";
$dbn = new PDO('mysql:host=localhost;dbname=gallery', 'root', '');
$images = array();
foreach ($dbn->query($query) as $row) {
    $images[] = array(
        'id' => $row['id'],
        'src' => $row['src'],
    );
}
header('Content-type: application/json');
echo json_encode($images);
