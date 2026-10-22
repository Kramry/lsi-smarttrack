<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Trainee extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        require_role('trainee');
    }

    public function dashboard()
    {
        $data['title'] = 'Trainee Dashboard - LSI SmartTrack';
        $data['username'] = get_user_name();
        $data['role'] = get_user_role();
        $this->call->view('trainee/dashboard', $data);
    }
}
