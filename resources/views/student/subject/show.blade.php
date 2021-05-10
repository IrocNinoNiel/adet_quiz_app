@extends('layouts.app')
@section('content')


    <div class="container text-left">
        @include('inc.navbar')
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3 class="text-center">{{$subject->name}}</h3>
                    <div class="container bg-light-green mt-5 card">
                        <h5 class="text-center font-weight-bold m-2">Course Description</h5>
                        <p class="mb-4">{{$subject->description}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <h3 class=" pb-2">Ongoing Quizzes</h3>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 my-3">
                                <button type="button" id="modal-btn" class="btn btn-success text-light pl-5 pr-5">FL-Quiz-4</button>
                            </div> 
                        </div>
                    </div>
                    <h3 class="py-2">Closed Quizzes</h3>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 my-3">
                                    <button type="button" id="modal-btn" class="btn btn-success text-light pl-5 pr-5">FL-Quiz-4</button>
                                </div> 
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection