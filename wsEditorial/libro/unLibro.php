<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");  //especifica el método aceptado cuando se accede al recurso en respuesta
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// Se incluyen la conexion a la base y el objeto
include_once '../config/database.php';
include_once '../objects/libro.php';
 
// conexion a base de datos
$database = new Database();
$db = $database->getConnection();
 
// Se inicializa el objeto usando la conexion a la base
$libro = new Libro($db);
 
// Se setea el id del libro que se desea editar en el objeto libro.
// El id ingresa por get, en caso de no recibirlo por este parametro, la accion muere. 
$libro->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// Se leen los detalles del libro que se desea editar
$resp=$libro->readOne();

// Si se puede leer los datos, entonces se crea un arreglo con los datos del libro
// en caso contrario se envia un mensaje. 
if ($resp){
    $libro_arr = array(
        "id" =>  $libro->id,
        "nombre" => $libro->nombre,
        "descripcion" => $libro->descripcion,
        "isbn" => $libro->isbn,
        "autor" => $libro->autor,
        "fecha" => $libro->fecha
    );
    
    // se codifica en formato json
    echo(json_encode($libro_arr));
}else{
    echo json_encode(
        array("message" => "No se encuentra el libro.")
    );
}
?>