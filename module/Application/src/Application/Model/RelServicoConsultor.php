<?php

namespace Application\Model;

class RelServicoConsultor
{
    public $id_servico;
    public $id_consultor;


    public function exchangeArray($data)
    {
        $this->id_servico = (!empty($data['id_servico'])) ? $data['id_servico'] : null;
        $this->id_consultor = (!empty($data['id_consultor'])) ? $data['id_consultor'] : null;
    }
    public function toArray()
    {
        $data = array(
            'id_servico' => $this->id_servico,
            'id_consultor' => $this->id_consultor
        );
        return $data;
    }
}
