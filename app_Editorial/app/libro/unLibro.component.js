window.UnLibroComponent = React.createClass({
    getInitialState: function() {
        // Obtener los campos del Libro cuyos datos fueron seteados en #content div, usando jQuery
        return {
            id: 0,
            nombre: '',
            descripcion: '',
            autor: '',
            isbn: '',
            fecha: '',
        };
    },
     
    // en componentDidMount, lee los datos del libro como el estado de este componente
    componentDidMount: function(){
     
        var libroId = this.props.libroId;
     
        this.serverRequestProd = $.get("http://localhost/GP1_TP1/libro_WebService/libro/unLibro.php?id=" + libroId,
            function (libro) {
                this.setState({autor: libro.autor});
                this.setState({id: libro.id});
                this.setState({nombre: libro.nombre});
                this.setState({descripcion: libro.descripcion});
                this.setState({fecha: libro.fecha});
                this.setState({isbn: libro.isbn});
            }.bind(this));
     
        $('.page-header h1').text('Ver libro');
    },
     
    // Antes de desmontar el componente, se termina la solicitud al servidor
    componentWillUnmount: function() {
        this.serverRequestProd.abort();
    },

    render: function() {
 
        return (
            <div>
                <a href='#'
                    onClick={() => this.props.changeAppMode('read')}
                    className='btn btn-outline-primary boton'>
                    Ver libros
                </a>
                <div className="row">
                    <div className="col-md-2">
                    <div className="btn-group" role="group" aria-label="Basic example">
                        <a href='#'
                        onClick={() => this.props.changeAppMode('update', this.state.id)} role="button" className="btn btn-primary">Editar</a>
                        <a href='#' onClick={() => this.props.changeAppMode('delete', this.state.id)} role="button" className="btn btn-danger">Eliminar</a>
                    </div>
                    </div>
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">
                                Autor: {this.state.autor}
                            </div>
                            <div className="card-body">
                                <h5 className="card-title">{this.state.nombre}</h5>
                                <p className="card-text">{this.state.descripcion}</p>
                            </div>
                            <div className="card-footer text-muted">
                                Fecha de publicación: {this.state.fecha}
                                <br></br>
                                ISBN: {this.state.isbn}
                            </div>
                        </div>
                    </div>
                    <div className="col-md-2"></div>
                </div>
            </div>
        );
    }
});