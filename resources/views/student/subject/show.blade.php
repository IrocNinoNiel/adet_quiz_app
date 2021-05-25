@extends('layouts.app')
@section('content')


    <div class="container text-left">
        @include('inc.navbar')
        @include('inc.message')
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="col-md-12">
                    <a href="{{ route('studentsubject.show',$subject->id)}}" class="btn"><h3>{{$subject->name}}</h3></a>
                    <div class="container bg-light-green mt-5 card">
                        <h5 class="text-center font-weight-bold m-2">Course Description</h5>
                        <p class="mb-4">{{$subject->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <h3 class=" pb-2">Upcoming Quizzes</h3>
                    <div class="container">
                        <div class="row">
                            @foreach ($subject->quiz as $quiz)
                                @if(date('Y-m-d H:i:s') < $quiz->end_date && date('Y-m-d H:i:s') < $quiz->start_date )
                                 
                                    <div class="col-md-4 my-3">
                                        <button class="btn btn-success text-light pl-5 pr-5" disabled>{{$quiz->title}}</button>
                                    </div> 
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <h3 class=" pb-2">Ongoing Quizzes</h3>
                    <div class="container">
                        <div class="row">
                            @foreach ($subject->quiz as $quiz)
                                @if(date('Y-m-d H:i:s') < $quiz->end_date && date('Y-m-d H:i:s') >= $quiz->start_date )
                                    <div class="col-md-4 my-3">
                                        <a href="{{route('studentquiz.index',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" class="btn btn-success text-light pl-5 pr-5">{{$quiz->title}}</a>
                                    </div> 
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <h3 class="py-2">Closed Quizzes</h3>
                    <div class="container">
                        <div class="row">
                            @foreach ($subject->quiz as $quiz)
                                @if(date('Y-m-d H:i:s') > $quiz->end_date)
                                    <div class="col-md-4 my-3">
                                        <a href="{{route('studentquiz.viewscore',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" class="btn btn-success text-light pl-5 pr-5">{{$quiz->title}}</a>
                                    </div> 
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection