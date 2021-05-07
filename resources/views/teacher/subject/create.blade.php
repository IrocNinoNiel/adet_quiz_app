@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="quizLabel">New Section </h5>
                <a href="{{ url('/home') }}" type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <form action="{{route('teachersubject.store')}}" method="POST">
                  @csrf
                  <div class="modal-body">
                      <div class="form-group">
                      <label for="subjectName" class="col-form-label">Subject Name:</label>
                      <input type="text" class="form-control" id="subjectName" name="subjectName" value="{{old('subjectName')}}">
                      </div>
                      <div class="form-group">
                          <label for="subjectDsc" class="col-form-label">Subject Description:</label>
                          <textarea class="form-control" id="subjectDsc" name="subjectDsc" rows="5">{{old('subjectDsc')}}</textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Create Section</button>
                  </div>
              </form>
            </div>
          </div>
    </div>

    
@endsection