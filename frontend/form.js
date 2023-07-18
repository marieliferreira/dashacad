var questionCount = 1; // Variável para controlar o número da pergunta
var letterCounter = 0;


function addQuestion(codigo_questao, nome_questao) {
  var questionsForm = document.getElementById("questions-form");

  var questionDiv = document.createElement("div");
  questionDiv.className = "question";
  questionDiv.id = "question-" + codigo_questao;

  var questionLabel = document.createElement("label");
  questionLabel.textContent = questionCount + ". Questão:";
  var questionInput = document.createElement("input");
  questionInput.className = "question-input";
  questionInput.type = "text";
  questionInput.name = "pergunta-" + codigo_questao;

  var optionsList = document.createElement("ul");
  optionsList.className = "options-list";

  var addOptionButton = document.createElement("button");
  addOptionButton.className = "add-option-btn";
  addOptionButton.type = "button";
  addOptionButton.textContent = "Adicionar Opção";
  addOptionButton.onclick = function() {
    addOption(this, codigo_questao);
  };

  var removeQuestionButton = document.createElement("button");
  removeQuestionButton.className = "remove-question-btn";
  removeQuestionButton.type = "button";
  removeQuestionButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/></svg>';
  removeQuestionButton.onclick = function() {
    removeQuestion(this);
  };

  questionDiv.appendChild(questionLabel);
  questionDiv.appendChild(questionInput);
  questionDiv.appendChild(optionsList);
  questionDiv.appendChild(addOptionButton);
  questionDiv.appendChild(removeQuestionButton);

  questionsForm.appendChild(questionDiv);

  renumberQuestions(codigo_questao, nome_questao);
  questionCount++;
}

function renumberQuestions(codigo_questao, nome_questao) {
  //alert(codigo_questao);
  var questionDivs = document.querySelectorAll("#question-" + codigo_questao);


  questionDivs.forEach(function(questionDiv, index) {
    var questionLabel = questionDiv.querySelector("label");
    questionLabel.textContent = questionCount + ". Questão: " + nome_questao;
    questionDiv.querySelector("input").name = "pergunta-" + (index + 1);
  });
}


var letterCounter = 0;

function addOption(button, codigo_questao) {
  var optionsList = button.parentNode.querySelector(".options-list");

  var optionListItem = document.createElement("li");
  
  var optionForm = document.createElement("form");
  optionForm.className = "option-class-form";
  optionForm.id = "option-form";
  optionForm.method = "POST";


  /*var optionInput = document.createElement("input");
  optionInput.className = "option-input";
  optionInput.id = "option-input-id";
  optionInput.type = "radio";
  optionInput.name = "opcao-" + button.parentNode.parentNode.querySelector(".question-input").name.split("-")[1];
  optionInput.value = codigo_questao;*/


  // cria a label
  var optionLabel = document.createElement("label");
  optionLabel.className = "option-label";
  
  // cria o elemento span para a letra
  var optionLetter = document.createElement("span");
  optionLetter.className = "option-letter";
  optionLetter.textContent = String.fromCharCode(65 + optionsList.children.length); // 65 é o código ASCII para 'A'


  var optionTextInput = document.createElement("input");
  optionTextInput.className = "option-text-input-class";
  optionTextInput.id = "option-text";
  optionTextInput.name = "option-text";
  optionTextInput.type = "text";
  optionTextInput.placeholder = "alternativa";


  var optionHiddenInput = document.createElement("input");
  optionHiddenInput.className = "option-hidden-input-class";
  optionHiddenInput.id = "option-hidden";
  optionHiddenInput.name = "option-hidden";
  optionHiddenInput.type = "hidden";
  optionHiddenInput.value = codigo_questao;

  var optioncheckboxInput = document.createElement("input");
  optioncheckboxInput.className = "option-checkbox-input-class";
  optioncheckboxInput.id = "option-checkbox";
  optioncheckboxInput.type = "checkbox";
  optioncheckboxInput.name = "option-checkbox";
  optioncheckboxInput.value = convertToLetter(optionsList.children.length);
  optioncheckboxInput.checked = false;

  optioncheckboxInput.addEventListener("change", function() {
    if (this.checked) {
      this.value = "sim"; // Se estiver marcado, definir o valor como "sim"
    } else {
      this.value = "nao"; // Se não estiver marcado, definir o valor como "nao"
    }
  });


  var salvarOptionButton = document.createElement("button");
  //salvarOptionButton.href = "#";
  salvarOptionButton.className = "btn-salvar-opcao";
  salvarOptionButton.id = "id-btn-salvar-opcao";
  salvarOptionButton.type = "button";
  salvarOptionButton.innerHTML = '<img id="img-btn-salvar" src="imagens/savetheapplication.png" alt="icone-salvar">';
  salvarOptionButton.onclick = function() {
    salvarOption(this, codigo_questao);
  };

  var spanSalvo = document.createElement("span");
  spanSalvo.className = "fas fa-check";
  spanSalvo.id = "span-salvo";
  
  
  var removeOptionButton = document.createElement("button");
  removeOptionButton.className = "remove-option-btn";
  removeOptionButton.type = "button";
  removeOptionButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>';
  removeOptionButton.onclick = function() {
    removeOption(this);
  };

  

  optionListItem.className = "option-container";

  optionForm.appendChild(optionLabel);
  optionForm.appendChild(optionLetter);
  optionForm.appendChild(optionTextInput);
  optionForm.appendChild(optionHiddenInput);
  optionListItem.appendChild(optionForm);
  optionForm.appendChild(optioncheckboxInput);
  optionForm.appendChild(salvarOptionButton);
  optionForm.appendChild(removeOptionButton);
  optionForm.appendChild(spanSalvo);
  optionsList.appendChild(optionListItem);


  // adiciona a label ao div de opções
  document.getElementById("options").appendChild(optionForm);

  // atualiza o contador de letras
  letterCounter++;
}




function removeQuestion(button) {
  var questionDiv = button.parentNode;
  questionDiv.parentNode.removeChild(questionDiv);
  renumberQuestions();
}

function removeOption(button) {
  var optionListItem = button.parentNode;
  optionListItem.parentNode.removeChild(optionListItem);
  var optionLetter = document.createElement("span");
  optionLetter.className = "option-letter";
  optionLetter.textContent = String.fromCharCode(65 + letterCounter--); // 65 é o código ASCII para 'A'
}

function convertToLetter(num) {
  var base = "A".charCodeAt(0);
  var letter = String.fromCharCode(base + num);
  return letter;
}


function salvarOption(button, codigo_questao) {
  var optionForm = button.parentNode;
  var optionText = optionForm.querySelector("#option-text").value;
  var optionHidden = optionForm.querySelector("#option-hidden").value;
  var optionCheckbox = optionForm.querySelector("#option-checkbox").value;

  // Código AJAX para enviar os dados para o servidor
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var spanSalvo = optionForm.querySelector("#span-salvo");
      spanSalvo.style.color = "green";
    }
  };
  xhttp.open("POST", "../backend/registro_alternativa.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("option-text=" + optionText + "&option-hidden=" + optionHidden + "&option-checkbox=" + optionCheckbox + "&codigo_questao=" + codigo_questao);

  button.disabled = true;
  button.classList.add("botao-desabilitado");
}

