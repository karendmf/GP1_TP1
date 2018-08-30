<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/libro.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare libro object
$libro = new Libro($db);
 
// get libro id
$data = json_decode(file_get_contents("php://input"));
 
// set libro id to be deleted
$libro->id = $data->id;
 
// delete the libro
if($libro->delete()){
    echo '{';
        echo '"message": "Libro eliminado."';
    echo '}';
}
 
// if unable to delete the libro
else{
    echo '{';
        echo '"message": "Error al eliminar el libro."';
    echo '}';
}
?>