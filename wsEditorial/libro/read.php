<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/libro.php';

// instantiate database and libro object
$database = new Database();
$db = $database->getConnection();

// initialize object
$libro = new Libro($db);

// query products
$stmt = $libro->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $libro_arr=array();
    $libro_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $unLibro=array(
            "id" => $id,
            "nombre" => $nombre,
            "descripcion" => html_entity_decode($descripcion),
            "isbn" => $isbn,
            "autor" => $autor,
            "fecha" => $fecha
        );
 
        array_push($libro_arr["records"], $unLibro);
    }
 
    echo json_encode($libro_arr);
}
 
else{
    echo json_encode(
        array("message" => "No hay libros registrados.")
    );
}

?>