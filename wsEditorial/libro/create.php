<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// conexion a base de datos
include_once '../config/database.php';
 
// objeto libro
include_once '../objects/libro.php';
 
$database = new Database();
$db = $database->getConnection();
 
$libro = new Libro($db);
 
if ( file_get_contents("php://input") === "" ){
    echo json_encode(
        array("message" => "No se ingresaron datos")
    );
}else{
    // get posted data
    $data = json_decode(file_get_contents("php://input"));

    // set libro property values
    $fecha= new DateTime($data->fecha);

    $libro->nombre = $data->nombre;
    $libro->isbn = $data->isbn;
    $libro->descripcion = $data->descripcion;
    $libro->autor = $data->autor;
    $libro->fecha = date_format($fecha, 'Y-m-d');
    
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
}
?>