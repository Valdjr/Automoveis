$(document).ready(function() {
    var id = $('#id').val();
    if(id.length > 0) {
        buscar(id);
    }
});

function buscar(id) {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/marca.controller.php",
        data: {acao: 'buscar', id: id},
    }).done(function (data) {
        if (!data.erro) {
            var dados = data.dados[0];
            $('#descricao').val(dados.descricao);
        } else {
            if (data.msg.length > 0) {
                $('#msg').show().html(data.msg);
            } else {
                $('#msg').show().html("Algo deu errado. Tente novamente ou entre em contato!");
            }
        }
    });
}

function salvar() {
    var id = $('#id').val();
    var value = id.length > 0 ? "alterar" : "incluir";
    var data = $('#form').serializeArray();
    data.push({ name: "acao", value: value });
    console.log(data);
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/marca.controller.php",
        data: data,
    }).done(function (data) {
        if (!data.erro) {
            window.location.href = "form.marcas.php";
        } else {
            if (data.msg.length > 0) {
                $('#msg').show().html(data.msg);
            } else {
                $('#msg').show().html("Algo deu errado. Tente novamente ou entre em contato!");
            }
        }
    }).fail(function () {
        $('#msg').show().html("Algo deu errado. Tente novamente ou entre em contato!");
    });
}