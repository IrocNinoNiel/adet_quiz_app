@extends('layouts.app')
@section('content')

    <div class="container">
        @include('inc.navbar')
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3>{{$subject->name}}</h3>
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
                            <p><span class="font-weight-bold">Attempts Allowed: </span> {{$quiz->num_of_attempt}}</p>
                            <p><span class="font-weight-bold">Due Date: </span>{{\Carbon\Carbon::parse($quiz->end_date)->format('M d, Y, D, h:m')}}</p>
                        </div>
                        
                        <form action="/answerquiz">
                            <div class="container my-3 text-center">
                                <button type="submit" class="btn btn-success">Answer Quiz</button>   
                            </div >
                        </form>
                        
                        <div class="container text-center">
                            <a href="{{route('studentsubject.show',$subject->id)}}" type="button" class="btn btn-warning">Cancel</a>
                        </div>
                </div>    
                
            </div>
        </div>
    </div>
@endsection