<?php
    session_start(); //Use this once to start session to store local variables
    
    function setMessageAndRedirect($message, $className, $redirectTo){
        $_SESSION['message'] = $message;
        $_SESSION['className'] = $className;

        header("Location: " . $redirectTo);
        exit();
    }

    function getMessage(){
        if(isset($_SESSION['message'])){
            echo 
                '<div class="alert alert-' . $_SESSION['className'] . '" role="alert">' . 
                    $_SESSION['message'] .
                '</div>';
            
            unset($_SESSION['message']);
            unset($_SESSION['className']);
        }
    }