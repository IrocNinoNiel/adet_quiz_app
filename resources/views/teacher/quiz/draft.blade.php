@extends('layouts.app')
@section('content')
    <div class="container">
        @include('inc.navbar')
        
        <div id="message">

        </div>

        <form id="quiz-form">
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-12">
                    <h3>{{$subject->name}}</h3>
                    <input type="hidden" name="draftid" value="{{$draft->id}}">
                    <div class="container bg-light-greenapple my-1 py-1 px-3">
                        <h5 class="font-weight-bold">Quiz option</h5>
                        <div class="my-3"> 
                            <h6>Release Remark</h6>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="remark1" name="customRadio" class="custom-control-input" value="1" @if($draft->when_release_remark == 1)  checked @endif>
                                    <label class="custom-control-label" for="remark1">Immediately after Submission</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="remark2" name="customRadio" class="custom-control-input" value="2" @if($draft->when_release_remark == 2)  checked @endif>
                                    <label class="custom-control-label" for="remark2">Later After Submission</label>
                                </div>
                        </div>
                        <div class="my-3"> 
                            <h6>Student can see</h6>
                            
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="correctAnswer" name='checkboxQuiz1' value="1" @if($draft->can_see_answer == 1)  checked @endif>
                                <label class="custom-control-label" for="correctAnswer">Correct Answer</label>
                            </div>
                            
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="pointsValue" name='checkboxQuiz2' value="1" @if($draft->can_see_points == 1)  checked @endif>
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
                                            <input type="text" class="form-control" id="quizTitle" name="quizTitle" value="{{$draft->title}}" placeholder="Quiz Title">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="quizDescription" id="quizDescription" cols="30" rows="5" type="text" class="form-control" placeholder="Quiz Description">{{$draft->description}}</textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="container my-4">
                            <div class="container">
                                <div class="text-right py-2">
                                    <button type="button" class="btn btn-success" id="addQuestion">Add Question</button>
                                </div>
                                    <div id="container-form">
                                        @if (count($draft->question) > 0)
                                            @foreach ($draft->question as $question)
                                                <div class="question-box container bg-white p-3 my-3 border border-secondary rounded" id="questionBox">    
                                                    <label for="question" class="form-label">Question: </label>
                                                    <input type="text" name="question[]" placeholder="Enter Question" value="{{$question->description}}" class="form-control"/>
                                                    
                                                    <div class="form-group row m-3" id="containerPoints">
                                                        <label for="points" class="col-sm-1 col-form-label">Points:</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" class="form-control w-25" value="{{$question->points}}" name="quizPts[]" min="1">
                                                        </div>
                                                    </div>
                                                    <div class=" container text-center py-3" id="option-container">
                                                        <h6 class="text-left">Select for correct answer</h6>
                                                        <table class="table my-2 table-borderless" >
                                                            
                                                            <tbody id="table-option">
                                                                @foreach ($question->answer as $answer)
                                                                    <tr>
                                                                        <td class="align-middle">
                                                                            <input type="hidden" name="ischeck[{{(($loop->parent->index*4)+$loop->iteration)}}]" value="0" class='chkboxhidden'>
                                                                            <input type="checkbox" class='chkbox' name="ischeck[{{(($loop->parent->index*4)+$loop->iteration)}}]" value="1" @if($answer->is_right == 1) checked @endif>
                                                                        </td>
                                                                        <td class="align-middle"><input type="text" name="option[]" placeholder="Option 1" value="{{$answer->description}}" class="form-control questionOption"/></td>
                                                                    </tr>     
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif  
                                    </div>
                                    <div class="row my-5">
                                        <div class="col-md-6">        
                                            <button type="submit" class="button-quiz text-capitalize" name="save" value ="save" id="save" data-id="{{ $subject->id }}" data-draft-id ="{{$draft->id}}" onclick="confirm('Are you sure?')">Save</button>  
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="button-quiz text-capitalize" name="submit" value="submit" id="create" data-id="{{ $subject->id }}">Create</button>
                                        </div>
                                    </div>
                            </div>  
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/createquiz.js') }}" defer></script>

    <script>
        $("#create").click(function(e) {
            e.preventDefault();

            const id = this.getAttribute('data-id');
            var url = "/teacherquiz/"+id+"/created";

            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });


            $.ajax({
                type: "POST",
                url: url,
                data: $("#quiz-form").serialize(), // serializes the form's elements.
                success: function(data)
                {
                    // console.log(data.success); // show response from the php script.

                    if(!data.success){
                       let output = ``;
                       data.msg.forEach(e =>  output += `<div class="alert alert-warning alert-dismissible fade show m-1" role="alert">
                                ${e}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`);
                       
                        document.getElementById('message').innerHTML = output;
                        alert('Something is Wrong');
                        window.location.href = '#';
                    }else{
                        window.location.href = '/teacherquiz/'+id+'/created';
                    }
                },
                error:function(error){
                        console.log(error)
                        alert("Server Error");
                }
            });
        });

        $("#save").click(function(e) {
            e.preventDefault();

            const subid = this.getAttribute('data-id');
            const id = this.getAttribute('data-draft-id');
            var url = "/teacherquiz/"+subid+"/draft/"+id;

            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });


            $.ajax({
                type: "POST",
                url: url,
                data: $("#quiz-form").serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data.success){
                        alert('Draft Saved');
                        window.location.href = '/teachersubject/'+subid;
                    }
                },
                error:function(error){
                        console.log(error)
                        alert("Server Error");
                }
            });
        });
    </script>


@endsection