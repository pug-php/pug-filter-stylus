<?php

use Pug\Pug;

class ExamplesTest extends \PHPUnit_Framework_TestCase {

    public function caseProvider() {

        $cases = array();

        $examples = __DIR__ . '/../examples';
        foreach (scandir($examples) as $file) {
            if (substr($file, -4) === '.pug') {
                $cases[] = array($examples . '/' . substr($file, 0, -4) . '.html', $examples . '/' . $file);
            }
        }

        return $cases;
    }

    protected function simplifyHtml($html)
    {
        return trim(str_replace('#ff0', 'yellow', preg_replace('`\s+`', '', $html)));
    }

    protected function simplifyText($html)
    {
        return trim(str_replace('#ff0', 'yellow', preg_replace('`\s+`', ' ', strip_tags($html))));
    }

    /**
     * @dataProvider caseProvider
     */
    public function testPugGeneration($htmlFile, $pugFile) {

        $pug = new Pug();
        $renderedHtml = $pug->render($pugFile, array(
            'color' => 'yellow',
        ));
        $htmlFileContents = file_get_contents($htmlFile);

        $actual = static::simplifyHtml($renderedHtml);
        $expected = static::simplifyHtml($htmlFileContents);

        $this->assertSame($expected, $actual, $pugFile . ' should match ' . $htmlFile . ' as html');

        $actual = static::simplifyText($renderedHtml);
        $expected = static::simplifyText($htmlFileContents);

        $this->assertSame($expected, $actual, $pugFile . ' should match ' . $htmlFile . ' as text');
    }
}
