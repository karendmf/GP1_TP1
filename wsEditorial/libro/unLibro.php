<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/libro.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare libro object
$libro = new Libro($db);
 
// set ID property of libro to be edited
$libro->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of libro to be edited
$resp=$libro->readOne();

if ($resp){
    // create array
    $libro_arr = array(
        "id" =>  $libro->id,
        "nombre" => $libro->nombre,
        "descripcion" => $libro->descripcion,
        "isbn" => $libro->isbn,
        "autor" => $libro->autor,
        "fecha" => $libro->fecha

    
    );
    
    // make it json format
    echo(json_encode($libro_arr));
}
else{
    echo json_encode(
        array("message" => "No se encuentra el libro.")
    );
}
?>