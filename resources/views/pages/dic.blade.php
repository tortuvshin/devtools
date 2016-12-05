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
              <div className="col-md-8" />
              <div className="col-md-8 text-center">
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
              <div className="col-md-8" />
            </div>
            <div className="black">aaaa</div>
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
