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
                            <div id="timer" data-timer="{{\Carbon\Carbon::now()->diffInSeconds($timer)}}" ></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <div class="container-fluid">
                        <h1>{{$quiz->title}}</h1>
                        <form action="{{ route('studentquiz.submit',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" method="POST" id="formQuiz">
                            @csrf
                            @foreach ($quiz->question as $question)
                                <div class="container p-3 ml-4 container-question">   
                                    <ul class="list-inline">
                                            <input type="hidden" name="question[]" value={{$question->id}}>
                                            <li class="list-inline-item">{{$loop->iteration}}. {{$question->description}}?</li>
                                            @if($quiz->can_see_points == 1)
                                                <li class="list-inline-item text-secondary ml-8">{{$question->points}} points</li>
                                            @endif
                                    </ul>
                                    <div class="container">
                                        @foreach ($question->answer as $answer)
                                            <div class="custom-control custom-radio">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <input type="radio" name="answer[{{$loop->parent->iteration}}]" value={{$answer->id}}>  
                                                    </div>
                                                    <p class="ml-3">{{$answer->description}}</p>
                                                </div> 
                                            </div>
                                        @endforeach
                                    </div>   
                                </div>
                            @endforeach
                            <div class="text-right">
                                <button type="submit" class="btn btn-success" data-subid="{{$subject->id}}" data-quizid="{{$quiz->id}}" id="subQuiz">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>    
                
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>

        const btn = document.querySelector('#subQuiz');
        btn.onclick = function (e) {
            e.preventDefault();
            // const rbs = document.querySelectorAll('input[name="choice"]');
            const formQuiz = document.getElementById('formQuiz');
            // console.log(formQuiz);
            const containerQuestion = document.getElementsByClassName('container-question');
            let allQuestionAnswer = true;
            for(let i = 0; i<containerQuestion.length; i++){
                const optionName = containerQuestion[i].lastElementChild.firstElementChild.firstElementChild.firstElementChild.firstElementChild.name;
                const optionCheck = document.querySelectorAll(`input[name="${optionName}"]`);
                let isCheckOption = false;
                for(let x = 0; x<optionCheck.length;x++){
                    if(optionCheck[x].checked){
                        isCheckOption = true
                    }
                }

                if(!isCheckOption){
                    console.log(containerQuestion[i])
                    containerQuestion[i].classList.add('border');
                    containerQuestion[i].classList.add('border-danger');

                    allQuestionAnswer = false;
                }else{
                    containerQuestion[i].classList.remove('border');
                    containerQuestion[i].classList.remove('border-danger');
                }  
            }          
            if(allQuestionAnswer){
                formQuiz.submit();
            }else{
                alert('Please Answer All Question before submit')
            }

        };


        const timer = document.getElementById('timer').getAttribute('data-timer');
        console.log(timer);
        
        var sec = timer,
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
                    alert('Time is Up!!');

                    document.getElementById('formQuiz').submit();
                    
                }
            }
    </script>
@endsection