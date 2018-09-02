<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Se incluyen la conexion a la base y el objeto
include_once '../config/database.php';
include_once '../objects/libro.php';

// Se establece la conexion a la base de datos. 
$database = new Database();
$db = $database->getConnection();

// Se inicializa el objeto usando la conexion a la base.
$libro = new Libro($db);

// Se consultan los libros en la base de datos. 
$stmt = $libro->read();
$num = $stmt->rowCount();
 
// Se verifica si hay mas de 0 libros cargados
if($num>0){
    // Se crea un array de libros. 
    $libro_arr=array();
    $libro_arr["records"]=array();

    // Recuperar el contenido de la tabla (BD).
    // fetch es mas rapido de fetchAll
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // Importa variables desde un array a la tabla de símbolos actual.
        extract($row);
 
        // Se cargan los valores en el arreglo.
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
    
    // Se codifica el array en un formato entendible para json. 
    echo json_encode($libro_arr);
}else{
    //En caso de que no hallan libros cargados se envia un mensaje al usuario. 
    echo json_encode(
        array("message" => "No hay libros registrados.")
    );
}

?>