<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Application\Model\Agendamento;

class AgendamentoController extends AbstractRestfulController
{

    public $array = [
        'error' => '',
        'result' => ''
    ];

    protected $AgendamentoTable;
    public function getList()
    {
        $fetchagendamentos = $this->getTable('Application\Model\AgendamentoTable')->fetchAll();

        foreach ($fetchagendamentos as $a) {
            $agendamentos[] = $a;
        }
        if (count($agendamentos) > 0) {

            $this->array['result'] =  array('agendamentos' => $agendamentos);
        } else {

            $this->array['error'] = array('msg' => 'Nenhum dado encontrado');
        }
        $resposta = new JsonModel($this->array);
        return $resposta;
    }
    public function get($id)
    {
        $getAgendamento = $this->getTable('Application\Model\AgendamentoTable')->get($id, 'id');

        if (count($getAgendamento) > 0) {
            $this->array['result'] = array('agendamento' => $getAgendamento);
        } else {
            $this->array['error'] = array('msg' => 'Nenhum agendamento encontrado');
        }
        $resposta = new JsonModel($this->array);
        return $resposta;
    }

    public function create($data)
    {

        if (empty($data['consultor']) || empty($data['servico'])) {
            $this->array['error'] = array('msg' => 'Nenhum consultor ou servico foi enviado');
            $resposta = new JsonModel($this->array);
            return $resposta;
        }

        $entity = new Agendamento;
        $entity->exchangeArray($data);
        $fetchagendamentos = $this->getTable('Application\Model\AgendamentoTable')->fetchAll();
        foreach ($fetchagendamentos as $key => $a) {
            if ($a['consultor'] == $data['consultor'] && $a['data'] == $data['data']) {
                $agendamentos[] = $a;
            }
        }
        if (count($agendamentos) == 0) {
            $save = $this->getTable('Application\Model\AgendamentoTable')->save($entity);
            if ($save) {
                $this->array['result'] = array('novo_agendamento' => $save);
            } else {
                $this->array['error'] = array('msg' => 'Não foi possível salvar');
            }
            $resposta = new JsonModel($this->array);
            return $resposta;
        }
        $this->array['error'] = array('msg' => 'Este consultor já tem agendamento para esta data');
        $resposta = new JsonModel($this->array);
        return $resposta;
    }

    public function getTable($namespace)
    {
        if (!$this->AgendamentoTable) {
            $sm = $this->getServiceLocator();
            $this->AgendamentoTable = $sm->get($namespace);
        }
        return $this->AgendamentoTable;
    }
}
