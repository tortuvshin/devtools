@extends('app')

@section('content')
  <div id="survey-container">
  </div>

  <script type="text/babel">
    // Parent Survey component responsible for fetching object from endpoint
    var Survey = React.createClass({
      getInitialState: function() {
        return {
          survey: []
        };
      },

      componentWillMount: function() {
        this._getSurvey();
      },

      _getSurvey: function() {
        var url = document.URL.split('/');
        $.get('/surveys/' + url[url.length - 1] , function(data) {
          this.setState({ survey: data });
        }.bind(this));
      },

    render: function() {
      return (
        <div>
          <div className="row">
            <div className="col-md-4" />
            <div className="col-md-4 text-center">
              <div className="panel panel-default">
                <div className="panel-heading">
                  <div className="panel-title">
                    Survey for: {this.state.survey.time_taken}
                  </div>
                </div>
                <div className="panel-body text-center">
                  <SurveyGraph
                   survey={this.state.survey}
                  />
                </div>
              </div>
            </div>
            <div className="col-md-4" />
          </div>
        </div>
      );
      }
    });

    // Survey Graph component responsible for rendering chart
    var SurveyGraph = React.createClass({
      componentDidUpdate: function() {
        Chart.defaults.global.legend.display = false;
        Chart.defaults.global.tooltips.enabled = false;

        var survey = this.props.survey;
        var ctx = document.getElementById("survey-chart");
        var myChart = new Chart(ctx, {
          type: 'bar',
          options: {
              responsive: false,
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true,
                          max: 5,
                          maxTicksLimit: 5
                      }
                  }]
              }
          },
          data: {
              labels: ["Mood", "Sleep", "Community", "Diet"],
              datasets: [{
                  label: 'Daily Survey',
                  data: [
                    survey.question_1_response,
                    survey.question_2_response,
                    survey.question_3_response,
                    survey.question_4_response
                  ],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                  ],
                  borderWidth: 1
              }]
          }
        });
      },

      render: function() {
        return (
          <div>
            <canvas className="img-responsive center-block" id="survey-chart" width="320" height="275"></canvas>
          </div>
        );
      }
    });

    ReactDOM.render(
      <Survey />,
      document.getElementById('survey-container')
    );
  </script>
@endsection
