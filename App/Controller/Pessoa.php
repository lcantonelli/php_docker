<?php

namespace App\Controller;

use App\Model\Pessoa AS PessoaModel;
use Core\Controller;
use \Core\Request AS Request;

class Pessoa extends Controller {

    private $pessoa;

    public function __construct() {
        $this->pessoa = new PessoaModel();
    }

    public function get(Request $request) {
        return $this->view("pessoa", $this->pessoa->get());
    }

    public function cadastrar(Request $request) {
        if (empty($request->all())) {
            return json_encode(["id" => 0]);
        }
        return json_encode(["id" => $this->pessoa->save($request->all())]);
    }

    public function atualizar(Request $request) {
        if (empty($request->all())) {
            return json_encode(["id" => 0]);
        }
        return json_encode(["id" => $this->pessoa->edit($request->all())]);
    }

    public function deletar(Request $request) {
        if (empty($request->all())) {
            return json_encode(["id" => 0]);
        }
        return json_encode(["id" => $this->pessoa->delete($request->all())]);
    }

}
