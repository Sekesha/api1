<?php

require_once ROOT.'/components/HelperFunc.php';

class UserController
{
        public static function checkAuth(){

            if (!isset($_SERVER['PHP_AUTH_USER'])){
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 401, false, 'Not authorized');
            }else{
                return true;
            }
            return false;
        }
}