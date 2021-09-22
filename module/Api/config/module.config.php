<?php
return array(
    'zfr_cors' => array(
        'allowed_origins' => ['*'],
        'allowed_methods' => ['GET', 'POST', 'PUT']
    ),
    'controllers' => array(
        'invokables' => array(
            'consultores' => 'Api\Controller\ConsultoresController',
            'servicos' => 'Api\Controller\ServicosController',
            'agendamento' => 'Api\Controller\AgendamentoController',
        )
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'router' => array( //rotas dos controllers
        'routes' => array(
            'restful' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'       => '/api/:controller[/:id]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[a-zA-Z0-9_-]*',
                    ),
                ),
            ),
        ),
    ),
);
