<?php

namespace App\Controllers;

class Pro extends BaseController
{
    public function login(): string
    {
        $db = \Config\Database::connect();
        $conect = $db->table('professores')->where('login', Session()->get('PLogin'))->where('password', Session()->get('PPassword'))->get()->getRow();
        if($conect){
            header('Location: ' . base_url('professor/listagem'));
            die();
        }else{
            return view('Professor/login');
            die();
        }
    }

    public function clean(): string
    {
        Session()->set(['PLogin' => 'null', 'PPassword' => 'null']);
        Session()->remove(['PLogin', 'PPassword']);
        Session()->close();
        header("Location: " . base_url('professor'));
        die();
    }

    public function check(): string
    {
        $user = $_POST['username'];
        $pass = hash('sha256', $_POST['password']);
        $db = \Config\Database::connect();
        $conect = $db->table('professores')->where('login', $user)->where('password', $pass)->get()->getRow();
        if($conect){
            Session()->set(['PLogin' => $user, 'PPassword' => $pass]); 
            return '1';
        }else{
            return '0';
        }

    }

    public function index(): string
    {
        $db = \Config\Database::connect();
        $conect = $db->table('professores')->where('login', Session()->get('PLogin'))->where('password', Session()->get('PPassword'))->get()->getRow();
        if($conect){
            $pendentes = $db->table('postagem')->where('professor_id', $conect->id)->where('status', 'pendente')->get()->getResult();
            $npendentes = $db->table('postagem')->where('professor_id', $conect->id)->where('status', 'respondido')->get()->getResult();

            return view('Professor/listagem', ['pendente' => $pendentes, 'npendente' => $npendentes]);
        }else{
            header('Location: ' . base_url('professor'));
            die();
        }
    }
    public function resposta(): string
    {
        $db = \Config\Database::connect();
        $conect = $db->table('professores')->where('login', Session()->get('PLogin'))->where('password', Session()->get('PPassword'))->get()->getRow();
        if($conect){
            $id = $_POST['id'];
            $mensagem = $_POST['resposta'];
            $db->table('postagem')->where('id', $id)->update(['resposta' => $mensagem, 'status' => 'respondido']);
            return "1";            
        }else{
            die();
        }
    }

    public function rm(): string
    {
        $db = \Config\Database::connect();
        $conect = $db->table('professores')->where('login', Session()->get('PLogin'))->where('password', Session()->get('PPassword'))->get()->getRow();
        if($conect){
            $id = $_POST['id'];
            $db->table('postagem')->where('id', $id)->update(['resposta' => null, 'status' => 'pendente']);
            return "1";            
        }else{
            die();
        }
    }
}
