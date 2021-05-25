@extends('layouts.app')
@section('content')

    <div class="container">
        @include('inc.navbar')
        @include('inc.message')
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3>{{$subject->name}}</h3>
                </div>
            </div>
            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <div class="container-fluid">
                        <h1>Created Quiz</h1>
                        <div class="col-md-9 mx-auto">
                            <form action="{{ route('teacherquiz.store',$subject->id )}}" method="POST">
                               @csrf
                                <div class="form-group row">
                                    <label for="note" class="col-sm-3 col-form-label">Note: </label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="note" required value="{{@old('note')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Time Limit</label>
                                    <div class="col-sm-9">
                                        <input type="time" id="appt" name="appt" min="09:00" max="18:00" required class="form-control" placeholder="HH:MM" value="{{@old('appt')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleFormControlSelect2" class="col-sm-3 col-form-label">Attempts Allowed</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="attempt">
                                            <option @if(old('attempt') == 1) selected @endif>1</option>
                                            <option @if(old('attempt') == 2) selected @endif>2</option>
                                            <option @if(old('attempt') == 3) selected @endif>3</option>
                                            <option @if(old('attempt') == 4) selected @endif>4</option>
                                            <option @if(old('attempt') == 5) selected @endif>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="available-on " class="col-sm-3 col-form-label ">Available on: </label>
                                    <div class="col-sm-9 ">
                                        <div class='input-group' id='datetimepicker1'>
                                            <input type="text" name="AvOn" data-field="datetime" class="date form-control" {{-- id="availableOn" --}} readonly placeholder="DD/MM/YYYY" />
                                            <div id="availableOn"></div>
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="available-until" class="col-sm-3 col-form-label">Available until: </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="AvUntil" data-field="datetime" class="date form-control" id="avUntil" readonly placeholder="DD/MM/YYYY" />
                                        <div id="availableUntil"></div>
                                        <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="row my-5">
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class=" btn btn-primary button-quiz text-capitalize" name="submit" value="submit">Create</button>
                                    </div>
                                </div> 
                                <input type="hidden" name="subject" value="{{$subject->id}}">
                                                            
                            </form>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/datetimepicker.js') }}" defer></script>
@endsection

