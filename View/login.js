function entrar() {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/usuario.controller.php",
        data: { acao: 'entrar', usuario: $('#usuario').val(), senha: $('#senha').val()},
    }).done(function (data){
        if(!data.erro){
            window.location.href = "home.php";
            console.log("Login successful");
        } else {
            $('#msg').show().html("Usuário ou senha inválidos!");
        }
    });
}

function cadastrar() {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/usuario.controller.php",
        data: { acao: 'cadastrar', usuario: $('#usuario').val(), senha: $('#senha').val()},
    }).done(function (data){
        if(!data.erro){
            window.location.href = "home.php";
            console.log("Sign up successful");
        } else {
            if(data.msg.length > 0) {
                $('#msg').show().html(data.msg);
            } else {
                $('#msg').show().html("Algo deu errado. Tente novamente ou entre em contato!");
            }
        }
    });
}

function alterar() {
    var data = $('#form').serializeArray();
    data.push({ name: "acao", value: 'alterar' });
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/usuario.controller.php",
        data: data,
    }).done(function (data){
        console.log(data);
        if(!data.erro){
            window.location.href = "home.php";
        } else {
            if(data.msg.length > 0) {
                $('#msg').show().html(data.msg);
            } else {
                $('#msg').show().html("Algo deu errado. Tente novamente ou entre em contato!");
            }
        }
    });
}

function sair() {
    $.ajax({
        method: "POST",
        url: "/Automoveis/Controller/usuario.controller.php",
        data: {acao: 'sair'},
    });
    window.location.href = "../index.php";
}

function mostarOcultarSenha(campo) {
    if((campo).prop('type') == 'password') {
        $(campo).prop('type','text');
        $('.fa-eye').removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        $(campo).prop('type','password');
        $('.fa-eye-slash').removeClass('fa-eye-slash').addClass('fa-eye');
    }
}