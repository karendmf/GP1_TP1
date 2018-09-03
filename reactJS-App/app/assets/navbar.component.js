// clase Menu (navbar)
window.Menu = React.createClass({
  render: function(){
    return (
      <div>
        <nav className="navbar navbar-expand-lg navbar-light">
          <a className="navbar-brand" href="#">Editorial 
            <img src="app/assets/React.svg" alt="Logo" className="imagen"/>
          </a>
          <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
          </button>

          <div className="collapse navbar-collapse" id="navbarSupportedContent">
            <ul className="navbar-nav ml-auto">
              <li className="nav-item active">
                <a className="nav-link" href="index.html">Inicio</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    );
  }
});
ReactDOM.render(
  <window.Menu />,
  document.getElementById('menu')
);