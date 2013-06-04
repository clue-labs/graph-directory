<?php

use Fhaculty\Graph\Graph;

class DirectoryBuilder
{
    private $graph;
    
    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }
    
    public function createFromIterator(Iterator $iterator)
    {
        foreach ($iterator as $one) {
            $this->graph->createVertex($one);
        }
    }
    
    public function createFromPath($path)
    {
        $path = realpath($path);
        $name = basename($path);
        
        if (is_dir($path)) {
            $path = rtrim($path, '/') . '/';
            $name = rtrim($name, '/') . '/';
        }
        
        $vertex = $this->graph->createVertex($path);
        $vertex->setLayoutAttribute('label', $name);
        
        if (is_dir($path)) {
            foreach (glob($path . '*') as $sub) {
                $v = $this->createFromPath($sub);
                $vertex->createEdgeTo($v);
            }
        }
        
        return $vertex;
    }
}
