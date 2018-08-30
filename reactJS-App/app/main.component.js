
window.MainApp = React.createClass({
 
    // initial mode is 'read' mode
    getInitialState: function(){
        return {
            currentMode: 'read',
            libroId: null
        };
    },
 
    // used when use clicks something that changes the current mode
    changeAppMode: function(newMode, libroId){
        this.setState({currentMode: newMode});
            if(libroId !== undefined){
            this.setState({libroId: libroId});
        }
    },
 
    // render the component based on current or selected mode
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
 
// go and render the whole React component on to the div with id 'content'
ReactDOM.render(
    <window.MainApp />,
    document.getElementById('content')
);