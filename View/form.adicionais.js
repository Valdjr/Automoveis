
var pagina = 1;

$(document).ready(function() {
    listar();
});

function listar(pesquisa = '') {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/adicional.controller.php",
        data: { acao: 'listar', pesquisa: pesquisa, pagina: pagina}
    }).done(function (data) {
        pagina = data.pagina;
        $('#paginaAtual').html(pagina);
        var dados = data.dados;
        if (!data.erro && dados.length > 0) {
            var th1 = $('<th>').html('<input type="checkbox" onclick="marcarTodos()" id="checkTodos">').css('width', '50px');
            var th2 = $('<th>').html('Descrição');
            var tr = $('<tr>').append(th1, th2);
            var thead = $('<thead>').append(tr);
            var table = $('<table>').append(thead).addClass('table mt-4 table-hover');
            var tbody = $('<tbody>');
            dados.forEach(function (element) {
                var td1 = $('<td>').html('<input type="checkbox" id="id' + element.id + '" class="check">');
                var td2 = $('<td onclick="alterar('+element.id+')">').html(element.descricao).css('cursor','pointer');
                var tr = $("<tr>").append(td1, td2);
                tbody.append(tr);
            });
            table.append(tbody);
            $('#conteudo').show().html(table);
            if(data.total > 10){
                $('#paginacao').show();
            }
            $('#msg').hide();
        } else {
            $('#paginacao').hide();
            $('#conteudo').hide();
            if (data.hasOwnProperty('msg')) {
                $('#msg').show().html(data.msg);
            } else {
                $('#msg').show().html("A lista está vazia!").addClass('alert-dark');
            }
        }
    });
}

function pesquisar() {
    listar($('#input_search').val());
}

function proxima() {
    pagina += 1;
    listar($('#input_search').val());
}

function anterior() {
    pagina = pagina < 2 ? 1 : pagina - 1;
    listar($('#input_search').val());
}

function marcarTodos() {
    var checks = document.getElementsByClassName('check');
    var value = true;
    for (var check of checks) {
        if (check.checked) {
            value = false;
            break;
        }
    }
    for (var check of checks) {
        check.checked = value;
    }
    document.getElementById('checkTodos').checked = value;
}

function alterar(id) {
    if (id != null) {
        window.location.href = 'form.adicional.php?id=' + id;
    } else {
        var checks = document.getElementsByClassName('check');
        var checados = [];
        for (var check of checks) {
            if (check.checked) {
                checados.push(check);
            }
        }
        if (checados.length > 1) {
            alert("Selecione apenas 1 adicional para alterar!");
        } else if (checados.length < 1) {
            alert("Selecione 1 adicional para alterar!");
        } else {
            var id = checados[0].id;
            var id = id.replace('id', '');
            window.location.href = 'form.adicional.php?id=' + id;
        }
    }
}

function excluir() {
    var checks = document.getElementsByClassName('check');
    var checados = [];
    for (var check of checks) {
        if (check.checked) {
            var id = check.id;
            checados.push(id.replace('id', ''));
        }
    }
    if (checados.length == 0) {
        alert("Selecione pelo menos 1 adicional para excluir!");
    } else {
        if(!confirm("Você tem certeza que deseja excluir?")){
            return false;
        }
        var ids = checados.join(',');
        $.ajax({
            method: "POST",
            url: "/Automoveis/Controller/adicional.controller.php",
            data: { acao: 'excluir', ids: ids}
        }).done(function (data) {
            if (!data.erro) {
                location.reload();
            } else {
                if (data.msg.length > 0) {
                    $('#msg').show().html(data.msg).addClass("alert-danger");
                } else {
                    $('#msg').show().html("Algo deu errado. Tente novamente ou entre em contato!").addClass("alert-danger");
                }
            }
        });
    }
}