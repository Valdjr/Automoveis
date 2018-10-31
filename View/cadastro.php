<?php require_once "cabecalho.php"; ?>
<link rel="stylesheet" href="css/signin.css">
</head>
<body class="text-center">
    <form class="form-signin" onsubmit="cadastrar(); return false;">
      <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Cadastro</h1>
      <div id="msg" class="alert alert-danger" style="display:none;"></div>
      <label for="usuario" class="sr-only">Usuário</label>
      <input type="text" id="usuario" class="form-control" placeholder="Usuário" required autofocus>
      <label for="senha" class="sr-only">Senha</label>
      <div class="input-group">
        <input type="password" id="senha" class="form-control" placeholder="Senha" required minlength="6">
        <div class="input-group-append">
          <span class="input-group-text" onclick="mostarOcultarSenha($('#senha'))" style="max-height: 46px;"><i class="far fa-eye"></i></span>
        </div>
      </div>
      <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Cadastrar</button>
      <a href="login.php">Já é cadastrado? logue-se!</a>
      <p class="mt-5 mb-3 text-muted">© Valdjr 2018-<?= date('Y') ?></p>
    </form>
    <script src="login.js"></script>
</body>

<?php
require_once "rodape.php";
?>