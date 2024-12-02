<?php

/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2021 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  License details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.opensource.org/licenses/OSL-3.0>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade AbanteCart to newer
   versions in the future. If you wish to customize AbanteCart for your
   needs please refer to http://www.AbanteCart.com for more information.
------------------------------------------------------------------------------*/
if (!defined('DIR_CORE')) {
    header('Location: static_pages/');
}

/**
 * Class ALog
 */
final class ALog
{
    private $filename;
    private $mode = true;

    /**
     * @param string $filename
     *
     * @throws AException
     */
    public function __construct($filename)
    {
        if (is_dir($filename)) {
            $filename .= (substr($filename, -1) != '/' ? '/' : '').'error.txt';
        }
        $this->filename = $filename;

        if (!is_writable(pathinfo($filename, PATHINFO_DIRNAME))) {
            // if it happens see errors in httpd error log!
            throw new AException (
                AC_ERR_LOAD, 'Error: Log directory '.DIR_LOGS.' is non-writable. Please change permissions.'
            );
        }

        //1.create file if it not exists
        if (!file_exists($this->filename)) {
            $handle = @fopen($this->filename, 'a+');
            @fclose($handle);
        } else {
            if (!is_writable($this->filename)) {
                //create second log file if original is not writable
                $this->filename = DIR_LOGS.'error_0.txt';
                $handle = @fopen($this->filename, 'a+');
                @fclose($handle);
            }
        }

        if (class_exists('Registry')) {
            // for disabling via settings
            $registry = Registry::getInstance();
            if (is_object($registry->get('config'))) {
                $this->mode = $registry->get('config')->get('config_error_log') ? true : false;
            }
        }
    }

    /**
     * @param string $message
     *
     * @return null
     */
    public function write($message)
    {
        if (!$this->mode || trim($message) === '') {
            return;
        }
        $file = $this->filename;
        $handle = fopen($file, 'a+');
        fwrite($handle, date('Y-m-d G:i:s').' - '.$message."\n");
        fclose($handle);
    }
}
