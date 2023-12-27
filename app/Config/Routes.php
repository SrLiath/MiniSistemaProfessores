<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

#Professor login
$routes->get('/professor', 'Pro::login');

#listagem
$routes->get('/professor/listagem', 'Pro::index');

#sair
$routes->get('/professor/clean', 'Pro::clean');

#Aluno
$routes->get('/aluno', 'Alu::form');

#post da pergunta
$routes->post('/aluno/post', 'Alu::postForm');

#verificação de login
$routes->post('/professor', 'Pro::check');

#responder
$routes->post('/professor/responder', 'Pro::resposta');

#deletar resposta
$routes->post('/professor/del', 'Pro::rm');

#acompanhar
$routes->post('/acompanhar', 'Alu::acompanhar');
