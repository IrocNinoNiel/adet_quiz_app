@extends('layouts.app')

@section('content')

<div class="container">

    @include('inc.navbar')
    @include('inc.message')

    <div class="d-flex bd-highlight mt-5">
        <div class="p-2 w-100 bd-highlight">
            <h1>Subject</h1>
        </div>
        <div class="p-2 flex-shrink-1 bd-highlight">
            @if(Auth::user()->user_type->name == "student")
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#joinModal">Join Subject</button>
            @else
                <a href="{{ route('teachersubject.create') }}" class="btn btn-primary">Add Subject</a>
            @endif
        </div>
    </div>
    <div class="container-fluid">
        <div class="container-scroll" id="style-1">
            <div class="row">
                @if(count(Auth::user()->subject) > 0)
                    @foreach(Auth::user()->subject as $subject)
                        <div class="col-md-4 ">
                            <div class="col-md-12 text-center pt-2 bg-gray text-dark">
                                <a href="{{ route('teachersubject.show',$subject->id )}}"><img class="img-thumbnail" src="https://www.planetware.com/wpimages/2020/02/france-in-pictures-beautiful-places-to-photograph-eiffel-tower.jpg" alt=""></a>
                                <h5 class="mt-2">{{$subject->name}}</h5>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach(Auth::user()->member as $member)
                        <div class="col-md-4 ">
                            <div class="col-md-12 text-center pt-2 bg-gray text-dark">
                                <a href="{{ route('studentsubject.show',$member->subject->id)}}"><img class="img-thumbnail" src="https://www.planetware.com/wpimages/2020/02/france-in-pictures-beautiful-places-to-photograph-eiffel-tower.jpg" alt=""></a>
                                <h5 class="mt-2">{{$member->subject->name}}</h5>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
        </div>                    
    </div>   
</div>

@include('inc.joinmodal')

@endsection
