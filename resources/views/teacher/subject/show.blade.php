@extends('layouts.app')
@section('content')


    <div class="container text-left">
        @include('inc.navbar')
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h4>{{$subject->name}}</h4>
                    <div class="text-center bg-success">
                        <a href="{{ route('teacherquiz.create',$subject->id )}}" type="button" class="text-light btn">+ Create</a>
                    </div>
                    <div class="col-lg-12 bg-light-green my-4">
                        <div class="dropdown show ">
                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Drafts
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="#">Quiz-2</a>
                              <a class="dropdown-item" href="#">Quiz-4</a>
                              <a class="dropdown-item" href="#">Semi-Final</a>
                            </div>
                        </div>
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
                                    <button type="button" class="btn btn-success text-light pl-5 pr-5">FL-Quiz-4</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection