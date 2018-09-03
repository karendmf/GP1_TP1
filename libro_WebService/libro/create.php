<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST"); //especifica el método aceptado cuando se accede al recurso en respuesta
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("HTTP/1.1 201 Created"); //Respuesta del servidor cuando se crea correctamente un registro
 
// conexion a base de datos
include_once '../config/database.php';
 
// objeto libro
include_once '../objects/libro.php';
 
$database = new Database();
$db = $database->getConnection();
 
$libro = new Libro($db);

//Decodifica un string de JSON
//Transmite un fichero completo a una cadena
$data = json_decode(file_get_contents("php://input"));

//Verifica los datos recibidos y envia una respuesta.
if ( file_get_contents("php://input") === "" ){
    echo json_encode(
        array("message" => "false")
    );
}elseif ($data->nombre=='' || $data->isbn=='' || $data->autor=='' || $data->descripcion=='' || $data->fecha=='' ){
    echo json_encode(
        array("message" => "false")
    );
}else{
    //Se obtienen los datos publicados
    
    //Se establecen los valores de los parametros del objeto libro
    $fecha= new DateTime($data->fecha);

    $libro->nombre = $data->nombre;
    $libro->isbn = $data->isbn;
    $libro->descripcion = $data->descripcion;
    $libro->autor = $data->autor;
    $libro->fecha = date_format($fecha, 'Y-m-d');
    
    //Se crea el libro dentro de la base de datos. 
    $crear = $libro->create();

    //Si el libro se cargó correctamente se envia true y en caso contrario se envia false 
    //json_encode devuelve un string con la representación JSON    
    if($crear){
        echo json_encode(
            array("message" => "true")
        );
    }else{
        echo json_encode(
            array("message" => "false")
        );
    }
}
?>