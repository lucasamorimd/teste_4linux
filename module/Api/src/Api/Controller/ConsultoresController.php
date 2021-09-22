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
            $this->array['result'] = array('consultores' => $consultores);
        } else {
            $this->array['error'] = array('msg' => 'Não há consultores cadastrados');
        }
        $resposta = new JsonModel($this->array);
        return $resposta;
    }

    public function get($id)
    {
        $getConsultor = $this->getTable('Application\Model\ConsultoresTable')->get($id);

        if (count($getConsultor) > 0) {
            $this->array['result'] = array('Consultores' => $getConsultor);
        } else {
            $this->array['error'] = array('msg' => 'Nenhum item encontrado');
        }
        $resposta = new JsonModel($this->array);
        return $resposta;
    }

    public function getTable($namespace)
    {
        if (!$this->ConsultoresTable) {
            $sm = $this->getServiceLocator();
            $this->ConsultoresTable = $sm->get($namespace);
        }
        return $this->ConsultoresTable;
    }
}
