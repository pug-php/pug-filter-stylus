<?php

use Pug\Pug;

class ExamplesTest extends \PHPUnit_Framework_TestCase
{
    public function caseProvider()
    {
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
    public function testPugGeneration($htmlFile, $pugFile)
    {
        $pug = new Pug();
        $renderFile = method_exists($pug, 'renderFile')
            ? array($pug, 'renderFile')
            : array($pug, 'render');
        $renderedHtml = call_user_func($renderFile, $pugFile, array(
            'color' => 'yellow',
        ));
        $htmlFileContents = file_get_contents($htmlFile);

        $actual = str_replace('/>', '>', $renderedHtml);
        $expected = str_replace('/>', '>', $htmlFileContents);
        $actual = str_replace('_', '', strip_tags($actual));
        $expected = str_replace('_', '', strip_tags($expected));
        $actual = trim(preg_replace('`\s+`', ' ', $actual));
        $expected = trim(preg_replace('`\s+`', ' ', $expected));

        $this->assertSame($expected, $actual, $pugFile . ' should match ' . $htmlFile . ' as html');

        $actual = preg_replace('/<br[^>]*>/', "\n", $renderedHtml);
        $expected = preg_replace('/<br[^>]*>/', "\n", $htmlFileContents);
        $actual = str_replace('_', '', strip_tags($actual));
        $expected = str_replace('_', '', strip_tags($expected));
        $actual = trim(preg_replace('`\s+`', ' ', $actual));
        $expected = trim(preg_replace('`\s+`', ' ', $expected));

        $this->assertSame($expected, $actual, $pugFile . ' should match ' . $htmlFile . ' as text');
    }
}
