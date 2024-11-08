<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Curl {

    protected $ch;

    public function __construct() {
        $this->ch = curl_init();
    }

    public function create($url) {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function options($options = array()) {
        curl_setopt_array($this->ch, $options);
    }

    public function execute() {
        $response = curl_exec($this->ch);
        if(curl_errno($this->ch)) {
            return array('error' => curl_error($this->ch));
        }
        return array('response' => $response);
    }

    public function close() {
        curl_close($this->ch);
    }

    public function error() {
        return curl_error($this->ch);
    }

    public function error_code() {
        return curl_errno($this->ch);
    }
}
