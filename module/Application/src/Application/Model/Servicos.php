<?php

namespace Application\Model;

class Servicos
{
    public $id;
    public $descricao;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->descricao = (!empty($data['descricao'])) ? $data['descricao'] : null;
    }
    public function toArray()
    {
        $data = array(
            'id' => $this->id,
            'descricao' => $this->descricao
        );
        return $data;
    }
}
