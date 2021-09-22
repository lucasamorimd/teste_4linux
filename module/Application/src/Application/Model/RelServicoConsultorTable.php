<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;


class RelServicoConsultorTable
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

    public function get($id, $colmumn)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array($colmumn => $id));
        $row = $rowset->current();
        return $row;
    }
}
