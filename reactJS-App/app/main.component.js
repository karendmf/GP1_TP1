
window.MainApp = React.createClass({
 
    // indicamos el modo inicial 'read', que mostrara los libros
    getInitialState: function(){
        return {
            currentMode: 'read',
            libroId: null
        };
    },

    // funcion que sera usada cuando al hacer click en algo, cambie el estado actual
    changeAppMode: function(newMode, libroId){
        this.setState({currentMode: newMode});
            if(libroId !== undefined){
            this.setState({libroId: libroId});
        }
    },
 
    // render del componente basado en el modo actual
    render: function(){
 
        var modeComponent =
            <ReadLibroComponent
            changeAppMode={this.changeAppMode} />;
 
        switch(this.state.currentMode){
            case 'read':
                break;
            case 'unLibro':
                modeComponent = <UnLibroComponent libroId={this.state.libroId} changeAppMode={this.changeAppMode}/>;
                break;
            case 'create':
                modeComponent = <CreateLibroComponent changeAppMode={this.changeAppMode}/>;
                break;
            case 'update':
                modeComponent = <UpdateLibroComponent libroId={this.state.libroId} changeAppMode={this.changeAppMode}/>;
                break;
            case 'delete':
                modeComponent = <DeleteLibroComponent libroId={this.state.libroId} changeAppMode={this.changeAppMode}/>;
                break;
            default:
                break;
        }
 
        return modeComponent;
    }
});
 
// renderiza el componente en el div con id="contect"
ReactDOM.render(
    <window.MainApp />,
    document.getElementById('content')
);