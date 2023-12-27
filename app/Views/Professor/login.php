<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
  <title>Login professor</title>
  <style>
    #login { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
  </style>
</head>
<body>

<div class="container mt-5" id="login" >
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Login professor</h3>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="username">Usuário:</label>
              <input type="text" class="form-control" id="username" placeholder="Digite seu usuário">
            </div>
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" placeholder="Digite sua senha">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script src="<?= base_url('js/popper.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/sweet.js') ?>"></script>

<script>
        $(document).ready(function () {
            $('form').submit(function (event) {
                event.preventDefault()

                username = $('#username').val(),
                password = $('#password').val()
                

                $.ajax({
                type: 'POST',
                url: '<?= base_url('professor') ?>', 
                data: {password : password, username : username},
                success: function (data) {
                    if(data == '1'){
                        location.href="<?=base_url('professor/listagem') ?>"
                    }else{
                      Swal.fire({
                          icon: "warning",
                          text: "Verifique seus dados"
                      })
                    }
                },
                error: function (error) {
                  Swal.fire({
                    icon: "error",
                    text: "Contate um administrador"
                })
                }
                })
            })
        })
</script>
</body>
</html>
