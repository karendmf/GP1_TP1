<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/libro.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare libro object
$libro = new libro($db);
 
// get id of libro to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of libro to be edited
$libro->id = $data->id;
 
// set libro property values
$fecha= new DateTime($data->fecha);

$libro->nombre = $data->nombre;
$libro->isbn = $data->isbn;
$libro->descripcion = $data->descripcion;
$libro->autor = $data->autor;
$libro->fecha = date_format($fecha, 'Y-m-d');
 
// update the libro
if($libro->update()){
    echo '{';
        echo '"message": "El libro fue actualizado."';
    echo '}';
}
 
// if unable to update the libro, tell the user
else{
    echo '{';
        echo '"message": "Error al actualizar el libro."';
    echo '}';
}
?>