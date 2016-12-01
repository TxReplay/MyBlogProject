<?php

session_start();

require_once 'config/parameters.php';
require_once 'config/routing.php';
require_once 'config/functions.php';

my_connect();

include_once 'controller/base.php';

if (file_exists('controller/'.$action.'.php')) {
    include_once 'controller/'.$action.'.php';
}

$role_user = (isset($user) && !is_null($user) ? $user['role_id'] : 5);

if (array_key_exists('min_access', $action_params)) {
    if (intval($action_params['min_access']) >= intval($role_user)) {
        var_dump($action_params['min_access'], intval($role_user));
    } else {
        $message = [
            'type' => 'error',
            'title' => 'Accès refusé',
            'text' => 'Désolé, vous ne disposez pas des autorisations nécessaires.'
        ];

        $template = 'homepage';
    }
}

include_once 'views/'.$layout.'.php';