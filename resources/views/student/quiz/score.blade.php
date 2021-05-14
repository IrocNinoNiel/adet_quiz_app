@extends('layouts.app')
@section('content')

    <div class="container">
        @include('inc.navbar')
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3>Foreign Language</h3>
                    <div class="container m-3 text-center">
                        <div class="container-fluid bg-dark-green text-light my-4"><h4 class="">Quiz-FL-4</h4></div>
                        <h6 class="">Submitted on: 08/04/21, 7:00 am</h6>
                        <h6 class="">Time Taken: 17 minutes</h6>
                       
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
                                <h3>Total Score: 30/30</h3>
                            </div>   
                            <ul class="list-inline">
                                    <li class="list-inline-item">1. Question?</li>
                                    <li class="list-inline-item text-secondary ml-8">2/2</li>
                            </ul>

                            <div class="container">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Option 1</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Option 2</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Option 3</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio4">Option 4</label>
                                </div> 
                            </div>   
                        </div>
                        
                        <div class="container text-center">
                            <a href="{{route('studentsubject.show',$subject->id)}}" type="button" class="btn btn-warning">Done</a>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection