<?php
$includePath = realpath('./');
set_include_path($includePath);

function __autoload($name) {
    $name = str_replace('\\', '/', $name);
    $name = str_replace('oat/taoSearch/', './', $name);
    $name .= '.php';
    require $name;
}

$parserOptions = 
        [
            'table' => 'statements',
        ];

$Builder = new oat\taoSearch\model\searchImp\QueryBuilder();
$Builder->setQueryClassName('oat\taoSearch\model\searchImp\Query');
$Builder->setQueryFactory(function ($className) {
    return new $className();
    
});

$Query = $Builder->newQuery();
$Query->addOperation('http://www.w3.org/2000/01/rdf-schema#label', oat\taoSearch\model\search\helper\SupportedOperatorHelper::BEGIN_BY, 'test' , true)
        ->addAnd('1', oat\taoSearch\model\search\helper\SupportedOperatorHelper::CONTAIN)
        ->addOr('test' , oat\taoSearch\model\search\helper\SupportedOperatorHelper::CONTAIN);
$Query->addOperation('http://www.w3.org/1999/02/22-rdf-syntax-ns#type', oat\taoSearch\model\search\helper\SupportedOperatorHelper::EQUAL, 'http://www.tao.lu/Ontologies/TAOItem.rdf#Item');

$Builder->setOffset(10 , 10)->sort(['modelID' => 'desc']);

$Parser = new oat\taoSearch\model\searchImp\DbSql\MySQL\TaoRdf\QueryParser();

echo $Parser->prefixQuery($parserOptions)->setCriteriaList($Builder)->parse();

