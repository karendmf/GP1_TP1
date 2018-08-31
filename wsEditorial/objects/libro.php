<?php
class Libro{
    // database connection and table name
    private $conn;
    private $table_name = "libro";

    public $id;
    public $nombre;
    public $descripcion;
    public $isbn;
    public $imagen;
    public $autor;
    public $fecha;

    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
 
        // select all query
        $query = "SELECT * FROM $this->table_name ORDER BY id DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nombre=:nombre, autor=:autor, descripcion=:descripcion, fecha=:fecha, isbn=:isbn, imagen=:imagen";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->isbn=htmlspecialchars(strip_tags($this->isbn));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->autor=htmlspecialchars(strip_tags($this->autor));
        $this->fecha=$this->fecha;
        // bind values
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":fecha", $this->fecha);
    
        $execute = $stmt->execute();
        // execute query
        if($execute){
            return true;
        }else{
            return false;
        }
        
    }

    // ver un libro
    function readOne(){
    
        // query to read single record
        $query = "SELECT *
                FROM
                    " . $this->table_name . " 
                WHERE
                    id = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $num = $stmt->rowCount();

        if ($num>0){
            // set values to object properties
            $this->nombre = $row['nombre'];
            $this->isbn = $row['isbn'];
            $this->descripcion = $row['descripcion'];
            $this->autor = $row['autor'];
            $this->fecha = $row['fecha'];
            $this->imagen = $row['imagen'];

            return true;
        }
        else{
            return false;
        }
    }
    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nombre = :nombre,
                    isbn = :isbn,
                    descripcion = :descripcion,
                    autor = :autor,
                    imagen = :imagen,
                    fecha = :fecha
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->isbn=htmlspecialchars(strip_tags($this->isbn));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->autor=htmlspecialchars(strip_tags($this->autor));
        $this->fecha=htmlspecialchars(strip_tags($this->fecha));
        $this->imagen=htmlspecialchars(strip_tags($this->imagen));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':isbn', $this->isbn);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':imagen', $this->imagen);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    id, nombre, descripcion, isbn, autor, fecha, imagen
                FROM
                    " . $this->table_name . "
                WHERE
                    nombre LIKE ? OR autor LIKE ?
                ORDER BY
                    fecha DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    id, nombre, descripcion, isbn, autor, fecha, imagen
                FROM
                    " . $this->table_name . " 
                ORDER BY nombre DESC
                LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }
    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }

}
?>