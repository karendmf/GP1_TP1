<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/libro.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and libro object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$libro = new Libro($db);
 
// query libros
$stmt = $libro->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // libros array
    $libros_arr=array();
    $libros_arr["records"]=array();
    $libros_arr["paging"]=array();
 
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
            "isbn" => $isbn,
            "autor" => $autor,
            "fecha" => $fecha
        );
 
        array_push($libros_arr["records"], $libro_item);
    }
 
 
    // include paging
    $total_rows=$libro->count();
    $page_url="{$home_url}libro/paginacion.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $libros_arr["paging"]=$paging;
 
    echo json_encode($libros_arr);
}
 
else{
    echo json_encode(
        array("message" => "No hay libros disponibles.")
    );
}
?>