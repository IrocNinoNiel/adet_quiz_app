var containerForm = document.getElementById('container-form');
var add = document.getElementById('addQuestion');


add.addEventListener('click', questionForm);
containerForm.addEventListener('click', quizForm);

function questionForm(e){
  e.preventDefault();

  var divQB = document.createElement('div');
  divQB.className = 'question-box container bg-white p-3 my-4 border border-secondary rounded';
  divQB.id = "questionBox"
  var label =document.createElement('label');
  label.htmlFor = "question";
  label.className = "form-label";
  label.appendChild(document.createTextNode('Question:'));
  divQB.appendChild(label);
  
  var inputQ = document.createElement('input');
  inputQ.className = "form-control";
  inputQ.setAttribute("type", "text");
  inputQ.setAttribute("name", 'question[]');
  inputQ.setAttribute("placeholder", "Enter Question");
  divQB.appendChild(inputQ);

  var divOpt = document.createElement('div');
  divOpt.className = 'container text-center py-3 option-container';
  
  var table = document.createElement('table');
  table.className = "table my-2 table-borderless";

  var tbody = document.createElement("tbody");
  tbody.className = 'table-option'
  table.appendChild(tbody);

  var tr = document.createElement("tr");
  var tr1 = document.createElement("tr");
  var tr2 = document.createElement("tr");
  var tr3 = document.createElement("tr");


  var tdInput = document.createElement("td");
  tdInput.className = "align-middle";

  var tdInput1 = document.createElement("td");
  tdInput1.className = "align-middle";

  var tdInput2 = document.createElement("td");
  tdInput2.className = "align-middle";

  var tdInput3 = document.createElement("td");
  tdInput3.className = "align-middle";


  tr.appendChild(tdInput);
  tr1.appendChild(tdInput1);
  tr2.appendChild(tdInput2);
  tr3.appendChild(tdInput3);
 

  var inputOpt = document.createElement('input');
  inputOpt.className = "form-control";
  inputOpt.setAttribute("type", "text");
  inputOpt.setAttribute("name", 'option[]');
  inputOpt.setAttribute("placeholder", "Option");

  var inputOpt1 = document.createElement('input');
  inputOpt1.className = "form-control";
  inputOpt1.setAttribute("type", "text");
  inputOpt1.setAttribute("name", 'option[]');
  inputOpt1.setAttribute("placeholder", "Option");

  var inputOpt2 = document.createElement('input');
  inputOpt2.className = "form-control";
  inputOpt2.setAttribute("type", "text");
  inputOpt2.setAttribute("name", 'option[]');
  inputOpt2.setAttribute("placeholder", "Option");

  var inputOpt3 = document.createElement('input');
  inputOpt3.className = "form-control";
  inputOpt3.setAttribute("type", "text");
  inputOpt3.setAttribute("name", 'option[]');
  inputOpt3.setAttribute("placeholder", "Option");

  tdInput.appendChild(inputOpt);
  tdInput1.appendChild(inputOpt1);
  tdInput2.appendChild(inputOpt2);
  tdInput3.appendChild(inputOpt3);

  tbody.appendChild(tr);
  tbody.appendChild(tr1);
  tbody.appendChild(tr2);
  tbody.appendChild(tr3);
  
  divOpt.appendChild(table);

  divQB.appendChild( divOpt);
  
  var deleteBtn = document.createElement('button');

  deleteBtn.className = 'btn btn-danger btn-sm float-right delete-question';
  deleteBtn.setAttribute('type', 'button');

  deleteBtn.appendChild(document.createTextNode('Delete'));

  divQB.appendChild(deleteBtn);
  containerForm.appendChild(divQB);

  console.log(containerForm);
}


function quizForm(e){
  
  if(e.target.classList.contains('delete-question')){
    var container =  e.target.parentElement.parentElement; 
    var qB = e.target.parentElement;
    container.removeChild(qB);
  }
  
}