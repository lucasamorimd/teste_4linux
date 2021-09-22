<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;


use Application\Model\Agendamento;
use Application\Model\AgendamentoTable;
use Application\Model\Consultores;
use Application\Model\ConsultoresTable;
use Application\Model\RelServicoConsultor;
use Application\Model\RelServicoConsultorTable;
use Application\Model\Servicos;
use Application\Model\ServicosTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Uri\UriFactory;

class Module
{
    public function onBootstrap($e)
    {
        /** @var \Zend\ModuleManager\ModuleManager $moduleManager */
        $moduleManager = $e->getApplication()->getServiceManager()->get('modulemanager');
        /** @var \Zend\EventManager\SharedEventManager $sharedEvents */
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $UriFactori = UriFactory::registerScheme('chrome-extension', 'Zend\Uri\Uri');

        //adiciona eventos ao módulo
        //pré e pós-processadores do controller Rest
        /* $sharedEvents->attach('Api\Controller\RestController', MvcEvent::EVENT_DISPATCH, array(new PostProcessor, 'process'), -100);
        $sharedEvents->attach('Api\Controller\RestController', MvcEvent::EVENT_DISPATCH, array(new PreProcessor, 'process'), 100);*/
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\AgendamentoTable' => function ($sm) {
                    $tableGateway = $sm->get('AgendamentoTableGateway');
                    $table = new AgendamentoTable($tableGateway);
                    return $table;
                },
                'AgendamentoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    return new TableGateway('agendamento', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\ConsultoresTable' => function ($sm) {
                    $tableGateway = $sm->get('ConsultoresTableGateway');
                    $table = new ConsultoresTable($tableGateway);
                    return $table;
                },
                'ConsultoresTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    return new TableGateway('consultores', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\ServicosTable' => function ($sm) {
                    $tableGateway = $sm->get('ServicosTableGateway');
                    $table = new ServicosTable($tableGateway);
                    return $table;
                },
                'ServicosTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    return new TableGateway('servicos', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\RelServicoConsultorTable' => function ($sm) {
                    $tableGateway = $sm->get('RelServicoConsultorTableGateway');
                    $table = new RelServicoConsultorTable($tableGateway);
                    return $table;
                },
                'RelServicoConsultorTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    return new TableGateway('rel_servico_consultor', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
