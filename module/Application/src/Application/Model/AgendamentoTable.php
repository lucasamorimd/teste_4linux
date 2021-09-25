<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class AgendamentoTable
{
    public $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll(Select $select = null)
    {
        if ($select) {
            return $this->tableGateway->selectWith($select);
        }
        return  $this->tableGateway->select();
    }


    public function save(Agendamento $item)
    {
        $data = array(
            'id' => $item->id,
            'data' => $item->data,
            'consultor' => $item->consultor,
            'servico' => $item->servico,
            'email_cliente' => $item->email_cliente
        );

        $id = (int)$item->id;
        if ($id == null) {
            $this->tableGateway->insert($data);
            $item->id = $this->tableGateway->getLastInsertValue();
        } else {
            if ($this->get($id, 'id')) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Id does not exist');
            }
        }
        return $item;
    }
    public function get($id, $colmumn)
    {
        $id  =  $id;
        $rowset = $this->tableGateway->select(array($colmumn => $id));
        $row = $rowset->current();
        return $row;
    }
}
