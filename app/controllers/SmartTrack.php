
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class SmartTrack extends Controller
{
    public function index()
    {
        $data['title'] = 'LSI SmartTrack';
        $this->call->view('smarttrack_home', $data);
    }
}
