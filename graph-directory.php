<?php

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/DirectoryBuilder.php';

use Fhaculty\Graph\GraphViz;
use Fhaculty\Graph\Graph;

$path = './';

$graph = new Graph();
$builder = new DirectoryBuilder($graph);

$builder->createFromPath($path);

var_dump($graph->getNumberOfVertices());

$graphviz = new GraphViz($graph);
$graphviz->setLayout(GraphViz::LAYOUT_VERTEX, 'shape', 'rect');
$graphviz->setFormat('svg');
$graphviz->display();
