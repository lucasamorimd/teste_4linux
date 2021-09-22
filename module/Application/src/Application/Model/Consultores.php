<?php

namespace Application\Model;

class Consultores
{
    public $id;
    public $nome;
    public $email;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
    }
    public function toArray()
    {
        $data = array(
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email
        );
        return $data;
    }
}