// Clase que muestra el boton de Cargar Libro
window.TopActionsComponent = React.createClass({
    render: function(){
        return (
            <div>
                <a href='#'
                    onClick={() => this.props.changeAppMode('create')}
                    className='btn btn-outline-primary boton'> Cargar Libro
                </a>
            </div>
        );
    }
});