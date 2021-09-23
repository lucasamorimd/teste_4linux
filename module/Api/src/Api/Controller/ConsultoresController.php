<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ConsultoresController extends AbstractRestfulController
{

    public $array = [
        'error' => '',
        'result' => ''
    ];
    protected $ConsultoresTable;

    public function getList()
    {

        $fechConsultores = $this->getTable('Application\Model\ConsultoresTable')->fetchAll();
        foreach ($fechConsultores as $c) {
            $consultores[] = $c;
        }

        if (count($consultores) > 0) {
            $this->array['result'] =  $consultores;
        } else {
            $this->array['error'] = 'Não há consultores cadastrados';
        }
        $resposta = new JsonModel($this->array);
        return $resposta;
    }

    public function get($id)
    {

        if ($this->getCallParamenters() !== null) {
            $column = $this->getCallParamenters();
        } else {
            $column = 'id';
        }

        $getConsultor = $this->getTable('Application\Model\ConsultoresTable')->get($id, $column);

        if (count($getConsultor) > 0) {
            $this->array['result'] = $getConsultor;
        } else {
            $this->array['error'] =  'Nenhum item encontrado';
        }
        $resposta = new JsonModel($this->array);
        return $resposta;
    }

    private function getTable($namespace)
    {
        if (!$this->ConsultoresTable) {
            $sm = $this->getServiceLocator();
            $this->ConsultoresTable = $sm->get($namespace);
        }
        return $this->ConsultoresTable;
    }
    private function getCallParamenters()
    {
        $table = $this->getEvent()->getRouteMatch()->getParam('column');
        return $table;
    }
}
