<?php
    class logoutController {

        public function show() {
            sessionStart ();
            $_SESSION['token']='';
            session_destroy();
            header("Location: login");
        }
    }