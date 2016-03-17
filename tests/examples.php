<?php

use Jade\Jade;

class ExamplesTest extends \PHPUnit_Framework_TestCase {

    public function caseProvider() {

        $cases = array();

        $examples = __DIR__ . '/../examples';
        foreach (scandir($examples) as $file) {
            if (substr($file, -5) === '.jade') {
                $cases[] = array($examples . '/' . substr($file, 0, -5) . '.html', $examples . '/' . $file);
            }
        }

        return $cases;
    }

    /**
     * @dataProvider caseProvider
     */
    public function testJadeGeneration($htmlFile, $jadeFile) {

        $jade = new Jade();
        $renderedHtml = $jade->render($jadeFile, array(
            'color' => 'yellow',
        ));
        $htmlFileContents = file_get_contents($htmlFile);

        $actual = trim(preg_replace('`\s+`', '', $renderedHtml));
        $expected = trim(preg_replace('`\s+`', '', $htmlFileContents));

        $this->assertSame($expected, $actual, $jadeFile . ' should match ' . $htmlFile . ' as html');

        $actual = trim(preg_replace('`\s+`', ' ', strip_tags($renderedHtml)));
        $expected = trim(preg_replace('`\s+`', ' ', strip_tags($htmlFileContents)));

        $this->assertSame($expected, $actual, $jadeFile . ' should match ' . $htmlFile . ' as text');
    }
}
