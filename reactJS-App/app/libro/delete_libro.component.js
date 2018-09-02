//componente que elimina un libro
window.DeleteLibroComponent = React.createClass({
    componentDidMount: function(){
        $('.page-header h1').text('Eliminar libro');
    },
    onDelete: function(e){
 
        // id del libro a eliminar
        var libroId = this.props.libroId;
     
        // envía los datos a la api
        $.ajax({
            url: "http://localhost/editorialTPuno/wsEditorial/libro/delete.php",
            type : "DELETE",
            contentType : 'application/json',
            data : JSON.stringify({'id' : libroId}),
            success : function(response) {
                this.props.changeAppMode('read');
            }.bind(this),
            error: function(xhr, resp, text){
                // show error in console
                console.log(xhr, resp, text);
            }
        });
    },
    // visualización
    render: function(){
 
        return (
            <div className='row'>
                <div className='col-md-3'></div>
                <div className='col-md-6'>
                    <div className='card'>
                        <div className='card-body text-center'>¿Desea eliminar el libro?</div>
                        <div className='card-footer text-center'>
                            <div className='text-align-center'>
                                <button onClick={this.onDelete}
                                    className='btn btn-danger boton'>Si</button>
                                <button onClick={() => this.props.changeAppMode('read')}
                                    className='btn btn-primary'>No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div className='col-md-3'></div>
            </div>
        );
    }
});