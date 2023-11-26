<?php
    class Util {
        public static function SessionStart() {
            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
    }
?>