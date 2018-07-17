<?php
/**
 * Tlumx (https://tlumx.com/)
 *
 * @author    Yaroslav Kharitonchuk <yarik.proger@gmail.com>
 * @link      https://github.com/tlumx/tlumx-servicecontainer
 * @copyright Copyright (c) 2016-2018 Yaroslav Kharitonchuk
 * @license   https://github.com/tlumx/tlumx-servicecontainer/blob/master/LICENSE  (MIT License)
 */
namespace Tlumx\Translation\Loader;

/**
 * Php array translation loader class.
 */
class PhpArray implements LoaderInterface
{
    /**
     * Loads messages from an php array file
     *
     * @param string $filename
     * @return array
     * @throws \InvalidArgumentException
     */
    public function load($filename)
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw new \InvalidArgumentException(sprintf('Could not open file %s for reading', $filename));
        }

        $messages = include $filename;
        if (!is_array($messages)) {
            throw new \InvalidArgumentException(sprintf('Expected an array, but received %s', gettype($messages)));
        }

        return $messages;
    }
}
