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
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
 
// query libros
$stmt = $libro->search($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // libros array
    $libros_arr=array();
    $libros_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $libro_item=array(
            "id" => $id,
            "nombre" => $nombre,
            "descripcion" => html_entity_decode($descripcion),
            "autor" => $autor,
            "fecha" => $fecha,
            "isbn" => $isbn
        );
 
        array_push($libros_arr["records"], $libro_item);
    }
 
    echo json_encode($libros_arr);
}
 
else{
    echo json_encode(
        array("message" => "No se encontraron libros.")
    );
}
?>