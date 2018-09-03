<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE"); //especifica el método aceptado cuando se accede al recurso en respuesta
header("Access-Control-Max-Age: 3600"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// Se incluyen la conexion a la base y el objeto
include_once '../config/database.php';
include_once '../objects/libro.php';
 
// Se establece la conexion a la base de datos. 
$database = new Database();
$db = $database->getConnection();
 
// Se inicializa el objeto usando la conexion a la base
$libro = new Libro($db);
 
// Se obtiene el ID del libro que se desea eliminar
$data = json_decode(file_get_contents("php://input"));
 
// Se establece el id en el objeto Libro. 
$libro->id = $data->id;
 
// Se utiliza la funcion delete para borrar el libro cuyo id fue seteado anteriormente
// Se envia true si el libro fue borrado correctamente o false de lo contrario. 
if($libro->delete()){
    echo '{';
        echo '"message": "true"';
    echo '}';
}else{
    echo '{';
        echo '"message": "false"';
    echo '}';
}
?>