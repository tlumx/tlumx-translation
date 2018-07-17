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

use Tlumx\Translation\Loader\Ini;

class IniTest extends \PHPUnit\Framework\TestCase
{
    protected $loaderResouceDir;

    protected function setUp()
    {
        $this->loaderResouceDir = dirname(__DIR__).DIRECTORY_SEPARATOR.
                'resources'.DIRECTORY_SEPARATOR .'loader'.DIRECTORY_SEPARATOR;
    }

    public function testImplements()
    {
        $loader = new Ini();
        $this->assertInstanceOf('Tlumx\Translation\Loader\LoaderInterface', $loader);
    }

    public function testInvalidFilename()
    {
        $filename = $this->loaderResouceDir.'some.ini';
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Could not open file %s for reading',
            $filename
        ));
        $loader = new Ini();
        $loader->load($filename);
    }

    public function testInvalidIni()
    {
        $filename = $this->loaderResouceDir.'InvalidIniTranslation.ini';
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Error reading INI file');
        $loader = new Ini();
        $loader->load($filename);
    }

    public function testLoader()
    {
        $filename = $this->loaderResouceDir.'IniTranslation.ini';
        $loader = new Ini();
        $messages = $loader->load($filename);
        $this->assertEquals($messages, ['hello' => 'hello']);
    }
}
