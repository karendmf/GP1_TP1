<?php
class Libro{
    // Conexion a la base de datos y nombre de la tabla.
    private $conn;
    private $table_name = "libro";

    //Parametros publicos del objeto.
    public $id;
    public $nombre;
    public $descripcion;
    public $isbn;
    public $imagen;
    public $autor;
    public $fecha;

    // Constructor del objeto. 
    public function __construct($db){
        $this->conn = $db;
    }

    // Obtener los libros de la base de datos
    function read(){
 
        // Selecciona todos los libros de la base de datos
        $query = "SELECT * FROM $this->table_name ORDER BY id DESC";
    
        // prepara la declaración de consulta
        $stmt = $this->conn->prepare($query);
    
        // ejecutar la solicitud
        $stmt->execute();
    
        return $stmt;
    }

    // Crear Libro en la base de datos. 
    function create(){
    
        // consulta para insertar registro
        // usar nombre=:nombre es una forma alternativa de escritura. Se asignan los valores seteados en el objeto. 
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nombre=:nombre, autor=:autor, descripcion=:descripcion, fecha=:fecha, isbn=:isbn, imagen=:imagen";
    
        // prepara la declaración de consulta
        $stmt = $this->conn->prepare($query);
    
        // Se limpian los valores.
        // htmlspecialchars -> Convierte caracteres especiales en entidades HTML
        // strip_tags -> Retira las etiquetas HTML y PHP de un string
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->isbn=htmlspecialchars(strip_tags($this->isbn));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->autor=htmlspecialchars(strip_tags($this->autor));
        $this->fecha=$this->fecha;

        // Se vinculan los valores con el nombre especificado
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":fecha", $this->fecha);
    
        // ejecuta la solicitud
        $execute = $stmt->execute();
        // Lo retornado dependera del exito o fracaso de la solicitud. 
        if($execute){
            return true;
        }else{
            return false;
        }
        
    }

    // ver un libro
    function readOne(){
    
        // Consulta para acceder a un solo libro.
        $query = "SELECT *
                FROM
                    " . $this->table_name . " 
                WHERE
                    id = ?
                LIMIT
                    0,1";
    
        // prepara la declaración de consulta
        $stmt = $this->conn->prepare( $query );
    
        // vincula el id del libro
        $stmt->bindParam(1, $this->id);
    
        // ejecuta la solicitud
        $stmt->execute();
    
        // obtiene la fila recuperada
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $num = $stmt->rowCount();
        
        // se verifica si se devolvio una fila. El retorno de la funcion dependera del exito o fallo de la consulta.  
        if ($num>0){
            // se setean los parametros del objeto con los datos de las filas.
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
    
    //Actualizar producto. 
    function update(){
    
        // consulta de actualización
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
    
        // prepara la declaración de consulta
        $stmt = $this->conn->prepare($query);
    
        // Se limpian los valores.
        // htmlspecialchars -> Convierte caracteres especiales en entidades HTML
        // strip_tags -> Retira las etiquetas HTML y PHP de un string
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->isbn=htmlspecialchars(strip_tags($this->isbn));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->autor=htmlspecialchars(strip_tags($this->autor));
        $this->fecha=htmlspecialchars(strip_tags($this->fecha));
        $this->imagen=htmlspecialchars(strip_tags($this->imagen));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // Se vinculan los valores con el nombre especificado
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':isbn', $this->isbn);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':imagen', $this->imagen);
        $stmt->bindParam(':id', $this->id);
    
        // ejecuta la solicitud
        // Lo retornado dependera del exito o fracaso de la solicitud.
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    
    // Borrar un Libro. 
    function delete(){
    
        // consulta de borrado
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // preparar consulta
        $stmt = $this->conn->prepare($query);
    
        // Se limpian los valores.
        // htmlspecialchars -> Convierte caracteres especiales en entidades HTML
        // strip_tags -> Retira las etiquetas HTML y PHP de un string
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // Se vincula el id del Libro que se desea borrar
        $stmt->bindParam(1, $this->id);
    
        // ejecuta la solicitud
        // Lo retornado dependera del exito o fracaso de la solicitud.
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

}
?>