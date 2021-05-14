@extends('layouts.app')
@section('content')

    <div class="container">
        @include('inc.navbar')
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3>{{$subject->name}}</h3>
                    <div class="container m-3 text-center">
                        <h6 class="">Time Remaining</h6>
                        <div class="count">
                            <div id="timer" data-timer="{{$quiz->time_limit}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <div class="container-fluid">
                        <h1>{{$quiz->title}}</h1>
                        <form action="{{ route('studentquiz.submit',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" method="POST">
                            @csrf
                            @foreach ($quiz->question as $question)
                                <div class="container p-3 ml-4">   
                                    <ul class="list-inline">
                                            <input type="hidden" name="question[]" value={{$question->id}}>
                                            <li class="list-inline-item">{{$loop->iteration}}. {{$question->description}}?</li>
                                            <li class="list-inline-item text-secondary ml-8">{{$question->points}} points</li>
                                    </ul>
                                    <div class="container">
                                        @foreach ($question->answer as $answer)
                                            <div class="custom-control custom-radio">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <input type="radio" name="answer[{{$loop->parent->iteration}}]" value={{$answer->id}} required>  
                                                    </div>
                                                    <p class="ml-3">{{$answer->description}}</p>
                                                </div> 
                                            </div>
                                        @endforeach
                                    </div>   
                                </div>
                            @endforeach
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>    
                
            </div>
        </div>
    </div>
    <script>
        const timer = document.getElementById('timer').getAttribute('data-timer');
        
        var sec = timer*60,
            countDiv = document.getElementById("timer"),
            secpass,
            countDown = setInterval(function () {
                'use strict';
                
                secpass();
            }, 1000);


            function secpass() {
                'use strict';
                
                var min = Math.floor(sec / 60),
                    remSec = sec % 60;
                
                if (remSec < 10) {
                    remSec = '0' + remSec;
                }
                if (min < 10) {
                    min = '0' + min;
                }
                countDiv.innerHTML = min + " minutes:" + remSec+" seconds";
                
                if (sec > 0) {
                    sec = sec - 1;
                } else {     
                    clearInterval(countDown);
                    countDiv.innerHTML = 'countdown done';
                }
            }
    </script>
@endsection