@extends('layouts.app')
@section('content')

    <div class="container">
        @include('inc.navbar')
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <a href="{{ route('studentsubject.show',$subject->id)}}" class="btn"><h3>{{$subject->name}}</h3></a>
                    <div class="container bg-light-green m-3">
                        <h6 class="text-center">Course Description</h6>
                        <p>{{$subject->description}}</p>
                    </div>
                </div>
                
            </div>
            <div class="col-md-9 border-left ">
                <div class="container-scroll" id="style-1">
                    <h1>{{$quiz->title}}</h1>
                    <div class="w-50 mx-auto">
                        <p><span class="font-weight-bold">Note: </span> {{$quiz->note}}</p>
                        <p><span class="font-weight-bold">Time Limit: </span> {{floor($quiz->time_limit/60)}} Hours {{$quiz->time_limit%60}} minutes</p>
                        <p><span class="font-weight-bold">Items: </span> {{count($quiz->question)}}</p>
                        <p><span class="font-weight-bold">Attempts Allowed: </span> @if($quiz->num_of_attempt - count($quiz->attempt)<= 0) 0  @else {{$quiz->num_of_attempt - count($quiz->attempt)}}  @endif Attempts remaining</p>
                        <p><span class="font-weight-bold">Due Date: </span>{{\Carbon\Carbon::parse($quiz->end_date)->format('M d, Y, D, h:m')}}</p>
                    </div>  

                    {{-- <div class="container text-center mb-4">
                        <a href="{{route('studentquiz.answer',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" type="button" class="btn btn-primary">Attempt Quiz</a>
                    </div> --}}

                    @if(count($quiz->attempt) < $quiz->num_of_attempt)
                        <div class="container text-center mb-4">
                            <a href="{{route('studentquiz.answer',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" type="button" class="btn btn-primary">Attempt Quiz</a>
                        </div>
                    @else
                    <div class="container text-center mb-4">
                        <button class="btn btn-danger" disabled>Attempt is Over</button>
                    </div>
                    @endif

                    <div class="container text-center">
                        <a href="{{route('studentsubject.show',$subject->id)}}" type="button" class="btn btn-warning">Cancel</a>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection
