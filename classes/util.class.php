<?php
    class Util {
        public static function SessionStart() {
            if(isset($_SESSION)) {
                session_start();
            }
        }
    }
?>