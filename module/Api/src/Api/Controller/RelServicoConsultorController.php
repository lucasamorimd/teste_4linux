<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RelServicoConsultorController extends AbstractRestfulController
{
    public $array = [
        'error' => '',
        'result' => ''
    ];
    protected $ServicosTable;

    public function get($id)
    {

        if ($this->getCallParamenters() !== null) {
            $column = $this->getCallParamenters();
        }
        $getServico = $this->getTable('Application\Model\ServicosTable')->get($id, $column);
        if (count($getServico) > 0) {
            $this->array['result'] = $getServico;
        } else {
            $this->array['error'] = 'Nenhum ' . $column . ' encontrado';
        }
        return new JsonModel($this->array);
    }

    private function getTable($namespace)
    {
        if (!$this->ServicosTable) {
            $sm = $this->getServiceLocator();
            $this->ServicosTable = $sm->get($namespace);
        }
        return $this->ServicosTable;
    }
    private function getCallParamenters()
    {
        $column = $this->getEvent()->getRouteMatch()->getParam('column');
        return $column;
    }
}
