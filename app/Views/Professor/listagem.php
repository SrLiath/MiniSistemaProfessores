<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('css/listagem.css') ?>">

    <title>Perguntas</title>
</head>
<body>

    <header>
        <a id="sair-btn" href="<?= base_url('professor/clean') ?>">Sair <i class="fa fa-sign-out"></i></a>
        <h1>Mensagens pendentes</h1>
    </header>

    <table>
    <?php if (empty($pendente)): ?>
            <tr>
                <td colspan="3"><h1>Sem Mensagens</h1></td>
            </tr>
        <?php else: ?>
        <?php foreach($pendente as $p): ?>
        <tr>
            <td class="top"><i class="fa fa-user fa-icon"></i><strong>Nome do Aluno:</strong> <?= $p->nome ?></td>
            <td class="top"><i class="fa fa-calendar fa-icon"></i><strong>Data da pergunta:</strong><?= date('d/m/Y H:i:s', strtotime($p->data)) ?></td>
            <td class="top"><i class="fa fa-info-circle fa-icon"></i><strong>Status da Mensagem:</strong> <?= $p->status ?></td>
        </tr>
        <tr>
            <td colspan="6"><strong>Mensagem:</strong> <?= $p->mensagem ?></td>
        </tr>
        <tr>
            <td colspan="6">
                <div class="response-box">
                    <div><strong>Resposta:</strong></div>
                    
                    <textarea rows="4" cols="50" id="resposta<?= $p->id ?>"></textarea>
                    <div>
                    <button class='responder' data-id='<?= $p->id ?>'><i class="fa fa-reply fa-icon"></i>Responder</button>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </table>

    <header>
        <h1>Mensagens respondidas</h1>
    </header>

     <table>
    <?php if (empty($npendente)): ?>
            <tr>
                <td colspan="3"><h1>Sem Mensagens</h1></td>
            </tr>
    <?php else: ?>
    <?php foreach($npendente as $p): ?>
        <tr>
            <td class="top"><i class="fa fa-user fa-icon"></i><strong>Nome do Aluno:</strong> <?= $p->nome ?></td>
            <td class="top"><i class="fa fa-calendar fa-icon"></i><strong>Data da pergunta:</strong> <?= date('d/m/Y H:i:s', strtotime($p->data)) ?></td>
            <td class="top"><i class="fa fa-info-circle fa-icon"></i><strong>Status da Mensagem:</strong> <?= $p->status ?></td>
        </tr>
        <tr>
            <td colspan="6"><strong>Mensagem:</strong> <?= $p->mensagem ?></td>
        </tr>
        <tr>
        <td colspan="6">
                <div class="response-box">
                    <div><strong>Resposta:</strong></div>
                    <textarea rows="4" cols="50" disabled><?= $p->resposta ?></textarea>
                    <div>
                    <button id="editar" class="editar" data-id='<?= $p->id ?>'><i class="fa fa-edit"></i>Editar</button>
                    <button id="apagar" class="apagar" data-id='<?= $p->id ?>'><i class="fa fa-trash"></i> Apagar</button>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
    </table>
<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script>
     $(document).ready(function() {
            $('.responder').on('click', function() {
                var id = $(this).data('id');
                var resposta = $('#resposta' + id).val();
                $.ajax({
                    type: 'POST', 
                    url: '<?= base_url('professor/responder') ?>', 
                    data: {
                        id: id,
                        resposta: resposta
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR.responseText)
                    }
                });
            });
        $('.editar').on('click', function() {
        var textarea = $(this).closest('tr').find('textarea');
        
        if (textarea.prop('disabled')) {
            textarea.prop('disabled', false);
            $(this).find('i').removeClass('fa-edit').addClass('fa-check');
        } else {
            var id = $(this).data('id');
            var resposta = textarea.val();
            
            $.ajax({
                url: '<?= base_url('professor/responder') ?>', 
                method: 'POST',
                data: { id: id, resposta: resposta },
                success: function(response) {
                    location.reload()

                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });

    $('.apagar').on('click', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: '<?= base_url('professor/del') ?>', 
            method: 'POST',
            data: { id: id },
            success: function(response) {
               location.reload()
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});


</script>
</body>
</html>
