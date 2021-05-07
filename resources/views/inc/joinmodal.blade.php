<div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="joinModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="quizLabel">Join Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('studentsubject.join')}}" method="POST" name="codeForm" id="codeForm">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                <label for="subjectCode" class="col-form-label">Enter Code:</label>
                <input type="text" class="form-control" id="subjectCode" name="subjectCode" value="{{old('subjectCode')}}">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="submitQuiz">Enter Code</button>
            </div>
        </form>
      </div>
    </div>
</div>