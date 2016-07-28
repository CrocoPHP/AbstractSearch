<?php
$rootDir = dirname(__FILE__); 
require $rootDir . "/vendor/autoload.php";

use oat\taoSearch\model\search\helper\SupportedOperatorHelper as SupportedOperatorHelper;

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
                        'search.tao.parser'       =>  '\\oat\\taoSearch\\model\\searchImp\\DbSql\\TaoRdf\\UnionQueryParser',
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

echo "sample 1 :\n";
$Builder = $GateWay->query();

$Builder->criteria()->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')
        ->equal('http://www.taotesting.com/movies.rdf#Movie')
        ->andQuery()
        ->add('http://www.w3.org/2000/01/rdf-schema#label')
        ->contain('Dallas');

echo $GateWay->search($Builder);
echo "\n";
echo "sample 2 :\n";
$Builder = $GateWay->query();
$Query = $Builder->criteria()
        ->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')
        ->equal('http://www.taotesting.com/movies.rdf#Movie')
        ->andQuery()
        ->add('http://www.w3.org/2000/01/rdf-schema#label')
        ->contain('Best');

echo $GateWay->search($Builder);
echo "\n";
$Builder = $GateWay->query();
$Query = $Builder->criteria()
        ->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')
        ->equal('http://www.taotesting.com/movies.rdf#Movie')
        ->andQuery()
        ->add('http://www.w3.org/2000/01/rdf-schema#label')
        ->contain('Bes');
echo "sample 3 :\n";
echo $GateWay->search($Builder);
echo "\n";
$Builder = $GateWay->query();
$Query = $Builder->criteria();

$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.w3.org/2000/01/rdf-schema#label')->contain('Bes');
$Query->add('http://www.taotesting.com/movies.rdf#year')->contain('2013');
echo "sample 4 :\n";
echo $GateWay->search($Builder);
echo "\n";

$Builder = $GateWay->query();
$Query = $Builder->criteria();

$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#year')->contain('2013');
echo "sample 5 :\n";
echo $GateWay->search($Builder);
echo "\n";

$Builder = $GateWay->query();
$Query = $Builder->criteria();

$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.w3.org/2000/01/rdf-schema#label')->contain('Bes');
$Query->add('http://www.taotesting.com/movies.rdf#year')->match('2013');

$Builder->sort(
        [
            'http://www.w3.org/2000/01/rdf-schema#label' => 'desc'
        ]
        );
echo "sample 6 :\n";
echo $GateWay->search($Builder);
echo "\n";

echo "sample 7 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => true
recursive => false
Property Filters:

"http://www.w3.org/2000/01/rdf-schema#label" => ("bes", "gen", "獣電戦隊")
"http://www.taotesting.com/movies.rdf#year" => "2013"
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.w3.org/2000/01/rdf-schema#label')->contain('Bes')->addOr('gen')->addOr('獣電戦隊');
$Query->add('http://www.taotesting.com/movies.rdf#year')->match('2013');

echo $GateWay->search($Builder);
echo "\n";

echo "sample 8 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => true
recursive => false
order => "http://www.w3.org/2000/01/rdf-schema#label"
orderdir => "ASC"
lang => "en-US"
Property Filters:

"http://www.w3.org/2000/01/rdf-schema#label" => ("bes", "gen", "獣電戦隊")
"http://www.taotesting.com/movies.rdf#year" => "2013"
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                                'language' => 'en-US'
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.w3.org/2000/01/rdf-schema#label')->contain('Bes')->addOr('gen')->addOr('獣電戦隊');
$Query->add('http://www.taotesting.com/movies.rdf#year')->match('2013');

$Builder->sort(["http://www.w3.org/2000/01/rdf-schema#label" => 'asc']);

echo $GateWay->search($Builder);
echo "\n";

echo "sample 9 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => false
recursive => false
Property Filters:

"http://www.taotesting.com/movies.rdf#starring" => "http://www.taotesting.com/movies.rdf#RhysWakefield"
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#starring')->equal('http://www.taotesting.com/movies.rdf#RhysWakefield');

echo $GateWay->search($Builder);
echo "\n";

echo "sample 10 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => false
recursive => false
chaining => "or"
Property Filters:

"http://www.taotesting.com/movies.rdf#starring" => "http://www.taotesting.com/movies.rdf#RhysWakefield"
"http://www.taotesting.com/movies.rdf#directedBy" => "http://www.taotesting.com/movies.rdf#PeterJackson"
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#starring')->equal('http://www.taotesting.com/movies.rdf#RhysWakefield')->setAndSeparator(false);

$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#directedBy')->equal('http://www.taotesting.com/movies.rdf#PeterJackson');

echo $GateWay->search($Builder);
echo "\n";

echo "sample 11 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => false
recursive => false
chaining => "or"
order => http://www.w3.org/2000/01/rdf-schema#label
orderdir => "DESC"
lang => "en-US"
Property Filters:

"http://www.taotesting.com/movies.rdf#starring" => "http://www.taotesting.com/movies.rdf#RhysWakefield"
"http://www.taotesting.com/movies.rdf#directedBy" => "http://www.taotesting.com/movies.rdf#PeterJackson"
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                                'language' => 'en-US'
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#starring')->equal('http://www.taotesting.com/movies.rdf#RhysWakefield')->setAndSeparator(false);

$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#directedBy')->equal('http://www.taotesting.com/movies.rdf#PeterJackson');

