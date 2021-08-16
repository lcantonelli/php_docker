<?php

namespace App\Model;

use Core\PersistModel;

class Pessoa extends PersistModel {

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $result = [];
        try {
            $result = $this->db->query("SELECT * FROM pessoa");
            $result = $result->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            
        }
        return $result;
    }

    public function save($dados) {
        try {
            $this->db->beginTransaction();
            $query = $this->db->prepare('INSERT INTO pessoa (nome, sobrenome, endereco) VALUES(:nome, :sobrenome, :endereco)');
            $query->execute([
                ":nome" => $dados['nome'],
                ":sobrenome" => $dados['sobrenome'],
                ":endereco" => $dados['endereco']
            ]);
            $lastId = $this->db->lastInsertId();
            $this->db->commit();
            return $lastId;
        } catch (\PDOException $e) {
            $this->db->rollback();
        }
        return null;
    }

    public function edit($dados) {
        try {
            $this->db->beginTransaction();
            $query = $this->db->prepare('UPDATE pessoa SET nome = :nome, sobrenome = :sobrenome, endereco = :endereco WHERE id = :id');
            $query->execute([
                ":id" => (int) $dados['id'],
                ":nome" => $dados['nome'],
                ":sobrenome" => $dados['sobrenome'],
                ":endereco" => $dados['endereco'],
            ]);
            $this->db->commit();
            return $dados['id'];
        } catch (\PDOException $e) {
            $this->db->rollback();
        }
        return null;
    }

    public function delete($dados) {
        try {
            $this->db->beginTransaction();
            $query = $this->db->prepare('DELETE FROM pessoa WHERE id = :id');
            $query->execute([
                ":id" => (int) $dados['id'],
            ]);
            $this->db->commit();
            return $dados['id'];
        } catch (\PDOException $e) {
            $this->db->rollback();
        }
        return null;
    }

}
