var containerForm = document.getElementById('container-form');
var add = document.getElementById('addQuestion');

add.addEventListener('click', questionForm);
containerForm.addEventListener('click', quizForm);

function questionForm(e){
  e.preventDefault();

  var divQB = document.createElement('div');
  divQB.className = 'question-box container bg-white p-3 my-3 border border-secondary rounded';
  divQB.id = "questionBox"
  // 
  // <div class="text-right" id="times">
  //   <button class="fa fa-times text-secondary text-decoration-none delete-question">X</button>
  // </div>
  var times = document.createElement('div');
  times.className = 'text-right'
  times.id = "times"

  var btnDel = document.createElement('button');
  btnDel.className = 'fa fa-times text-secondary text-decoration-none delete-question'
  btnDel.htmlFor = "X"

  times.appendChild(btnDel);
  divQB.appendChild(times);


  // 
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

  var contPoints = document.getElementById('containerPoints');
  divQB.appendChild(contPoints.cloneNode(true));
  
  var divOpt = document.createElement('div');
  divOpt.className = 'container text-center py-3';
  divOpt.id = "option-container";
         
  var h6 = document.createElement('h6');
  h6.className = "text-left";
  h6.appendChild(document.createTextNode('Select for correct answer'));
  divOpt.appendChild(h6);

  var table = document.createElement('table');
  table.className = "table my-2 table-borderless";

  divOpt.appendChild(table);

  var tbody = document.createElement("tbody");
  
  var optionLength = document.getElementsByClassName('chkbox');
  
  /* Options */
    /* Option 1 */
  var tr1 = document.createElement("tr");
  
  var tdRB1 = document.createElement("td");
  tdRB1.className = "align-middle";
  var tdInput1 = document.createElement("td");
  tdInput1.className = "align-middle";
  
  tr1.appendChild(tdRB1);
  tr1.appendChild(tdInput1);

  var hidden1 = document.createElement('input');
  hidden1.setAttribute("type", "hidden");
  hidden1.setAttribute('name', "ischeck["+(optionLength.length+1)+"]");
  hidden1.setAttribute('value', '0');
  hidden1.className = "chkboxhidden"

  var radioBut1 = document.createElement('input');
  radioBut1.setAttribute("type", "checkbox");
  radioBut1.setAttribute('name', "ischeck["+(optionLength.length+1)+"]");
  radioBut1.setAttribute('value', '1');
  radioBut1.setAttribute('checked','true');
  radioBut1.className = 'chkbox';

  var inputOpt1 = document.createElement('input');
  inputOpt1.setAttribute("type", "text");
  inputOpt1.setAttribute("name", 'option[]');
  inputOpt1.setAttribute("placeholder", "Option 1");
  inputOpt1.className = "form-control questionOption";

  tdRB1.appendChild(hidden1);
  tdRB1.appendChild(radioBut1);
  tdInput1.appendChild(inputOpt1);
      
    /* Option 2 */
  var tr2 = document.createElement("tr");

  var tdRB2 = document.createElement("td");
  tdRB2.className = "align-middle";
  var tdInput2 = document.createElement("td");
  tdInput2.className = "align-middle";
  
  tr2.appendChild(tdRB2);
  tr2.appendChild(tdInput2);

  var hidden2 = document.createElement('input');
  hidden2.setAttribute("type", "hidden");
  hidden2.setAttribute('name', "ischeck["+(optionLength.length+2)+"]");
  hidden2.setAttribute('value', '0');
  hidden2.className = "chkboxhidden"

  var radioBut2 = document.createElement('input');
  radioBut2.setAttribute("type", "checkbox");
  radioBut2.setAttribute('name', "ischeck["+(optionLength.length+2)+"]");
  radioBut2.setAttribute('value', '1');
  radioBut2.className = 'chkbox';

  var inputOpt2 = document.createElement('input');
  inputOpt2.setAttribute("type", "text");
  inputOpt2.setAttribute("name", 'option[]');
  inputOpt2.setAttribute("placeholder", "Option 2");
  inputOpt2.className = "form-control questionOption";

  tdRB2.appendChild(hidden2);
  tdRB2.appendChild(radioBut2);
  tdInput2.appendChild(inputOpt2);

  /* Option 3 */
  var tr3 = document.createElement("tr");

  var tdRB3 = document.createElement("td");
  tdRB3.className = "align-middle";
  var tdInput3 = document.createElement("td");
  tdInput3.className = "align-middle";

  var hidden3 = document.createElement('input');
  hidden3.setAttribute("type", "hidden");
  hidden3.setAttribute('name', "ischeck["+(optionLength.length+3)+"]");
  hidden3.setAttribute('value', '0');
  hidden3.className = "chkboxhidden"
  
  tr3.appendChild(tdRB3);
  tr3.appendChild(tdInput3);
  var radioBut3 = document.createElement('input');
  radioBut3.setAttribute("type", "checkbox");
  radioBut3.setAttribute('name', "ischeck["+(optionLength.length+3)+"]");
  radioBut3.setAttribute('value', '1');
  radioBut3.className = 'chkbox';

  var inputOpt3 = document.createElement('input');
  inputOpt3.setAttribute("type", "text");
  inputOpt3.setAttribute("name", 'option[]');
  inputOpt3.setAttribute("placeholder", "Option 3");
  inputOpt3.className = "form-control questionOption";

  tdRB3.appendChild(hidden3);
  tdRB3.appendChild(radioBut3);
  tdInput3.appendChild(inputOpt3);

  /* Option 4 */
  var tr4 = document.createElement("tr");

  var tdRB4 = document.createElement("td");
  tdRB4.className = "align-middle";
  var tdInput4 = document.createElement("td");
  tdInput4.className = "align-middle";
  
  tr4.appendChild(tdRB4);
  tr4.appendChild(tdInput4);

  var hidden4 = document.createElement('input');
  hidden4.setAttribute("type", "hidden");
  hidden4.setAttribute('name', "ischeck["+(optionLength.length+4)+"]");
  hidden4.setAttribute('value', '0');
  hidden4.className = "chkboxhidden"

  var radioBut4 = document.createElement('input');
  radioBut4.setAttribute("type", "checkbox");
  radioBut4.setAttribute('name', "ischeck["+(optionLength.length+4)+"]");
  radioBut4.setAttribute('value', '1');
  radioBut4.className = 'chkbox';

  var inputOpt4 = document.createElement('input');
  inputOpt4.setAttribute("type", "text");
  inputOpt4.setAttribute("name", 'option[]');
  inputOpt4.setAttribute("placeholder", "Option 4");
  inputOpt4.className = "form-control questionOption";

  tdRB4.appendChild(hidden4);
  tdRB4.appendChild(radioBut4);
  tdInput4.appendChild(inputOpt4);
  
  tbody.appendChild(tr1); 
  tbody.appendChild(tr2);
  tbody.appendChild(tr3);
  tbody.appendChild(tr4);
  /* Options */
  
  table.appendChild(tbody);

  divQB.appendChild( divOpt);
    

  containerForm.appendChild(divQB);
  
  console.log(containerForm);
 
}


function quizForm(e){
  
  if(e.target.classList.contains('delete-question')){
    var container =  e.target.parentElement.parentElement.parentElement; 
    var qB = e.target.parentElement.parentElement;

    console.log(container);
    console.log(qB);

    container.removeChild(qB);
  }
  
}
