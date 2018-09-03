// componente para toda la tabla de libros
window.LibroTable = React.createClass({
    render: function() {
 
    var rows = this.props.libro
        .map(function(libro, i) {
            return (
                <LibroRow
                    key={i}
                    libro={libro}
                    changeAppMode={this.props.changeAppMode} />
            );
        }.bind(this));
 
        return(
            !rows.length
                ? <div className='alert alert-danger'>No hay libros.</div>
                :
                <div className="table-responsive-lg">
                    <table className='table table-bordered table-hover'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Autor</th>
                                <th>Publicación</th>
                                <th>ISBN</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            {rows}
                        </tbody>
                    </table>
                </div>
        );
    }
});