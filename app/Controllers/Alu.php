<?php

namespace App\Controllers;

class Alu extends BaseController
{
    public function form(): string
    {
        $db = \Config\Database::connect();
        $pt = $db->table('professores')->select('nome, id')->where('materia', 'portugues')->get()->getResult();
        $cc = $db->table('professores')->select('nome, id')->where('materia', 'ciencias')->get()->getResult();
        $mt = $db->table('professores')->select('nome, id')->where('materia', 'matematica')->get()->getResult();
        return view('Aluno/form', ['portugues' => $pt, 'ciencias' => $cc, 'matematica' => $mt]);
    }

    public function acompanhar(): string
    {   
        $db = \Config\Database::connect();
        $cod = $_POST['codigo'];
        $dados = $db->table('postagem')->select('mensagem, resposta')->where('cod', $cod)->get()->getRow();
        if ($dados) {
            $result = [
                'pergunta' => $dados->mensagem,
                'resposta' => $dados->resposta
            ];
            $json = json_encode($result);
            return $json;
        } else {
            return '0';
        }
    
    }

    public function postForm(): string
    {
        $db = \Config\Database::connect();
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nascimento = $_POST['nascimento'];
        $whatsapp = $_POST['whatsapp'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $professor = $_POST['professor'];
        $mensagem = $_POST['mensagem'];
        $tempoAtual = hrtime(true);
        $cod = 'COD_' . $tempoAtual;
        $data = [
            'nome' => $nome,
            'email' => $email,
            'nascimento' => $nascimento,
            'wpp' => $whatsapp,
            'cidade' => $cidade,
            'estado' => $estado,
            'professor_id' => $professor,
            'mensagem' => $mensagem,
            'status' => 'pendente',
            'cod' => $cod];

        $db->table('postagem')->insert($data);
        return $cod;
    }


}
