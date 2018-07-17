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
 * Csv translation loader class.
 */
class Csv implements LoaderInterface
{
    /**
     * @var string
     */
    private $delimiter = ';';

    /**
     * @var string
     */
    private $enclosure = '"';

    /**
     * @var string
     */
    private $escape    = '\\';

    /**
     * Load translation messages from csv file
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

        $handle = fopen($filename, 'rb');
        if (!$handle) {
            throw new \InvalidArgumentException(sprintf('Could not open file %s for reading', $filename));
        }

        $messages = [];
        while (($line = fgetcsv($handle, 0, $this->delimiter, $this->enclosure, $this->escape)) !== false) {
            if (substr($line[0], 0, 1) === '#') {
                continue;
            }

            if (count($line) == 2) {
                $messages[$line[0]] = (isset($line[1])) ? $line[1] : $line[0];
            }
        }

        return $messages;
    }
}
