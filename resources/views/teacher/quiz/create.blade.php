@extends('layouts.app')
@section('content')

    @include('inc.navbar')
    <form id="quiz-title" action="{{ route('teacherquiz.created',$subject->id )}}" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3>3R4-FL-Mandarin</h3>
                    <div class="container bg-light-greenapple my-1 py-1 px-3">
                        <h5 class="font-weight-bold">Quiz option</h5>
                        <div class="my-3"> 
                            <h6>Release Remark</h6>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="remark1" name="customRadio" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="remark1">Immediately after Submission</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="remark2" name="customRadio" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="remark2">Later After Submission</label>
                                </div>
                        </div>
                        <div class="my-3"> 
                            <h6>Student can see</h6>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="correctAnswer" name='checkboxQuiz[]' value="1">
                                <label class="custom-control-label" for="correctAnswer">Correct Answer</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="pointsValue" name='checkboxQuiz[]' value="1">
                                <label class="custom-control-label" for="pointsValue">Points Value</label>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="col-md-9 border-left">
                <div class="container-scroll" id="style-1">
                    <div class="">
                        <div class="container my-4">
                            <div class="container">
                                <div class="question-box container bg-white p-3 border border-secondary rounded">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="quizTitle" name="quizTitle" value="{{old('quizTitle')}}" placeholder="Quiz Title">
                                        </div>

                                        <div class="form-group">
                                            <textarea name="quizDescription" id="quizDescription" cols="30" rows="5" type="text" class="form-control" placeholder="Quiz Description">{{old('quizDescription')}}</textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="container my-4">
                            <div class="container">
                                    <div id="container-form">
                                        <div class="text-right py-2">
                                            <button type="button" class="btn btn-success" id="addQuestion">Add Question</button>
                                        </div>
                                        <div class="question-box container bg-white p-3 border border-secondary rounded" id="questionBox">
                                            <label for="question" class="form-label">Question: </label>
                                            <input type="text" name="question[]" placeholder="Enter Question" class="form-control" />
                                            
                                            <div class=" container text-center py-3" id="option-container">
                                                <table class="table my-2 table-borderless" >
                                                    <tbody id="table-option">
                                                      <tr>
                                                        <td class="align-middle"><input type="text" name="option[]" placeholder="Option" class="form-control" /></td>
                                                        <td class="align-middle"> <a class="fa fa-times text-secondary text-decoration-none delete" role="button" id=""></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td><a class="addOption text-decoration-none " role="button" id="add-option">+ Add Option</a></td>
                                                      </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                                <button type="button" class="btn btn-danger float-right delete-question">Delete</button>
                                            
                                        </div>
                                    </div>
                                    <div class="row my-5">
                                        <div class="col-md-6">        
                                            <button type="submit" class="button-quiz text-capitalize" name="save" value ="save">Save</button>  
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="button-quiz text-capitalize" name="submit" value="submit">Create</button>
                                        </div>
                                    </div>
                            </div>  
                        </div>
                    </div>
                </div>    
                
            </div>
        </div>
    </div>
    </form>
    <script src="{{ asset('js/createquiz.js') }}" defer></script>
@endsection