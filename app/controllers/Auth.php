<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('user_model');
        $this->call->library('session');
    }

    public function login()
    {
        $data['title'] = 'Login - LSI SmartTrack';
        $data['error'] = '';

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['username'] ?? ''; // Using username field for email
            $password = $_POST['password'] ?? '';

            // Verify credentials
            $user = $this->user_model->verify_credentials($email, $password);

            if ($user) {
                // Set session data
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['full_name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                // Redirect based on role
                switch ($user['role']) {
                    case 'admin':
                        redirect('admin/dashboard');
                        break;
                    case 'instructor':
                        redirect('instructor/dashboard');
                        break;
                    case 'staff':
                        redirect('staff/dashboard');
                        break;
                    case 'trainee':
                    default:
                        redirect('trainee/dashboard');
                        break;
                }
            } else {
                $data['error'] = 'Invalid email or password';
            }
        }

        $this->call->view('login', $data);
    }

    public function logout()
    {
        // Destroy session
        session_destroy();
        redirect('login');
    }

    public function register()
    {
        $data['title'] = 'Register - LSI SmartTrack';
        $data['error'] = '';
        $data['success'] = '';

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = $_POST['full_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? 'trainee';

            // Validation
            if (empty($full_name) || empty($email) || empty($password)) {
                $data['error'] = 'All fields are required';
            } elseif ($password !== $confirm_password) {
                $data['error'] = 'Passwords do not match';
            } elseif (strlen($password) < 6) {
                $data['error'] = 'Password must be at least 6 characters';
            } else {
                // Check if email already exists
                $existing_user = $this->user_model->get_user_by_email($email);
                if ($existing_user) {
                    $data['error'] = 'Email already registered';
                } else {
                    // Create user
                    $user_data = [
                        'full_name' => $full_name,
                        'email' => $email,
                        'password' => $password,
                        'role' => $role,
                        'status' => 'active'
                    ];

                    if ($this->user_model->create_user($user_data)) {
                        $data['success'] = 'Registration successful! Please login.';
                    } else {
                        $data['error'] = 'Registration failed. Please try again.';
                    }
                }
            }
        }

        $this->call->view('register', $data);
    }
}
