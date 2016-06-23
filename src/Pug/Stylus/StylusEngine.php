<?php

namespace Pug\Stylus;

use Stylus\Stylus;

class StylusEngine extends Stylus
{
    /**
     * insertVariables - inserts variables into the arguments or line if there are any
     *
     * @override
     *
     * @param string $args
     * @param bool $line true is $args is an entire line
     *
     * @return string string with available variables or with PHP getter tag
     */
    protected function insertVariables($args, $line = false) {
        if ($line) {
            preg_match('~^(\S+\s+)(.*)$~', $args, $matches);
            return $matches[1] . $this->insertVariables($matches[2]);
        }
        if (preg_match('~[,\s]~', $args)) {
            preg_match_all('~(\$|\b)[\$a-zA-Z_][\$a-zA-Z0-9_-]*(\$|\b)~', $args, $matches);

            foreach ($matches[0] as $arg) {
                if (isset($this->vars[$arg])) {
                    $reg = preg_quote($arg);
                    $args = preg_replace('~((?<=^|[^\$a-zA-Z0-9_-])' . $reg . '(?=$|[^\$a-zA-Z0-9_-]))|(\{' . $reg . '\})~', $this->vars[$arg], $args);
                }
            }
        } else if (isset($this->vars[$args])) {
            $args = $this->vars[$args];
        } else if(preg_match('~^\s*[\$a-zA-Z_][a-zA-Z0-9_]*\s*$~', $args) && !in_array(trim($args), array(
            'center',
            'top',
            'left',
            'bottom',
            'right',
            'middle',
            'bold',
            'underline',
            'none',
            'italic',
        ))) {
            $args = '<' . '?php echo isset($' . $args . ') ? $' . $args . ' : ' . var_export($args, true) . ' ?>';
        }

        return $args;
    }
}
