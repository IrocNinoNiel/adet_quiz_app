var add = document.getElementById('addQuestion');
var containerForm = document.getElementById('container-form');
var addOption = document.getElementById('add-option');
var optionContainer = document.getElementById('option-container');
var tableOption = document.getElementById('table-option');
var questionBox = document.getElementById('questionBox');
// Form submit event
add.addEventListener('click', addItem);

optionContainer.addEventListener('click', addOptionForm);

optionContainer.addEventListener('click', removeOption);

questionBox.addEventListener('click', removeItem);
// Add item
function addItem(e){
  e.preventDefault();
    var i = 0;
    ++i;
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
    divOpt.className = 'container text-center py-3';
    divOpt.id = "option-container"
        
        var table = document.createElement('table');
        table.className = "table my-2 table-borderless";
        
        var tbody = document.createElement("tbody");
        tbody.id = 'table-option'
        table.appendChild(tbody);
        
        var tr = document.createElement("tr");
        var trAdd = document.createElement("tr");
        

        var tdInput = document.createElement("td");
        tdInput.className = "align-middle";
        var tdDel = document.createElement("td");
        tdDel.className = "align-middle";
        tr.appendChild(tdInput);
        tr.appendChild(tdDel);

        var inputOpt = document.createElement('input');
        inputOpt.className = "form-control";
        inputOpt.setAttribute("type", "text");
        inputOpt.setAttribute("name", 'option[]');
        inputOpt.setAttribute("placeholder", "Option");
        inputOpt.id = 'option-input';

        var delOpt = document.createElement('a');
        delOpt.className = "fa fa-times text-secondary text-decoration-none delete";
        delOpt.setAttribute("role", "button");
        delOpt.addEventListener("click",  removeOption);
        
        tdInput.appendChild(inputOpt);
        tdDel.appendChild(delOpt);

        var tdAdd = document.createElement('td');
        trAdd.appendChild(tdAdd);
        var addOpt = document.createElement('a');
        addOpt.className = "addOption text-decoration-none ";
        addOpt.setAttribute("role", "button");
        addOpt.setAttribute("id", "add-option");
        addOpt.appendChild(document.createTextNode('+ Add Option'))
        addOpt.addEventListener("click",  addOptionForm);
        
        
        tdAdd.appendChild(addOpt);
        
        tbody.appendChild(tr);
        tbody.appendChild(trAdd);
        divOpt.appendChild(table);

    divQB.appendChild( divOpt);
    
    var deleteBtn = document.createElement('button');

    deleteBtn.className = 'btn btn-danger btn-sm float-right delete-question';
    deleteBtn.setAttribute('type', 'button');
 
    deleteBtn.appendChild(document.createTextNode('Delete'));
    deleteBtn.addEventListener("click",  removeItem);
    
    divQB.appendChild(deleteBtn);
    containerForm.appendChild(divQB);
}


function addOptionForm(e){
  
  if(e.target.classList.contains('addOption')){
    optionContainer.removeEventListener('click', removeOption);
    var li = e.target.parentElement.parentElement.parentElement;
    li.addEventListener("click",  removeOption);
    var tr = document.createElement("tr");
        var tdInput = document.createElement("td");
        tdInput.className = "align-middle";
        var tdDel = document.createElement("td");
        tdDel.className = "align-middle";
        tr.appendChild(tdInput);
        tr.appendChild(tdDel);

        var inputOpt = document.createElement('input');
        inputOpt.className = "form-control";
        inputOpt.setAttribute("type", "text");
        inputOpt.setAttribute("name", 'option[]');
        inputOpt.setAttribute("placeholder", "Option");
        inputOpt.id = 'option-input';

        var delOpt = document.createElement('a');
        delOpt.className = "fa fa-times text-secondary text-decoration-none delete";
        delOpt.setAttribute("role", "button");
        /* delOpt.addEventListener("click",  removeOption); */
        
        tdInput.appendChild(inputOpt);
        tdDel.appendChild(delOpt);
    
   
    li.insertBefore(tr, e.target.parentElement.parentElement); 
    } 
}

function removeOption(e){
  if(e.target.classList.contains('delete')){
    var td = e.target.parentElement.parentElement;
      var table = e.target.parentElement.parentElement.parentElement;
      
      table.removeChild(td);
    }
}
function removeItem(e){
    if(e.target.classList.contains('delete-question')){
      var container =  e.target.parentElement.parentElement; 
      var qB = e.target.parentElement;
        
      container.removeChild(qB);
    }
}