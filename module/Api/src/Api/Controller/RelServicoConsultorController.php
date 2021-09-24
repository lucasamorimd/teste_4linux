<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RelServicoConsultorController extends AbstractRestfulController
{
    public $array = [
        'error' => '',
        'result' => []
    ];
    protected $ServicosTable;

    public function get($id)
    {

        $getIdServico = $this->getTable('Application\Model\RelServicoConsultorTable')->get($id, 'id_consultor');
        $this->ServicosTable = null;
        if (count($getIdServico) > 0) {
            foreach ($getIdServico as $id_servico) {
                $getServicos[] = $this->getTable('Application\Model\ServicosTable')->get($id_servico, 'id');
            }
            $this->array['result'] = $getServicos;
        } else {
            $this->array['error'] = 'Nada encontrado';
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
