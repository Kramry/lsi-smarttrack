<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Instructor extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        require_role('instructor');
    }

    public function dashboard()
    {
        $data['title'] = 'Instructor Dashboard - LSI SmartTrack';
        $data['username'] = get_user_name();
        $data['role'] = get_user_role();
        $this->call->view('instructor/dashboard', $data);
    }
}
