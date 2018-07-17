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
 * Ini translation loader class.
 */
class Ini implements LoaderInterface
{
    /**
     * Load translation messages from ini file
     *
     * @param string $filename
     * @return array
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function load($filename)
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw new \InvalidArgumentException(sprintf('Could not open file %s for reading', $filename));
        }

        try {
            $messages = parse_ini_file($filename, false);
        } catch (\Exception $e) {
            throw new \RuntimeException('Error reading INI file');
        }

        return $messages;
    }
}
