<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
  <title>Escolha seu Perfil</title>
  <link rel="stylesheet" href="<?= base_url('css/index.css') ?>">
</head>
<body>

<div class="center container text-center">
  <h2>Quem você é?</h2>
  <div class="btn-group-vertical mt-4" role="group">
    <a href="<?= base_url('professor') ?>" class="btn btn-primary btn-lg" role="button">Professor</a>
    <button class="btn btn-primary btn-lg aluno-btn" role="button">Aluno</button>
  </div>
</div>

<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script src="<?= base_url('js/popper.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/sweet.js') ?>"></script>
<script>
  $(document).ready(function(){
    $('.aluno-btn').on('click', function() {
      Swal.fire({
        title: 'Você quer?',
        showCancelButton: true,
        confirmButtonText: 'Perguntar',
        cancelButtonText: 'Acompanhar Pergunta',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '<?= base_url('aluno') ?>'
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: 'Insira o código:',
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Acompanhar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: (codigo) => {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('acompanhar') ?>', 
                    data: {codigo : codigo},
                    success: function (data) {
                        console.log(data)
                            if (data === '0') {
                                Swal.fire({
                                    icon: 'warning',
                                    text: 'Código não encontrado'
                                })
                            } else {
                                var jsonResponse = JSON.parse(data)
                                var pergunta = jsonResponse.pergunta
                                var resposta = jsonResponse.resposta
                                resposta = resposta !== null ? resposta : 'Sem resposta';
                                Swal.fire({
                                    title: 'pergunta',
                                    html: '<div id="chat-container">' +
                                        '<div class="question">' + pergunta + '</div>' +
                                        '<div class="answer">' + resposta + '</div>' +
                                        '</div>',
                                    showCancelButton: true,
                                    confirmButtonText: 'Fechar',
                                    cancelButtonText: 'Nova Pergunta',
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.cancel) {
                                        location.reload()
                                    }
                                })
                            }
                        },

                    error: function(jqXHR) {
                console.log(jqXHR.responseText)
                    Swal.fire({
                        icon: "error",
                        text: "Contate um administrador"
                    })
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
          })
        }
      })
    })
  })
</script>

</body>
</html>
