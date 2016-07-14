<?php
$rootDir = dirname(__FILE__); 
require $rootDir . "/vendor/autoload.php";


$ServicConfig = new \Zend\ServiceManager\Config(
            [
                'shared'    => 
                    [
                        'search.query.query'      => false,
                        'search.query.builder'    => false,
                        'search.query.param'      => false,
                        'search.tao.parser'       => false,
                    ],
                'invokables' => 
                    [
                        'search.query.query'      =>  '\\oat\\taoSearch\\model\\searchImp\\Query',
                        'search.query.builder'    =>  '\\oat\\taoSearch\\model\\searchImp\\QueryBuilder',
                        'search.query.param'      =>  '\\oat\\taoSearch\\model\\searchImp\\QueryParam',
                        'search.driver.postgres'  =>  '\\oat\taoSearch\\model\\searchImp\\DbSql\\Driver\\PostgreSQL',
                        'search.driver.mysql'     =>  '\\oat\taoSearch\\model\\searchImp\\DbSql\\Driver\\MySQL',
                        'search.tao.parser'       =>  '\\oat\\taoSearch\\model\\searchImp\\DbSql\\TaoRdf\\QueryParser',
                        'search.factory.query'    =>  '\\oat\\taoSearch\\model\\factory\\QueryFactory',
                        'search.factory.builder'  =>  '\\oat\\taoSearch\\model\\factory\\QueryBuilderFactory',
                        'search.factory.param'    =>  '\\oat\\taoSearch\\model\\factory\\QueryParamFactory',
                        'search.tao.gateway'      =>  '\\oat\\taoSearch\\model\\searchImp\\TaoSearchGateWay',
                    ],
                'abstract_factories' => 
                    [
                        '\\oat\\taoSearch\\model\\searchImp\\Command\\OperatorAbstractfactory',
                    ],
                'services' => 
                    [
                        'search.options' => 
                            [
                                'table'    => 'statements',
                                'language' => 'en-US',
                                'driver'   => 'taoRdf',
                            ]
                    ]

            ]
        );

$ServiceLocator = new \Zend\ServiceManager\ServiceManager($ServicConfig);

$GateWay = $ServiceLocator->get('search.tao.gateway');
$GateWay->setServiceLocator($ServiceLocator)->init();

$Builder = $GateWay->query();
$Query = $Builder->newQuery();

$Query->addOperation('http://www.w3.org/1999/02/22-rdf-syntax-ns#type', oat\taoSearch\model\search\helper\SupportedOperatorHelper::EQUAL, 'http://www.tao.lu/Ontologies/TAOItem.rdf#Item');
$Query->addOperation('http://www.tao.lu/Ontologies/TAOItem.rdf#ItemModel' , oat\taoSearch\model\search\helper\SupportedOperatorHelper::EQUAL ,  'http://www.tao.lu/Ontologies/TAOItem.rdf#QTI');
$Builder->setOffset(10)->sort(['modelId' => 'desc']);

$sql = $GateWay->parse($Builder)->search();