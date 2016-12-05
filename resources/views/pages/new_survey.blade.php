@extends('app')

@section('content')
  <div id="new-survey-container">
  </div>


  <script type="text/babel">
    // Parent New Survey component responsible for fetching object from endpoint
    // as well as posting completed form
    var NewSurvey = React.createClass({
      getInitialState: function() {
        return {
          survey: [],
          question_1_response: null,
          question_2_response: null,
          question_3_response: null,
          question_4_response: null
        };
      },

      componentWillMount: function() {
        this._getNewSurvey();
      },

      _getNewSurvey: function() {
        $.get('/surveys/new', function(data) {
          this.setState({ survey: data });
        }.bind(this));
      },

      handleRadioClick: function(questionNumber, response) {
        this.setState({[questionNumber]: response});
      },

      handleSurveySubmit: function() {
        $.post('/surveys',
          {
            question_1_response: this.state.question_1_response,
            question_2_response: this.state.question_2_response,
            question_3_response: this.state.question_3_response,
            question_4_response: this.state.question_4_response
          })
          .done(function(data) {
            var loc = window.location;
            window.location = "/daily-surveys/" + data.id;
          });
      },

      render: function() {
        var submitButton
        var question_nums = ['1', '2', '3', '4'];
        var surveyItems = question_nums.map(function(num) {
          return <SurveyQuestion
            key={num}
            survey={this.state.survey}
            question_num={num}
            onRadioClick={this.handleRadioClick}
          />
        }.bind(this));
        if(this.state.question_1_response && this.state.question_2_response && this.state.question_3_response && this.state.question_4_response){
          submitButton = <button className='btn btn-primary btn-lg btn-block' onClick={this.handleSurveySubmit}> Submit </button>;
        }

        return (
          <div>
            {surveyItems}
            <div className="row">
              <div className="col-md-4" />
              <div className="col-md-4 text-center">
                {submitButton}
              </div>
              <div className="col-md-4" />
            </div>
          </div>
        );
        }
    });

    // New Survey Question component programmatically generated with question text
    var SurveyQuestion = React.createClass({
      getInitialState: function() {
        return {
        };
      },

      radioClick: function(e) {
        var questionNumber = e.target.name;
        var selection = e.target.value;
        this.props.onRadioClick(questionNumber, selection);
      },

      render: function() {
        var questionText = "question_" + this.props.question_num;
        return(
          <div>
            <div className="row">
              <div className="col-md-4" />
              <div className="col-md-4 text-center">
                <div className="panel panel-default">
                  <div className="panel-heading">
                    <div className="panel-title">
                      {this.props.survey[questionText]}
                    </div>
                  </div>
                  <div className="panel-body">
                    <div className="control-group">
                      <label className="radio-inline">
                        <input type="radio" name={"question_"+ this.props.question_num +"_response"} onClick={this.radioClick} value="1" /> 1
                      </label>
                      <label className="radio-inline">
                        <input type="radio" name={"question_"+ this.props.question_num +"_response"} onClick={this.radioClick} value="2" /> 2
                      </label>
                      <label className="radio-inline">
                        <input type="radio" name={"question_"+ this.props.question_num +"_response"} onClick={this.radioClick} value="3" /> 3
                      </label>
                      <label className="radio-inline">
                        <input type="radio" name={"question_"+ this.props.question_num +"_response"} onClick={this.radioClick} value="4" /> 4
                      </label>
                      <label className="radio-inline">
                        <input type="radio" name={"question_"+ this.props.question_num +"_response"} onClick={this.radioClick} value="5" /> 5
                      </label>
                    </div>
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
      <NewSurvey />,
      document.getElementById('new-survey-container')
    );
  </script>
@endsection
