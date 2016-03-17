<?php

namespace Jade\Filter;

use Jade\Compiler;
use Jade\Nodes\Filter;
use Jade\Stylus\StylusEngine as StylusEngine;

class Stylus extends AbstractFilter
{
    public function __invoke(Filter $node, Compiler $compiler)
    {
        $stylus = new StylusEngine();
        $code = $this->getNodeString($node, $compiler);

        return '<style type="text/css">' . $stylus->fromString($code)->toString() . '</style>';
    }
}
