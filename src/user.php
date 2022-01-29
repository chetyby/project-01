<?php

namespace App;

use App\classes\App;

require '../vendor/autoload.php';
App::getAuth()->requireRole('user', 'admin');
?>
Page reservée au user;