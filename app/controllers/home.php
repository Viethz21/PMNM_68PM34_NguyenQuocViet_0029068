<?php

require_once '../app/core/Controller.php';


class home extends Controller
{
    public function index()
    {
        $this->view(
            'layout/masterlayout',
            [
                'viewname' => 'home/index',
                'title' => 'Dashboard'
            ]
        );
    }

    public function login()
    {
        require_once "../app/views/home/login.php";
    }

    public function logout()
    {
        require_once "../app/views/home/logout.php";
    }
}
?>