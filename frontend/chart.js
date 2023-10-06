$(document).ready(function () {

    // Manipula o clique no botão "Filtrar"
    $('#btn-filtrar').on('click', function () {
        // Obtem o valor selecionado do <select>
        var alunoSelecionado = $('#aluno').val();

        // Realiza a solicitação AJAX com o valor do aluno selecionado
        $.ajax({
            type: "POST",
            url: "../backend/chart.php",
            data: { aluno: alunoSelecionado },
            dataType: "json",
            success: function (data) {
                // Processa os dados e cria o gráfico
                if (data && data.length > 0) {
                    var formularioarray = [];
                    var notaarray = [];
                    for (var i = 0; i < data.length; i++) {
                        formularioarray.push(data[i].nome); // Pegando o formulario
                        notaarray.push(data[i].NFO_NOTA); // Pegando a nota
                    }
                    criarGrafico(formularioarray, notaarray);
                } else {
                    console.error("Dados inválidos ou vazios.");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            }
        });
    });
});

// Função para criar o gráfico
function criarGrafico(nome, nota) {
    var ctx = document.getElementById('myChart').getContext('2d');

    var chart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: nome,
            datasets: [{
                label: 'Gráfico',
                backgroundColor: ['green', 'blue', 'yellow'],
                borderColor: 'rgb(255, 99, 132)',
                data: nota
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

// Função para preencher o <select> com os alunos
function preencheSelectAluno() {
    $.ajax({
        url: '../backend/consulta_aluno.php',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            // Limpa o <select> atual
            $('#aluno').empty();
            
            // Preenche o <select> com os novos dados
            for (var i = 0; i < data.length; i++) {
                $('#aluno').append($('<option>', {
                    value: data[i].USU_CODIGO,
                    text: data[i].USU_NOME
                }));
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, errorThrown);
        }
    });
}
