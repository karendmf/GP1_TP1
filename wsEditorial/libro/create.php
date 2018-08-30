<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate libro object
include_once '../objects/libro.php';
 
$database = new Database();
$db = $database->getConnection();
 
$libro = new Libro($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set libro property values
$fecha= new DateTime($data->fecha);

$libro->nombre = $data->nombre;
$libro->isbn = $data->isbn;
$libro->descripcion = $data->descripcion;
$libro->autor = $data->autor;
$libro->fecha = date_format($fecha, 'Y-m-d');
$libro->imagen = $data->imagen;
 
// create the libro
$crear = $libro->create();

if($crear){
    echo json_encode(
        array("message" => "Libro creado")
    );
}
 
// if unable to create the libro, tell the user
else{
    echo json_encode(
        array("message" => "Error al crear un libro")
    );
}
?>