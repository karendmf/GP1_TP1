window.CreateLibroComponent = React.createClass({

    getInitialState: function() {
        return {
            nombre: '',
            descripcion: '',
            autor: '',
            isbn: '',
            fecha: '',
            successCreation: null
        };
    },
    
    componentDidMount: function() {
        $('.page-header h1').text('Registrar libro');
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

    onSave: function(e){
    
        // datos del formulario
        var form_data={
            nombre: this.state.nombre,
            descripcion: this.state.descripcion,
            autor: this.state.autor,
            isbn: this.state.isbn,
            fecha: this.state.fecha,
        };
    
        // enviar datos de formulario a api
        $.ajax({
            url: "http://localhost/editorialTPuno/wsEditorial/libro/create.php",
            type : "POST",
            contentType : 'application/json',
            data : JSON.stringify(form_data),
            success : function(response) {
    
                // mensaje de api
                this.setState({successCreation: response['message']});
    
                // form vacio
                this.setState({nombre: ""});
                this.setState({descripcion: ""});
                this.setState({autor: ""});
                this.setState({isbn: ""});
                this.setState({fecha: ""});
    
            }.bind(this),
            error: function(xhr, resp, text){
                // show error to console
                console.log(xhr, resp, text);
            }
        });
    
        e.preventDefault();
    },

    render: function() {
    
        return (
        
        <div>
            {
                this.state.successCreation == "true" ?
                    <div className='alert alert-success'>
                        Libro registrado correctamente.
                    </div>
                : null
            }
            {
                this.state.successCreation == "false" ?
                    <div className='alert alert-danger'>
                        Error al registrar libro, intentelo otra vez.
                    </div>
                : null
            }
            
            <a href='#'
                onClick={() => this.props.changeAppMode('read')}
                className='btn btn-outline-primary boton'> Ver libros
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
