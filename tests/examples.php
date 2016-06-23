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

    /**
     * @dataProvider caseProvider
     */
    public function testPugGeneration($htmlFile, $pugFile) {

        $pug = new Pug();
        $renderedHtml = $pug->render($pugFile, array(
            'color' => 'yellow',
        ));
        $htmlFileContents = file_get_contents($htmlFile);

        $actual = trim(preg_replace('`\s+`', '', $renderedHtml));
        $expected = trim(preg_replace('`\s+`', '', $htmlFileContents));

        $this->assertSame($expected, $actual, $pugFile . ' should match ' . $htmlFile . ' as html');

        $actual = trim(preg_replace('`\s+`', ' ', strip_tags($renderedHtml)));
        $expected = trim(preg_replace('`\s+`', ' ', strip_tags($htmlFileContents)));

        $this->assertSame($expected, $actual, $pugFile . ' should match ' . $htmlFile . ' as text');
    }
}
