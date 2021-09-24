<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Application\Model\Agendamento;

class AgendamentoController extends AbstractRestfulController
{

    public $array = [
        'error' => '',
        'result' => []
    ];

    protected $AgendamentoTable;
    protected $otherTable;

    public function getList()
    {
        $fetchagendamentos = $this->getTable('Application\Model\AgendamentoTable')->fetchAll();

        if (count($fetchagendamentos) > 0) {
            foreach ($fetchagendamentos as $key => $a) {
                $getConsultor = $this->getOtherTable('Application\Model\ConsultoresTable')->get($a['consultor'], 'id');
                $this->otherTable = null;
                $getServico = $this->getOtherTable('Application\Model\ServicosTable')->get($a['servico'], 'id');
                $this->otherTable = null;
                $a['consultor'] = $getConsultor;
                $a['servico'] = $getServico;
                $agendamentos[$key] = $a;
            }
            $this->array['result'] =  $agendamentos;
        } else {

            $this->array['error'] = 'Nenhum dado encontrado';
        }
        $resposta = new JsonModel($this->array);
        return $resposta;
    }
    public function get($id)
    {

        //VERIFICA SE HÁ ALGUM PARAMETRO ALÉM DO ID PASSADO
        //CASO HAJA, ESSE PARAMETRÔ É UMA COLUNA ESPECÍFICA DA TABELA DO BANCO
        if ($this->getCallParamenters() !== null) {
            $column = $this->getCallParamenters();
        } else {
            $column = 'id';
        }

        $getAgendamento = $this->getTable('Application\Model\AgendamentoTable')->get($id, $column);


        if (count($getAgendamento) > 0) {
            $getConsultor = $this->getOtherTable('Application\Model\ConsultoresTable')->get($getAgendamento['id'], 'id');
            $this->otherTable = null;
            $getServico = $this->getOtherTable('Application\Model\ServicosTable')->get($getAgendamento['servico'], 'id');
            $this->otherTable = null;
            $getAgendamento['consultor'] = $getConsultor;
            $getAgendamento['servico'] = $getServico;
            $this->array['result'] =  [$getAgendamento];
        } else {
            $this->array['error'] =  'Nenhum agendamento encontrado';
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
                $this->array['result'] = $save;
            } else {
                $this->array['error'] =  'Não foi possível salvar';
            }
            $resposta = new JsonModel($this->array);
            return $resposta;
        }
        $this->array['error'] = array('msg' => 'Este consultor já tem agendamento para esta data');
        $resposta = new JsonModel($this->array);
        return $resposta;
    }

    private function getTable($namespace)
    {
        if (!$this->AgendamentoTable) {
            $sm = $this->getServiceLocator();
            $this->AgendamentoTable = $sm->get($namespace);
        }
        return $this->AgendamentoTable;
    }
    private function getOtherTable($namespace)
    {
        if (!$this->otherTable) {
            $sm = $this->getServiceLocator();
            $this->otherTable = $sm->get($namespace);
        }
        return $this->otherTable;
    }

    private function getCallParamenters()
    {
        $table = $this->getEvent()->getRouteMatch()->getParam('column');
        return $table;
    }
}
