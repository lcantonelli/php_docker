<?php

$route->get('/', 'Pessoa@get');
$route->post('/cadastrar', 'Pessoa@cadastrar');
$route->put('/atualizar', 'Pessoa@atualizar');
$route->delete('/deletar', 'Pessoa@deletar');
