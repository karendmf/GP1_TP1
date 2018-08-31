// Clase ReadLibroComponent que muestra todos los libros de la db
window.ReadLibroComponent = React.createClass({
    getInitialState: function() {
        return {
            libro: []
        };
    },
 
    // 
    componentDidMount: function() {
        this.serverRequest = $.get("http://localhost/editorialTPuno/wsEditorial/libro/read.php", function (libro) {
            this.setState({
                libro: libro.records
            });
        }.bind(this));
    },
 
    //
    componentWillUnmount: function() {
        this.serverRequest.abort();
    },
 
    // render componente en la pagina
    render: function() {
        // lista de libros
        var filteredlibro = this.state.libro;
        $('.page-header h1').text('Libros');
 
        return (
            <div className='overflow-hidden'>
                <TopActionsComponent changeAppMode={this.props.changeAppMode} />
 
                <LibroTable
                    libro={filteredlibro}
                    changeAppMode={this.props.changeAppMode} />
            </div>
        );
    }
});