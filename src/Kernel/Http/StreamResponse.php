<?php

/*
 * This file is part of the tuowt/Zhifu99\.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zhifu99\Kernel\Http;

use Zhifu99\Kernel\Exceptions\InvalidArgumentException;
use Zhifu99\Kernel\Support\File;

/**
 * Class StreamResponse.
 */
class StreamResponse extends Response
{
    /**
     * @param string $directory
     * @param string $filename
     *
     * @return bool|int
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidArgumentException
     */
    public function save($directory, $filename = '')
    {
        $this->getBody()->rewind();

        $directory = rtrim($directory, '/');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true); // @codeCoverageIgnore
        }

        if (!is_writable($directory)) {
            throw new InvalidArgumentException(sprintf("'%s' is not writable.", $directory));
        }

        $contents = $this->getBody()->getContents();

        if (empty($filename)) {
            if (preg_match('/filename="(?<filename>.*?)"/', $this->getHeaderLine('Content-Disposition'), $match)) {
                $filename = $match['filename'];
            } else {
                $filename = md5($contents);
            }
        }

        if (empty(pathinfo($filename, PATHINFO_EXTENSION))) {
            $filename .= File::getStreamExt($contents);
        }

        file_put_contents($directory.'/'.$filename, $contents);

        return $filename;
    }

    /**
     * @param string $directory
     * @param string $filename
     *
     * @return bool|int
     *
     * @throws \Zhifu99\Kernel\Exceptions\InvalidArgumentException
     */
    public function saveAs($directory, $filename)
    {
        return $this->save($directory, $filename);
    }
}
