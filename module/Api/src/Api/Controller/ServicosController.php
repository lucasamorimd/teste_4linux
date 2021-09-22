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
            $this->array['result'] = array('servicos' => $servicos);
        } else {
            $this->array['error'] = array('msg' => 'Nenhum serviço registrado');
        }
        return new JsonModel($this->array);
    }

    public function get($id)
    {
        $getServico = $this->getTable('Application\Model\ServicosTable')->get($id);
        if (count($getServico) > 0) {
            $this->array['result'] = array('servico' => $getServico);
        } else {
            $this->array['error'] = array('msg' => 'Nenhum serviço encontrado');
        }
        return new JsonModel($this->array);
    }

    public function getTable($namespace)
    {
        if (!$this->ServicosTable) {
            $sm = $this->getServiceLocator();
            $this->ServicosTable = $sm->get($namespace);
        }
        return $this->ServicosTable;
    }
}
