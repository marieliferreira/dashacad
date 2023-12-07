var questionCount = 1; // Variável para controlar o número da pergunta
var letterCounter = 0;

function addQuestion(codigo_questao, nome_questao) {
  var questionsForm = document.getElementById("questions-form");

  var questionDiv = document.createElement("div");
  questionDiv.className = "question";
  questionDiv.id = "question-" + codigo_questao;

  var questionLabel = document.createElement("label");
  questionLabel.textContent = questionCount + ". Questão:";
  questionLabel.className = "texto-justificado";
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
    removeQuestion(this, codigo_questao, nome_questao);
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
  var questionDivs = document.querySelectorAll("#question-" + codigo_questao);

  questionDivs.forEach(function(questionDiv, index) {
    var questionLabel = questionDiv.querySelector("label");
    questionLabel.textContent = questionCount + ". Questão: " + nome_questao;
    questionDiv.querySelector("input").name = "pergunta-" + (index + 1);
  });
}

function addOption(button, codigo_questao) {
  var optionsList = button.parentNode.querySelector(".options-list");

  var optionListItem = document.createElement("li");
  var codigo_alternativa = generateUniqueId(); // Gerar um código único para a alternativa
  optionListItem.setAttribute("data-codigo-alternativa", codigo_alternativa);
  
  var optionForm = document.createElement("form");
  optionForm.className = "option-class-form";
  optionForm.id = "option-form";
  optionForm.method = "POST";

  var optionLabel = document.createElement("label");
  optionLabel.className = "option-label";
  
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
  removeOptionButton.id = "id-remove-option-btn";
  removeOptionButton.type = "button";
  removeOptionButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>';
  removeOptionButton.onclick = function() {
    console.log (removeOptionButton);

    var codigo_alternativa = removeOptionButton.value;
    removeOption(this, codigo_questao, codigo_alternativa);
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

  letterCounter++;
}

function removeQuestion(button, codigo_questao, nome_questao) {

  removeQuestionFromLocalStorage(codigo_questao);

    // Código AJAX para remover a questão do banco de dados
    $.ajax({
        method: "POST",
        url: "../backend/excluir_questao.php",
        data: { codigo_questao: codigo_questao }
    }).done(function (resposta) {
        // Verifica a resposta do servidor
        console.log(resposta); // Você pode exibir a resposta ou tomar outras ações
    });

  var questionDiv = button.parentNode;
  questionDiv.parentNode.removeChild(questionDiv);
  renumberQuestions(codigo_questao, nome_questao);
}

function addQuestionToLocalStorage(codigo_questao, nome_questao) {
  // Verifica se existem dados armazenados no localStorage
  if (localStorage.getItem('questoes')) {
      // Recupera os dados das questões
      const questoes = JSON.parse(localStorage.getItem('questoes'));

      // Adiciona a nova questão aos dados existentes
      questoes.push({
          codigo_questao: codigo_questao,
          nome_questao: nome_questao
      });

      // Atualiza os dados no localStorage
      localStorage.setItem('questoes', JSON.stringify(questoes));
  } else {
      // Cria um novo array de questões e adiciona a primeira questão
      const questoes = [{
          codigo_questao: codigo_questao,
          nome_questao: nome_questao
      }];

      // Armazena os dados no localStorage
      localStorage.setItem('questoes', JSON.stringify(questoes));
  }
}

function addAlternativaToLocalStorage(codigo_alternativa, optionText) {
  // Verifica se existem dados armazenados no localStorage
  if (localStorage.getItem('alternativas')) {

      const alternativas = JSON.parse(localStorage.getItem('alternativas'));

      alternativas.push({
          codigo_alternativa: codigo_alternativa,
          descricao_alternativa: optionText
      });

      // Atualiza os dados no localStorage
      localStorage.setItem('alternativas', JSON.stringify(alternativas));
  } else {

      const alternativas = [{
        codigo_alternativa: codigo_alternativa,
        descricao_alternativa: optionText
      }];

      // Armazena os dados no localStorage
      localStorage.setItem('alternativas', JSON.stringify(alternativas));
  }
}


// Função para remover uma questão do localStorage
function removeQuestionFromLocalStorage(codigo_questao) {
  // Verifica se existem dados armazenados no localStorage
  if (localStorage.getItem('questoes')) {
      // Recupera os dados das questões
      const questoes = JSON.parse(localStorage.getItem('questoes'));

      // Filtra as questões, removendo a que possui o código_questao correspondente
      const updatedQuestoes = questoes.filter((questao) => questao.codigo_questao !== codigo_questao);

      // Atualiza os dados no localStorage com as questões atualizadas
      localStorage.setItem('questoes', JSON.stringify(updatedQuestoes));
  }
}

function removeOption(button, codigo_questao, codigo_alternativa) {

  var optionListItem = button.parentNode;
  //var codigoAlternativa = optionListItem.dataset.codigoAlternativa;

  // Código AJAX para excluir a alternativa do banco de dados
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Verifica se a exclusão foi bem-sucedida
      if (this.responseText === "Opção removida com sucesso!") {
        // Alternativa removida com sucesso do banco de dados
        optionListItem.parentNode.removeChild(optionListItem);
      } else {
        // Houve um erro ao excluir a opção
        console.log("Erro ao remover a opção: " + this.responseText);
      }
    }
  };

  xhttp.open("POST", "../backend/excluir-alternativa.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("codigo_alternativa=" + codigo_alternativa);
  
  letterCounter--;
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
      
      //console.log(this.responseText);

      var spanExclusao = optionForm.querySelector("#id-remove-option-btn");
      spanExclusao.value = this.responseText;
      //console.log(spanExclusao);

    }
  };
  xhttp.open("POST", "../backend/registro_alternativa.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("option-text=" + optionText + "&option-hidden=" + optionHidden + "&option-checkbox=" + optionCheckbox + "&codigo_questao=" + codigo_questao);

  button.disabled = true;
  button.classList.add("botao-desabilitado");
}

function generateUniqueId() {
  return Date.now().toString(36) + Math.random().toString(36).substr(2);
}


// Recupera os dados do localStorage ao carregar a página
window.onload = function() {
  // Verifica se existem dados armazenados no localStorage para as alternativas
  if (localStorage.getItem('alternativas')) {
      // Recupera os dados das alternativas
      const alternativas = JSON.parse(localStorage.getItem('alternativas'));

      // Itera sobre as alternativas e as adiciona às questões correspondentes
      alternativas.forEach(function(alternativa) {
          const codigo_questao = alternativa.codigo_questao;
          const nome_alternativa = alternativa.nome_alternativa;

          // Adiciona a alternativa à questão correspondente
          addOption(codigo_questao, nome_alternativa);
      });
  }
};

