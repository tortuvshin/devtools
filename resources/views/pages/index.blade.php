@extends('app')

@section('content')
  <div id="surveys-container">
  </div>

  <script type="text/babel">
    // Parent Survey component responsible for fetching object from endpoint
    var Surveys = React.createClass({
      getInitialState: function() {
        return {
          allSurveyData: []
        };
      },

      componentDidMount: function() {
        this._getSurveyData();
      },

      _getSurveyData: function() {
        $.get('/surveys',function(data) {
          this.setState({ allSurveyData: data });
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
                    Your Averages
                  </div>
                </div>
                <div className="panel-body text-center">
                  <SurveyGraph
                   survey={this.state.allSurveyData}
                  />
                  <p>The more daily surveys you take, the more insightful these averages will become.</p>
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
        var ctx = document.getElementById("survey-chart-average");
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
            <canvas className="img-responsive center-block" id={"survey-chart-average"} width="320" height="275"></canvas>
          </div>
        );
      }
    });

    ReactDOM.render(
      <Surveys />,
      document.getElementById('surveys-container')
    );
  </script>
@endsection
