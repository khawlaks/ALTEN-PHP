<?php

session_start();
session_destroy();
 header('Location: ..\assets\auth\auth-sign-in.php');
exit;
