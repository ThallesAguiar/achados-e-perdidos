<style>
  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
    -webkit-box-shadow: 0px 0px 21px 0px rgba(0, 0, 0, 0.33);
    -moz-box-shadow: 0px 0px 21px 0px rgba(0, 0, 0, 0.33);
    box-shadow: 0px 0px 21px 0px rgba(0, 0, 0, 0.33);
  }

  .form-signin .checkbox {
    font-weight: 400;
  }

  .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
  }

  .form-signin .form-control:focus {
    z-index: 2;
  }

  .form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>

<form class="form-signin text-center" method="POST" action="./logar.php">
  <img class="mb-4" src="https://www5.unifebe.edu.br/unifebe-plus/frontend/global/images/logo2.png" alt="" width="90" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Login</h1>
  <label for="codigo" class="sr-only">Matrícula/código</label>
  <input type="text" id="codigo" class="form-control m-1" placeholder="Matrícula/código" name="cd_usuario" required autofocus>
  <label for="inputPassword" class="sr-only">Senha</label>
  <input type="password" id="inputPassword" class="form-control m-1" placeholder="Senha" name="senha" required>

  <input type="text" name="login" value="true" hidden>
  <button class="btn btn-lg btn-primary btn-block m-1" type="submit">Login</button>
  <p class="mt-5 mb-3 text-muted">CAPI - Centro Adaptável Para Informações <?php echo date("Y") ?></p>
</form>