@extends('layouts.app')
@section('content')


    <div class="container text-left">
        @include('inc.navbar')
        @include('inc.message')
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="col-md-12">
                    <a href="#" class="btn"><h4>{{$subject->name}}</h4></a>
                    <div class="container mt-3 mb-3">
                        <h2>{{$subject->code}}</h2>
                    </div>
                    <div class="text-center bg-success">
                        <a href="{{ route('teacherquiz.create',$subject->id )}}" type="button" class="text-light btn">+ Create</a>
                    </div>
                    <div class="col-lg-12 bg-light-green my-4">
                        <div class="dropdown show ">
                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Drafts
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @if (count($subject->drafts) > 0)
                                    @foreach ($subject->drafts as $draft)
                                        @if($draft->status == 1)
                                            <a class="dropdown-item" href="{{ route('teacherquiz.draftpage',['subid'=>$subject->id,'id'=>$draft->id] )}}">{{$draft->title ?? 'no title'}} </a>
                                        @endif
                                    @endforeach 
                                @endif
                            </div>
                        </div>
                    </div> 
                    
                </div>
                
            </div>
            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <h3 class=" pb-2">Upcoming Quizzes</h3>
                    <div class="container">
                        <div class="row">
                            @foreach ($subject->quiz as $quiz)
                                <br>
                                @if(date('Y-m-d H:i:s') < $quiz->end_date && date('Y-m-d H:i:s') < $quiz->start_date )
                                    <div class="col-md-4 my-3">
                                        <a href="{{route('teacherquiz.show',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" class="btn btn-success text-light pl-5 pr-5">{{$quiz->title}}</a>
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
                                        <a href="{{route('teacherquiz.show',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" class="btn btn-success text-light pl-5 pr-5">{{$quiz->title}}</a>
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
                                        <a href="{{route('teacherquiz.show',['subid'=>$subject->id,'quizid'=>$quiz->id] )}}" class="btn btn-success text-light pl-5 pr-5">{{$quiz->title}}</a>
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