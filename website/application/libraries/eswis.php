<?php

require_once('login_helper.php');

class eswis extends LoginInterface {
    private $login_url = 'http://eswis.gdut.edu.cn/default.aspx';
    private $key = null;


    private function get_session_form() {
        $ret = $this->request($this->login_url);
        $html = $ret['body'];

        $session = array(
            '__EVENTTARGET' => '',
            '__EVENTARGUMENT' => ''
        );
        preg_match('/__EVENTVALIDATION" value="([^\"]*)/', $html, $val);
        $session['__EVENTVALIDATION'] = $val[1];
        preg_match('/__VIEWSTATE" value="([^\\"]*)/', $html, $val);
        $session['__VIEWSTATE'] = $val[1];
        preg_match('/__PREVIOUSPAGE" value="([^\\"]*)/', $html, $val);
        $session['__PREVIOUSPAGE'] = $val[1];

        return $session;
    }

    private function check_login($body) {
        if (preg_match('/ctl00_msg_logon" class="msgstr">([^<]+)</',
            $body, $ret)) {
            return $ret[1];
        }
        return false;
    }

    private function get_session_id($body) {
        if (preg_match('/ASP.NET_SessionId=([0-9a-z]+)/', $body, $ret)) {
            return $ret[1];
        }
        return null;
    }

    private function get_key($body) {
        if (preg_match('/\?key=([0-9a-zA-Z]+)/', $body, $ret)) {
            return $ret[1];
        }
        return null;
    }

    public function login($username, $password) {
        $session_form = $this->get_session_form();
        $session_form['ctl00$log_username'] = $username;
        $session_form['ctl00$log_password'] = $password;
        $session_form['ctl00$logon'] = '登录';

        $ret = $this->request($this->login_url, $session_form);
        $err = $this->check_login($ret['body']);
        //if ($err=='密码不正确'||$err=='用户名不存在') {
            // throw new LoginException($err);
            //return $err;
        //}

        $session_id = $this->get_session_id($ret['body']);
        if (!$session_id) {
            // throw new LoginException('Session ID not found');
            return '用户名或密码错误！';
        }
        $this->session_id = $session_id;

        $key = $this->get_key($ret['body']);
        if (!$key) {
            // throw new LoginException('Key not found');
            return '用户名或密码错误！';
        }
        $this->key = $key;

        return array(
            'session_id' => $session_id,
            'key' => $key
        );
    }

    private function parse_information($re, $body) {
        if (!preg_match($re, $body, $val)) {
            // throw new GetInfoException();
            return "Get student infomation failed";
        }
        return $val[1];
    }

    public function get_info($session_id, $key) {
        $url = 'http://eswis.gdut.edu.cn/opt_xxhz.aspx?key=' . $key;
        $ret = $this->request($url, null, $session_id);
        $body = $ret['body'];

        $info = array(
            'name' => $this->parse_information(
                '/ctl00_cph_right_inf_xm">([^<]+)</', $body),
            'stu_id' => $this->parse_information(
                '/ctl00_cph_right_inf_xh">([^<]+)</', $body)
        );
        $details = explode(' ', $this->parse_information(
            '/ctl00_cph_right_inf_dw">([^<]+)</', $body
        ));
        $info['campus'] = $details[0];
        $info['faculty'] = $details[1];
        $info['major'] = $details[2];
        $info['grade'] = $details[3];
        $info['class'] = $details[4];

        return $info;
    }
}
