// component that renders a single libro
window.LibroRow = React.createClass({
    render: function() {
    return (
        <tr>
            <td>{this.props.libro.nombre}</td>
            <td className="ellipsis">{this.props.libro.descripcion}</td>
            <td>{this.props.libro.isbn}</td>
            <td>{this.props.libro.autor}</td>
            <td>{this.props.libro.fecha}</td>
            <td>
                <div className="btn-group" role="group" aria-label="Basic example">
                    <a href='#'
                    onClick={() => this.props.changeAppMode('unLibro', this.props.libro.id)} role="button" className="btn btn-info">Ver</a>
                    <a href='#'
                    onClick={() => this.props.changeAppMode('update', this.props.libro.id)} role="button" className="btn btn-primary">Editar</a>
                    <a href='#' onClick={() => this.props.changeAppMode('delete', this.props.libro.id)} role="button" className="btn btn-danger">Eliminar</a>
                </div>
            </td>
        </tr>
        );
    }
});