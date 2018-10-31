$(document).ready(function () {
    var id = $('#id').val();
    if (id.length > 0) {
        buscar(id);
    } else {
        montarAdicionais();
        montarMarcas();
    }
});

function buscar(id) {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/veiculo.controller.php",
        data: { acao: 'buscar', id: id },
    }).done(function (data) {
        if (!data.erro) {
            var dados = data.dados[0];
            $('#descricao').val(dados.descricao);
            $('#placa').val(dados.placa);
            $('#codigoRenavam').val(dados.codigoRenavam);
            $('#anoModelo').val(dados.anoModelo);
            $('#anoFabricacao').val(dados.anoFabricacao);
            $('#cor').val(dados.cor);
            $('#km').val(dados.km);
            $('#preco').val(dados.preco);
            $('#precoFipe').val(dados.precoFipe);
            montarMarcas(dados.marca);
            obterAdicionais(id);
        } else {
            if (data.msg.length > 0) {
                $('#msg').show().html(data.msg);
            } else {
                $('#msg').show().html("Algo deu errado. Tente novamente ou entre em contato!");
            }
        }
    });
}

function obterAdicionais(id) {
    var veiculoAdicional = new Promise(function (resolve) {
        $.ajax({
            method: "POST",
            url: "/Automoveis/Controller/veiculo.controller.php",
            data: { acao: 'obterAdicionais', id: id },
        }).done(function (data) {
            resolve(data.dados);
        })
    });
    veiculoAdicional.then(function (dados){
        montarAdicionais(dados)
    });
}

function montarAdicionais(dadosVa = []) {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/adicional.controller.php",
        data: { acao: 'listar', limit: 100 },
    }).done(function (data) {
        var dados = data.dados;
        if (!data.erro && dados.length > 0) {
            var h4 = $('<h4>').html("Adicionais");
            var div = $('#adicional').css('display', 'inline-block').append(h4);
            dados.forEach(function (element) {
                var label = $('<label for="id' + element.id + '">').css('margin', '10px');
                var checkbox = $('<input type="checkbox" name="adicional[]" id="id' + element.id + '">').val(element.id);
                dadosVa.forEach(function (va) {
                    if (va.idAdicional == element.id) {
                        checkbox = $('<input type="checkbox" name="adicional[]" id="id' + element.id + '">').val(element.id);
                        checkbox.prop('checked', true);
                    }
                });
                label.append(checkbox).append(" " + element.descricao);
                div.append(label);
            });
        }
    });
}

function montarMarcas(idMarca) {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/marca.controller.php",
        data: { acao: 'listar' },
    }).done(function (data) {
        var dados = data.dados;
        if (!data.erro && dados.length > 0) {
            var marca = $('#marca');
            dados.forEach(function (element) {
                var option = $('<option>').html(element.descricao).val(element.id);
                if (element.id == idMarca) {
                    option.attr('selected', true);
                }
                marca.append(option);
            });
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
        url: "/Automoveis/Controller/veiculo.controller.php",
        data: data,
    }).done(function (data) {
        if (!data.erro) {
            window.location.href = "form.veiculos.php";
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