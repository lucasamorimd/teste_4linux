<?php

namespace Application\Model;

class Agendamento
{
    public $id;
    public $data;
    public $consultor;
    public $servico;
    public $email_cliente;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->data = (!empty($data['data'])) ? $data['data'] : null;
        $this->consultor = (!empty($data['consultor'])) ? $data['consultor'] : null;
        $this->servico = (!empty($data['servico'])) ? $data['servico'] : null;
        $this->email_cliente = (!empty($data['email_cliente'])) ? $data['email_cliente'] : null;
    }
    public function toArray()
    {
        $data = array(
            'id' => $this->id,
            'data' => $this->data,
            'consultor' => $this->consultor,
            'servico' => $this->servico,
            'email_cliente' => $this->email_cliente
        );
        return $data;
    }
}
