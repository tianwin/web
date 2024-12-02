<?php
/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2020 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  License details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.opensource.org/licenses/OSL-3.0>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade AbanteCart to newer
   versions in the future. If you wish to customize AbanteCart for your
   needs please refer to http://www.AbanteCart.com for more information.
------------------------------------------------------------------------------*/

/**
 * Class ASession
 */
final class ASession
{
    public $registry = null;
    public $data = [];
    public $ses_name = SESSION_ID;

    /**
     * @param string $ses_name
     */
    public function __construct($ses_name = '')
    {

        if (class_exists('Registry')) {
            $this->registry = Registry::getInstance();
        }

        if (!session_id() || has_value($ses_name)) {
            $this->ses_name = $ses_name;
            $this->init($this->ses_name);
        }

        if ($this->registry && $this->registry->get('config')) {
            $session_ttl = $this->registry->get('config')->get('config_session_ttl');
            if ((isset($_SESSION['user_id']) || isset($_SESSION['customer_id']))
                && isset($_SESSION['LAST_ACTIVITY'])
                && ((time() - $_SESSION['LAST_ACTIVITY']) / 60 > $session_ttl)
            ) {
                // last request was more than 30 minutes ago
                $this->clear();
                redirect($this->registry->get('html')->currentURL(['token']));
            }
        }
        // update last activity time stamp
        $_SESSION['LAST_ACTIVITY'] = time();
        $this->data =& $_SESSION;
    }

    /**
     * @param string $session_name
     */
    public function init($session_name)
    {
        $session_mode = '';
        if (defined('IS_API') && IS_API === true) {
            //set up session specific for API based on the token or create new
            $token = '';
            if ($_GET['token']) {
                $token = $_GET['token'];
            } else {
                if ($_POST['token']) {
                    $token = $_POST['token'];
                }
            }
            $final_session_id = $this->_prepare_session_id($token);
            session_id($final_session_id);
        } else {
            if (!headers_sent()) {
                $this->setCookie();
                session_name($session_name);
                // for shared ssl domain set session id of non-secure domain
                if ($this->registry && $this->registry->get('config')) {
                    if ($this->registry->get('config')->get('config_shared_session') && isset($_GET['session_id'])) {
                        header('P3P: CP="CAO COR CURa ADMa DEVa OUR IND ONL COM DEM PRE"');
                        session_id($_GET['session_id']);
                        $this->setCookie($session_name, $_GET['session_id']);
                    }
                }

                if (defined('EMBED_TOKEN_NAME') && isset($_GET[EMBED_TOKEN_NAME]) && !isset($_COOKIE[$session_name])) {
                    //check and reset session if it is not valid
                    $final_session_id = $this->_prepare_session_id($_GET[EMBED_TOKEN_NAME]);
                    session_id($final_session_id);
                    $this->setCookie($session_name, $final_session_id);
                    $session_mode = 'embed_token';
                }
            }
        }

        //check if session can not be started. Try one more time with new generated session ID
        if (!headers_sent()) {
            $is_session_ok = session_start();
            if (!$is_session_ok) {
                //auto generating session id and try to start session again
                $final_session_id = $this->_prepare_session_id();
                session_id($final_session_id);
                $this->setCookie($session_name, $final_session_id);
                session_start();
            }
        }

        $_SESSION['session_mode'] = $session_mode;
    }

    public function clear()
    {
        @session_unset();
        @session_destroy();
        $_SESSION = [];
    }

    /**
     * This function to return clean validated session ID
     *
     * @param string $session_id
     *
     * @return string
     */
    private function _prepare_session_id($session_id = '')
    {
        if (!$session_id || !$this->_is_session_id_valid($session_id)) {
            //if session ID is invalid, generate new one
            $session_id = uniqid(substr(UNIQUE_ID, 0, 4), true);
            return preg_replace("/[^-,a-zA-Z0-9]/", '', $session_id);
        } else {
            return $session_id;
        }
    }

    /**
     * This function is to validate session id
     *
     * @param string $session_id
     *
     * @return bool
     */
    private function _is_session_id_valid($session_id)
    {
        if (empty($session_id)) {
            return false;
        } else {
            return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $session_id) > 0;
        }
    }

    private function setCookie($name = null, $value = null)
    {
        setCookieOrParams(
            $name,
            $value,
            [
                'path'     => dirname($_SERVER['PHP_SELF']),
                'domain'   => null,
                'secure'   => (defined('HTTPS') && HTTPS),
                'httponly' => true,
                //NOTE: lax mode blocks transferring of cookie when redirecting from another domain
                'samesite' => (defined('HTTPS') && HTTPS) ? 'None' : 'lax',
                'lifetime' => 0,
            ]
        );
    }
}