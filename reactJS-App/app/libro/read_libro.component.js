// component that contains all the logic and other smaller components
// that form the Read libro view
window.ReadLibroComponent = React.createClass({
    getInitialState: function() {
        return {
            libro: []
        };
    },
 
    // on mount, fetch all libro and stored them as this component's state
    componentDidMount: function() {
 
        this.serverRequest = $.get("http://localhost/editorialTPuno/wsEditorial/libro/read.php", function (libro) {
            this.setState({
                libro: libro.records
            });
        }.bind(this));
    },
 
    // on unmount, kill product fetching in case the request is still pending
    componentWillUnmount: function() {
        this.serverRequest.abort();
    },
 
    // render component on the page
    render: function() {
        // list of libro
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