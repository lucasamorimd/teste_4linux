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

        $getIdServico = $this->getTable('Application\Model\RelServicoConsultorTable')->fetchAll();
        $this->ServicosTable = null;
        $getConsultor = $this->getTable('Application\Model\ConsultoresTable')->get($id, 'id');
        $this->ServicosTable = null;
        if (count($getConsultor) > 0) {
            if (count($getIdServico) > 0) {
                foreach ($getIdServico as $id_servico) {
                    if ($id_servico['id_consultor'] == $id) {
                        $getServicos[] = $this->getTable('Application\Model\ServicosTable')->get($id_servico['id_servico'], 'id');
                    }
                }
                $this->array['result'] = $getServicos;
            } else {
                $this->array['error'] = 'Nada encontrado';
            }
        } else {
            $this->array['error'] = 'Não há nenhum consultor cadastrado';
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
