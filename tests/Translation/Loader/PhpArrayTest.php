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

use Tlumx\Translation\Loader\PhpArray;

class PhpArrayTest extends \PHPUnit\Framework\TestCase
{
    protected $loaderResouceDir;

    protected function setUp()
    {
        $this->loaderResouceDir = dirname(__DIR__).DIRECTORY_SEPARATOR.
                'resources'.DIRECTORY_SEPARATOR .'loader'.DIRECTORY_SEPARATOR;
    }

    public function testImplements()
    {
        $loader = new PhpArray();
        $this->assertInstanceOf('Tlumx\Translation\Loader\LoaderInterface', $loader);
    }

    public function testInvalidFilename()
    {
        $filename = $this->loaderResouceDir.'some.php';
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Could not open file %s for reading',
            $filename
        ));
        $loader = new PhpArray();
        $loader->load($filename);
    }

    public function testInvalidReturnArray()
    {
        $filename = $this->loaderResouceDir.'InvalidPhpArrayTranslation.php';
        $messages = include $filename;
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Expected an array, but received %s',
            gettype($messages)
        ));
        $loader = new PhpArray();
        $loader->load($filename);
    }

    public function testLoader()
    {
        $filename = $this->loaderResouceDir.'PhpArrayTranslation.php';
        $loader = new PhpArray();
        $messages = $loader->load($filename);
        $this->assertEquals($messages, ['hello' => 'hello']);
    }
}
