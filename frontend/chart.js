
$('document').ready(function () {

    $.ajax({
        type: "POST",
        url: "../backend/chart.php",
        dataType: "json",
        success: function (data) {

            // for (var i in data) {
            //     console.log(data[i].vendas)
            // }
            var nomearray = [];
            var vendasarray = [];

            for (var i = 0; i < data.length; i++) {

                nomearray.push(data[i].nome);
                vendasarray.push(data[i].vendas);

            }

            grafico(nomearray,vendasarray);

        }
    });
})