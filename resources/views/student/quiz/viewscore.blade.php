@extends('layouts.app')
@section('content')

    <div class="container">
        @include('inc.navbar')
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <a href="{{ route('studentsubject.show',$subject->id)}}" class="btn"><h3>{{$subject->name}}</h3></a>
                    <div class="container m-3 text-center">
                        <div class="container-fluid bg-dark-green text-light my-4"><h4 class="">Quiz-FL-4</h4></div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <div class="container-fluid">
                        <h1>View Score</h1>
                        <div class="container p-3 ml-4">
                            <div class="bg-light-green p-2">
                                <h3 class="font-weight-bold">FL_QUIZ_4</h3>
                                <h3>Total Score: {{$arrTotal->sum('points')}}/{{$quiz->total->sum('points')}}</h3>
                            </div>   

                            @if ($quiz->can_see_answer == 1)
                                @foreach ($quiz->question as $question)
                                    <ul class="list-inline">
                                        <li class="list-inline-item">{{$loop->iteration}}. {{$question->description}}?</li>
                                        <li class="list-inline-item text-secondary ml-8">@if($quiz->can_see_points == 1) {{$arrAnswer[$loop->index]['points']}}/{{$question->points}}@endif</li>
                                    </ul>
                                    <div class="container">
                                        @if(date('Y-m-d H:i:s') > $quiz->end_date || count($num_of_attempt) == $quiz->num_of_attempt)
                                            @foreach ($question->answer as $answer)
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio{{$answer->id}}" name="customRadio" class="custom-control-input">
                                                    @if($arrAnswer[$loop->parent->index]['answer_id'] == $answer->id || $answer->is_right == 1) 
                                                        <label class="custom-control-label @if($answer->is_right == 1) bg-success @else bg-danger @endif" for="customRadio1{{$answer->id}}">{{$answer->description}}</label>
                                                    
                                                    @else
                                                        <label class="custom-control-label " for="customRadio1{{$answer->id}}">{{$answer->description}}</label>    
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($question->answer as $answer)
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio{{$answer->id}}" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label " for="customRadio1{{$answer->id}}">{{$answer->description}}</label>   
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        <div class="container text-center">
                            <a href="{{route('studentsubject.show',$subject->id)}}" type="button" class="btn btn-warning">Done</a>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection