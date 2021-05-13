@extends('layouts.app')
@section('content')
    <div class="container">

        @include('inc.navbar')
        
        <div id="message">

        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3>{{$quiz->subject->name}}</h3>
                </div>
            </div>
            <div class="col-md-9 border-left">
                
                <div class="container-fluid">
                    <h2>@if (date('Y-m-d H:i:s') < $quiz->end_date)
                        OPEN
                    @else
                        CLOSE
                    @endif > {{$quiz->title}}</h2>
                    <hr/>
                    <br/>

                    <div class="row mb-5">
                        <div class="col-sm-6 text-center ">
                                <button class="btn font-weight-bold" id="quiz">Quiz</button>
                        </div>
                    
                        <div class="col-sm-6 text-center ">
                            <button class="btn font-weight-bold" id="response">Response</button>
                        </div>
                    </div>
                    
                    <div class="container" id="quizinterface">
                        @foreach ($quiz->question as $question)
                            <div class="container p-3 ml-4">   
                                <ul class="list-inline">
                                    <li class="list-inline-item">{{$loop->iteration}}. {{$question->description}}</li>
                                    <li class="list-inline-item text-secondary ml-8">{{$question->points}} points</li>
                                </ul>

                                @foreach ($question->answer as $answer)
                                    <div class="container">
                                        <div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <input type="checkbox" @if($answer->is_right == 1) checked @endif disabled>  
                                                </div>
                                                <p class="ml-3">{{$answer->description}}</p>
                                            </div> 
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="container" id="responseinterface">
                        <table class="table">
                            <thead class="thead bg-success">
                                <tr>
                                    <th scope="col" colspan="2">Name</th>
                                    <th scope="col">Score(15)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">Mark</td>
                                    <td>15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

   <script>
       $(document).ready(function(){

            $("#responseinterface").hide();
            $("#quizinterface").hide();

            $("#quiz").click(function(){
                $('#quiz').addClass('border-bottom');
                $('#response').removeClass('border-bottom');
                $("#responseinterface").hide();
                $("#quizinterface").show();
            });

            $("#response").click(function(){
                $('#quiz').removeClass('border-bottom');
                $('#response').addClass('border-bottom');
                $("#responseinterface").show();
                $("#quizinterface").hide();
            });
       
        });
   </script>

@endsection