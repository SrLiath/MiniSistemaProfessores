<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="stylesheet" href="<?= base_url('css/form.css') ?>">
    <script src="<?= base_url('js/sweet.js') ?>"></script>
</head>
<body>
<div id="divForm">
    <form id="envio">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome">

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email">

        <label for="nascimento">Nascimento (DD/MM/YYYY):</label>
        <input type="text" id="nascimento" name="nascimento">

        <label for="whatsapp">WhatsApp:</label>
        <input type="text" id="whatsapp" name="whatsapp">

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" maxlength="2">

        <label for="disciplina">Disciplina:</label>
        <select id="disciplina" name="disciplina">
            <option value="" selected disabled>Selecione a disciplina</option>
            <option value="matematica">Matemática</option>
            <option value="portugues">Português</option>
            <option value="ciencias">Ciências</option>
        </select>

        <div class="professores-select" id="matematica-select">
            <label for="professores-matematica">Professores de Matemática:</label>
            <select id="professores-matematica" name="professores-matematica">
                <option value="" selected disabled>Selecione um professor</option>
                <?php foreach ($matematica as $prof): ?>
                <option value="<?= $prof->id ?>"><?= $prof->nome ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="professores-select" id="portugues-select">
            <label for="professores-portugues">Professores de Português:</label>
            <select id="professores-portugues" name="professores-portugues">
                <option value="" selected disabled>Selecione um professor</option>
                <?php foreach ($portugues as $prof): ?>
                <option value="<?= $prof->id ?>"><?= $prof->nome ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="professores-select" id="ciencias-select">
            <label for="professores-ciencias">Professores de Ciências:</label>
            <select id="professores-ciencias" name="professores-ciencias">
                <option value="" selected disabled>Selecione um professor</option>
                <?php foreach ($ciencias as $prof): ?>
                <option value="<?= $prof->id ?>"><?= $prof->nome ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="4"></textarea>

        <button type="button" onclick="enviarFormulario()">Enviar</button>
    </form>
    </div>
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script>
        $(document).ready(function(){
            $('#disciplina').change(function(){
                var selectedDisciplina = $(this).val()
                $('.professores-select').hide()
                if(selectedDisciplina !== ''){
                    $('#' + selectedDisciplina + '-select').show()
                }
            })
        })

        function enviarFormulario() {
    var nome = $('#nome').val()
    var email = $('#email').val()
    var nascimento = $('#nascimento').val()
    var whatsapp = $('#whatsapp').val()
    var cidade = $('#cidade').val()
    var estado = $('#estado').val()
    var disciplina = $('#disciplina').val()
    var professor

    switch(disciplina) {
        case 'matematica':
            professor = $('#professores-matematica').val()
            break
        case 'portugues':
            professor = $('#professores-portugues').val()
            break
        case 'ciencias':
            professor = $('#professores-ciencias').val()
            break
        default:
            professor = ''
    }

    var mensagem = $('#mensagem').val()

    if (nome === '' || email === '' || nascimento === '' || whatsapp === '' || cidade === '' || estado === '' || disciplina === '' || professor === '' || mensagem === ''){
        Swal.fire({
            icon: "warning",
            text: "Preencha todos os campos antes de enviar o formulário."
        })

    } else {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('aluno/post') ?>',
            data: {
                nome: nome,
                email: email,
                nascimento: nascimento,
                whatsapp: whatsapp,
                cidade: cidade,
                estado: estado,
                disciplina: disciplina,
                professor: professor,
                mensagem: mensagem
            },
            success: function (data) {
                Swal.fire({
            icon: "warning",
            text: "Seu codigo de acompanhamento é: " + data,
            }).then((result) => {
                location.href="<?= base_url() ?>"
            })
            },
            error: function(jqXHR) {
                console.log(jqXHR.responseText)
                Swal.fire({
                icon: "error",
                text: "Erro, contate um administrador"
            })
            }
        })
    }
}

    </script>
</body>
</html>
