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

$data = json_decode(file_get_contents("php://input"));

if ( file_get_contents("php://input") === "" ){
    echo json_encode(
        array("message" => "false")
    );
}elseif ($data->nombre=='' || $data->isbn=='' || $data->autor=='' || $data->descripcion=='' || $data->fecha=='' ){
    echo json_encode(
        array("message" => "false")
    );
}else{
    // get posted data
    

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
            array("message" => "true")
        );
    }
    
    // if unable to create the libro, tell the user
    else{
        echo json_encode(
            array("message" => "false")
        );
    }
}
?>