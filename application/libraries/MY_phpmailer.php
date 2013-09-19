<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once ('PHPMailer/class.phpmailer.php');

class My_phpmailer extends PHPMailer {

    function __construct() {
        parent::__construct();
    }

}