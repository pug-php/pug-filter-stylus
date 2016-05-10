<?php

namespace Jade\Filter;

use Jade\Compiler;
use Jade\Nodes\Filter;
use Jade\Stylus\StylusEngine as StylusEngine;

class Stylus extends AbstractFilter
{
    public function __invoke(Filter $node, Compiler $compiler)
    {
        $nodes = $node->block->nodes;
        $indent = strlen($nodes[0]->value) - strlen(ltrim($nodes[0]->value));
        $code = '';
        foreach ($nodes as $line) {
            $code .= substr($line->value, $indent) . "\n";
        }
        $stylus = new StylusEngine();

        return '<style type="text/css">' . $stylus->fromString($code)->toString() . '</style>';
    }
}
