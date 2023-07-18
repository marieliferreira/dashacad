function readImage() {
    if (this.files && this.files[0]) {
        var file = new FileReader();
        file.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
        };       
        file.readAsDataURL(this.files[0]);
    }
}

document.getElementById("img-input").addEventListener("change", readImage, false);


function exibirCampoRA() {
    // Obtém o elemento de campo de entrada RA
    var campoRA = document.getElementById("div-ra");

    // Exibe o campo de entrada se o botão de opção "Aluno" estiver selecionado
    if (document.getElementById("radio-aluno").checked) {
        campoRA.style.display = "block";
    } else {
        campoRA.style.display = "none";
    }
}

var camposVisiveis = false;

function exibirCadastrarTurma() {
    // Obtém o elemento de campo de Cadastrar e visualizar Turma
    var campoCadastrarTurma = document.getElementById("nav-link-cadastrar-turma");
    var campoVisualizarTurma = document.getElementById("nav-link-visualizar-turma");

    // Exibe o campo de entrada se o botão Turma estiver selecionado
    if (!camposVisiveis) {
        campoCadastrarTurma.style.display = "block";
        campoVisualizarTurma.style.display = "block";
        camposVisiveis = true;
    } else {
        campoCadastrarTurma.style.display = "none";
        campoVisualizarTurma.style.display ="none";
        camposVisiveis = false;
    }
}

function exibirCadastrarDisciplina() {

    // Obtém o elemento de campo de Cadastrar e visualizar Disciplina
    var campoCadastrarDisciplina = document.getElementById("nav-link-cadastrar-disciplina");
    var campoVisualizarDisciplina = document.getElementById("nav-link-visualizar-disciplina");

    // Exibe o campo de entrada se o botão Disciplina estiver selecionado
    if (!camposVisiveis) {
        campoCadastrarDisciplina.style.display = "block";
        campoVisualizarDisciplina.style.display = "block";
        camposVisiveis = true;
    } else {
        campoCadastrarDisciplina.style.display = "none";
        campoVisualizarDisciplina.style.display ="none";
        camposVisiveis = false;
    }
}

function exibirCriarFormulario() {

    // Obtém o elemento de campo de Cadastrar e visualizar Turma
    var campoCriarFormulario = document.getElementById("nav-link-criar-formulario");
    var campoVisualizarFormulario = document.getElementById("nav-link-visualizar-formulario");

    // Exibe o campo de entrada se o botão Turma estiver selecionado
    if (!camposVisiveis) {
        campoCriarFormulario.style.display = "block";
        campoVisualizarFormulario.style.display = "block";
        camposVisiveis = true;
    } else {
        campoCriarFormulario.style.display = "none";
        campoVisualizarFormulario.style.display ="none";
        camposVisiveis = false;
    }
}






