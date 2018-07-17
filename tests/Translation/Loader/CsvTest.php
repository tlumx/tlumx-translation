<?php
/**
 * Tlumx (https://tlumx.com/)
 *
 * @author    Yaroslav Kharitonchuk <yarik.proger@gmail.com>
 * @link      https://github.com/tlumx/tlumx-servicecontainer
 * @copyright Copyright (c) 2016-2018 Yaroslav Kharitonchuk
 * @license   https://github.com/tlumx/tlumx-servicecontainer/blob/master/LICENSE  (MIT License)
 */
namespace Tlumx\Tests\Translation;

use Tlumx\Translation\Loader\Csv;

class CsvTest extends \PHPUnit\Framework\TestCase
{
    protected $loaderResouceDir;

    protected function setUp()
    {
        $this->loaderResouceDir = dirname(__DIR__).DIRECTORY_SEPARATOR.
                'resources'.DIRECTORY_SEPARATOR .'loader'.DIRECTORY_SEPARATOR;
    }

    public function testImplements()
    {
        $loader = new Csv();
        $this->assertInstanceOf('Tlumx\Translation\Loader\LoaderInterface', $loader);
    }

    public function testInvalidFilename()
    {
        $filename = $this->loaderResouceDir .'some.csv';
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Could not open file %s for reading',
            $filename
        ));
        $loader = new Csv();
        $loader->load($filename);
    }

    public function testLoader()
    {
        $filename = $this->loaderResouceDir .'CsvTranslation.csv';
        $loader = new Csv;
        $messages = $loader->load($filename);
        $this->assertEquals($messages, [
            'transl' => 'transl',
            'transl2' => 'transl transl',
            'transl;transl' => 'transl'

        ]);
    }
}
