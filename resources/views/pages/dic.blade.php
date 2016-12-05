@extends('app')

@section('content')
  <div id="dictionary-container">
  </div>


  <script type="text/babel">
  
    var Dictionary = React.createClass({
      

      render: function() {
         return(
          <div>
            <div className="row">
              <div className="col-md-4" />
              <div className="col-md-4 text-center">
                <div className="panel panel-default">
                  <div className="panel-heading">
                    <div className="panel-title">
                      ТОль
                    </div>
                  </div>
                  <div className="panel-body">
                    
                  </div>
                </div>
              </div>
              <div className="col-md-4" />
            </div>
          </div>
        );
      }
    });
    ReactDOM.render(
      <Dictionary />,
      document.getElementById('dictionary-container')
    );
  </script>
@endsection
