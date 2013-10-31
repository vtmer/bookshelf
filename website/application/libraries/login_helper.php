<?php

function array2post_form($arr) {
    $form = '';
    foreach ($arr as $key => $value) {
        $form .= urlencode($key) . '=' . urlencode($value) . '&';
    }
    return rtrim($form, '&');
}

class CURLException extends Exception {
    protected $message = 'CURL execute error';
}

class LoginException extends Exception {
    protected $message = 'Login failed';
}

class GetInfoException extends Exception {
    protected $message = 'Get student infomation failed';
}

/*
 * Every sub-class inherits from this class should implement
 * its own `login` and `get_info` method.
 *
 * Originally code toke from http://t.cn/zQx3h1v,
 * also inspired by http://gdutexchange.com/reg.
 */
class LoginInterface {
    protected $username;
    protected $password;
    protected $ua = 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)';
    protected $timeout = 10;
    protected $session_cookie_name = 'ASP.NET_SessionId';
    protected $session_id = null;

    /*
     * make a HTTP request
     *
     * :param url: request url
     * :param form: request form, if any, use POST rather than GET
     * :param session_id: session id that will be carried as cookie
     */
    protected function request($url, $form = false, $session_id = false) {
        $starttime = microtime();

        // init curl
        $conn = curl_init();
        curl_setopt($conn, CURLOPT_URL, $url);
        curl_setopt($conn, CURLOPT_VERBOSE, 0);
        curl_setopt($conn, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_USERAGENT, $this->ua);
        // follow 302
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        // HTTP redirect
        curl_setopt($conn, CURLOPT_MAXREDIRS, 7);
        curl_setopt($conn, CURLOPT_HEADER, 1);

        // carry session id
        if ($session_id) {
            curl_setopt($conn, CURLOPT_COOKIESESSION, true);
            curl_setopt($conn, CURLOPT_COOKIE,
                $this->session_cookie_name . '=' . $session_id);
        }

        // carry post form
        if ($form) {
            if (is_array($form)) {
                $form = array2post_form($form);
            }
            curl_setopt($conn, CURLOPT_POST, 1);
            curl_setopt($conn, CURLOPT_POSTFIELDS, $form);
        }

        // execute
        $content = curl_exec($conn);
        $endtime = microtime();
        if ($content === false) {
            throw new CURLException(curl_error($conn));
        }

        // get response header
        $header = curl_getinfo($conn);

        curl_close($conn);

        return array(
            'duration' => $endtime - $starttime,
            'header' => $header,
            'body' => $content
        );
    }

    /*
     * Do user login and return a session id
     */
    protected function login() {
        return null;
    }

    /*
     * Get student infomation
     */
    public function get_info() {
        return null;
    }
}
