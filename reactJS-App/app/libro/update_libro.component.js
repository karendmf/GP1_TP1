window.UpdateLibroComponent = React.createClass({
    getInitialState: function() {
        // Obtener los campos del Libro cuyos datos fueron seteados en #content div, usando jQuery
        return {
            id: 0,
            nombre: '',
            descripcion: '',
            autor: '',
            isbn: '',
            fecha: '',
            successUpdate: null
        };
    },
    componentDidMount: function(){
        // read one libro data
        var libroId = this.props.libroId;
        this.serverRequest = $.get("http://localhost/editorialTPuno/wsEditorial/libro/unLibro.php?id=" + libroId,
            function (libro) {
                this.setState({autor: libro.autor});
                this.setState({id: libro.id});
                this.setState({nombre: libro.nombre});
                this.setState({descripcion: libro.descripcion});
                this.setState({fecha: libro.fecha});
                this.setState({isbn: libro.isbn});
            }.bind(this));
     
        $('.page-header h1').text('Editar libro');
    },
     
    // Antes de desmontar el componente, se termina la solicitud al servidor
    componentWillUnmount: function() {
        this.serverRequest.abort();
    },

    onNombreChange: function(e) {
        this.setState({nombre: e.target.value});
    },
    
    onDescripcionChange: function(e) {
        this.setState({descripcion: e.target.value});
    },
    
    onAutorChange: function(e) {
        this.setState({autor: e.target.value});
    },

    onISBNChange: function(e) {
        this.setState({isbn: e.target.value});
    },

    onFechaChange: function(e) {
        this.setState({fecha: e.target.value});
    },

    // botón de guardar cambios clickeado
    onSave: function(e){
        
        // datos en el formulario
        var form_data={
            nombre: this.state.nombre,
            descripcion: this.state.descripcion,
            autor: this.state.autor,
            isbn: this.state.isbn,
            fecha: this.state.fecha,
            id: this.state.id,
        };
    
        // enviar datos de formulario a api
        $.ajax({
            url: "http://localhost/editorialTPuno/wsEditorial/libro/update.php",
            type : "PUT",
            contentType : 'application/json',
            data : JSON.stringify(form_data),
            success : function(response) {
                this.setState({successUpdate: response['message']});
            }.bind(this),
            error: function(xhr, resp, text){
                // mostrar error a la consola
                console.log(xhr, resp, text);
            }
        });
    
        e.preventDefault();
    },
    render: function() {
     
        return (
            <div>
                {
                    this.state.successUpdate == "true" ?
                        <div className='alert alert-success'>
                            Libro actualizado.
                        </div>
                    : null
                }
     
                {
                    this.state.successUpdate == "false" ?
                        <div className='alert alert-danger'>
                            Error al intentar actualizar el libro.
                        </div>
                    : null
                }
     
                <a href='#'
                    onClick={() => this.props.changeAppMode('read')}
                    className='btn btn-outline-primary boton'>
                    Ver libros
                </a>
                <div className="row">
                    <div className="col-md-3"></div>
                    <div className="col-md-6">
                        <form onSubmit={this.onSave}>
                            <div class="form-group">
                                <label for="descripcion">Título</label>
                                <input className="form-control" type="text" id="nombre" name="nombre"
                                value={this.state.nombre}
                                onChange={this.onNombreChange}
                                required
                                ></input>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea className="form-control" id="descripcion" rows="3" name="descripcion"
                                value={this.state.descripcion}
                                onChange={this.onDescripcionChange}
                                required
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Autor</label>
                                <input className="form-control" type="text" id="autor" name="autor"
                                value={this.state.autor}
                                onChange={this.onAutorChange}
                                required
                                ></input>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Fecha de publicación</label>
                                <input className="form-control" type="date" id="fecha" name="fecha"
                                value={this.state.fecha}
                                onChange={this.onFechaChange}
                                required
                                ></input>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">ISBN</label>
                                <input className="form-control" type="number" id="isbn" name="isbn"
                                value={this.state.isbn}
                                onChange={this.onISBNChange}
                                required
                                ></input>
                            </div>
                            <button className='btn btn-primary boton' onClick={this.onSave}>Guardar</button>
                        </form>
                    </div>
                    <div className="col-md-3"></div>
                </div>
            </div>
     
                
        );
    }
});