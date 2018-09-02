<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// Se incluyen la conexion a la base y el objeto
include_once '../config/database.php';
include_once '../objects/libro.php';
 
// Se establece la conexion a la base de datos. 
$database = new Database();
$db = $database->getConnection();
 
// Se inicializa el objeto usando la conexion a la base
$libro = new libro($db);
 
// Se obtiene el ID del libro que se desea editar
$data = json_decode(file_get_contents("php://input"));

// Se establece el id en el objeto Libro. 
$libro->id = $data->id;
 
// Se establecen los valores de los parametros del objeto libro
$fecha= new DateTime($data->fecha);

$libro->nombre = $data->nombre;
$libro->isbn = $data->isbn;
$libro->descripcion = $data->descripcion;
$libro->autor = $data->autor;
$libro->fecha = date_format($fecha, 'Y-m-d');
 
// Se actualiza el libro y se encia un mensaje si es exitoso o no. 
if($libro->update()){
    echo '{';
        echo '"message": "true"';
    echo '}';
}else{
    echo '{';
        echo '"message": "false"';
    echo '}';
}
?>