<?php

namespace App;

use App\classes\App;

require '../vendor/autoload.php';

$user = App::getAuth()->requireRole('admin');

?>
Page reservée á l'admin