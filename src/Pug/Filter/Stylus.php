<?php

namespace Pug\Filter;

use NodejsPhpFallback\Stylus as StylusWrapper;

class Stylus extends AbstractFilter
{
    protected $tag = 'style';
    protected $textType = 'css';

    public function parse($code)
    {
        $code = preg_replace('/#\{\$?(.*?)\}/', '<?php echo $$1; ?>', $code);
        $code = preg_replace('/<\?php[\s\S]*?\?>/', '@css {$0}', $code);

        return new StylusWrapper($code);
    }
}