$Builder->sort(["http://www.w3.org/2000/01/rdf-schema#label" => 'desc']);

echo $GateWay->search($Builder);
echo "\n";

echo "sample 12 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => false
recursive => false
limit => 15
offset => 0
Property Filters:

"http://www.taotesting.com/movies.rdf#year" => "2013"
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf'
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#year')->match('2013');

$Builder->setOffset(15);

echo $GateWay->search($Builder);
echo "\n";

echo "sample 13 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => false
recursive => false
order => http://www.w3.org/2000/01/rdf-schema#label
orderdir => "DESC"
limit => 15
offset => 0
Property Filters:

"http://www.taotesting.com/movies.rdf#year" => "2013"
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                                'defaultLanguage' => 'en-US',
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#year')->match('2013');

$Builder->sort(['http://www.w3.org/2000/01/rdf-schema#label' => 'desc'])->setOffset(15);

echo $GateWay->search($Builder);
echo "\n";

echo "sample 14 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => false
recursive => false
Property Filters:

"http://www.taotesting.com/movies.rdf#year" => "2013"
"http://www.taotesting.com/movies.rdf#directedBy" => "http://www.taotesting.com/movies.rdf#ValC3A9rieLemercier"
"http://www.taotesting.com/movies.rdf#starring" => "http://www.taotesting.com/movies.rdf#ValC3A9rieLemercier"
 */

$GateWay->setOptions([
                                'table'           => 'statements',
                                'driver'          => 'taoRdf',
                                'defaultLanguage' => 'en-US',
                            ]);
$Builder = $GateWay->query();
$Query = $Builder->criteria();
$Query->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')->equal('http://www.taotesting.com/movies.rdf#Movie');
$Query->add('http://www.taotesting.com/movies.rdf#year')->match('2013');
$Query->add('http://www.taotesting.com/movies.rdf#directedBy')->match('http://www.taotesting.com/movies.rdf#ValC3A9rieLemercier');
$Query->add('http://www.taotesting.com/movies.rdf#starring')->match('http://www.taotesting.com/movies.rdf#ValC3A9rieLemercier');

echo $GateWay->search($Builder);
echo "\n";

echo "sample 15 :\n";
/*
 * Target Class(es):

"http://www.taotesting.com/movies.rdf#Movie"
Options:

like => true
recursive => false
chaining => "or"
Property Filters:

"http://www.taotesting.com/movies.rdf#directedBy" => ("http://www.taotesting.com/movies.rdf#MartinScorsese", "http://www.taotesting.com/movies.rdf#QuentinTarantino")
"http://www.taotesting.com/movies.rdf#starring" => ("http://www.taotesting.com/movies.rdf#LeonardoDiCaprio", "http://www.taotesting.com/movies.rdf#ChristophWaltz")
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                                'defaultLanguage' => 'en-US',
                            ]);
$Builder = $GateWay->query()
        ->criteria()
        ->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')
        ->equal('http://www.taotesting.com/movies.rdf#Movie')
        ->andQuery()
        ->add('http://www.taotesting.com/movies.rdf#directedBy')
        ->equal("http://www.taotesting.com/movies.rdf#MartinScorsese")
        ->addOr("http://www.taotesting.com/movies.rdf#QuentinTarantino")
        ->orQuery()
        ->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')
        ->equal('http://www.taotesting.com/movies.rdf#Movie')
        ->andQuery()
        ->add('http://www.taotesting.com/movies.rdf#starring')
        ->equal("http://www.taotesting.com/movies.rdf#LeonardoDiCaprio")
        ->addOr("http://www.taotesting.com/movies.rdf#ChristophWaltz")
        ->getParent()
        ->builder();

echo $GateWay->search($Builder);
echo "\n";

echo "sample 16 :\n";
/*
 * search for  
 * movies directed by Martin Scorsese or Quentin Tarantino
 * OR
 * movies starring Leonardo DiCaprio or Christopher Waltz
 * 
 * sort by title descendant and year Ascendant
 * limit 10 offset 10
 */

$GateWay->setOptions([
                                'table'    => 'statements',
                                'driver'   => 'taoRdf',
                                'defaultLanguage' => 'en-US',
                            ]);
$Builder = $GateWay->query()
        ->criteria()
        ->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')
        ->equal('http://www.taotesting.com/movies.rdf#Movie')
        ->andQuery()
        ->add('http://www.taotesting.com/movies.rdf#directedBy')
        ->equal("http://www.taotesting.com/movies.rdf#MartinScorsese")
        ->addOr("http://www.taotesting.com/movies.rdf#QuentinTarantino")
        ->orQuery()
        ->add('http://www.w3.org/1999/02/22-rdf-syntax-ns#type')
        ->equal('http://www.taotesting.com/movies.rdf#Movie')
        ->andQuery()
        ->add('http://www.taotesting.com/movies.rdf#starring')
        ->equal("http://www.taotesting.com/movies.rdf#LeonardoDiCaprio")
        ->addOr("http://www.taotesting.com/movies.rdf#ChristophWaltz")
        ->getParent()->builder()
        ->sort([
            "http://www.w3.org/2000/01/rdf-schema#label" => 'desc',
            'http://www.taotesting.com/movies.rdf#year'  => 'asc'
            ])
        ->setOffset(10 , 10);

echo $GateWay->search($Builder);
echo "\n";