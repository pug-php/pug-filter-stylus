<?php

namespace Pug\Filter;

use Jade\Compiler;
use Jade\Filter\AbstractFilter;
use Jade\Nodes\Filter;
use NodejsPhpFallback\Stylus as StylusWrapper;
use Pug\Stylus\StylusEngine as StylusPhpEngine;

class Stylus extends AbstractFilter
{
    protected $tag = 'style';
    protected $textType = 'css';

    public function parse($code)
    {
        return new StylusWrapper(preg_replace('/<\?php.*\?>/', '@css {$0}', $code));
    }
}
