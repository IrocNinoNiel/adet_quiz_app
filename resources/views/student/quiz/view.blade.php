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
                            <p><span class="font-weight-bold">Submitted: </span>{{$attempt->created_at}}</p>
                            <p><span class="font-weight-bold">Time Taken: </span>{{$finish->created_at->diffForHumans($attempt->created_at,true)}}</p>
                            
                        </div>
                        
                        <div class="container text-center mb-3 mt-5">
                            @if ($quiz->can_see_points == 1)
                                <a href="{{ route('studentquiz.score',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" type="button" class="btn btn-success">View Score</a>
                            @endif
                        </div>
                        
                        <div class="container text-center">
                            <a href="{{route('studentsubject.show',$subject->id)}}" type="button" class="btn btn-warning">Done</a>
                        </div>
                </div>    
                
            </div>
        </div>
    </div>
@endsection