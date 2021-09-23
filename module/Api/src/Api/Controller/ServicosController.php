<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ServicosController extends AbstractRestfulController
{
    public $array = [
        'error' => '',
        'result' => ''
    ];
    protected $ServicosTable;

    public function getList()
    {
        $fetchservicos = $this->getTable('Application\Model\ServicosTable')->fetchAll();
        foreach ($fetchservicos as $a) {
            $servicos[] = $a;
        }
        if (count($servicos) > 0) {
            $this->array['result'] =  $servicos;
        } else {
            $this->array['error'] = 'Nenhum serviço registrado';
        }
        return new JsonModel($this->array);
    }

    public function get($id)
    {

        if ($this->getCallParamenters() !== null) {
            $column = $this->getCallParamenters();
        } else {
            $column = 'id';
        }

        $getServico = $this->getTable('Application\Model\ServicosTable')->get($id, $column);
        if (count($getServico) > 0) {
            $this->array['result'] = $getServico;
        } else {
            $this->array['error'] = 'Nenhum serviço encontrado';
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
        $table = $this->getEvent()->getRouteMatch()->getParam('column');
        return $table;
    }
}
