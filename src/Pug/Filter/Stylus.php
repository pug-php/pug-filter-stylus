<?php

namespace Pug\Filter;

use Jade\Filter\AbstractFilter;
use NodejsPhpFallback\Stylus as StylusWrapper;

class Stylus extends AbstractFilter
{
    protected $tag = 'style';
    protected $textType = 'css';

    public function parse($code)
    {
        return new StylusWrapper(preg_replace('/<\?php.*\?>/', '@css {$0}', $code));
    }
}
