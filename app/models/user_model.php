<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id';
    protected $fillable = ['full_name', 'email', 'password', 'role', 'status'];

    /**
     * Get user by email
     */
    public function get_user_by_email($email)
    {
        return $this->db->table($this->table)
                       ->where('email', $email)
                       ->get();
    }

    /**
     * Get user by ID
     */
    public function get_user_by_id($id)
    {
        return $this->db->table($this->table)
                       ->where('id', $id)
                       ->get();
    }

    /**
     * Create a new user with hashed password
     */
    public function create_user($data)
    {
        // Hash the password before storing
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->db->table($this->table)->insert($data);
    }

    /**
     * Update user
     */
    public function update_user($id, $data)
    {
        // Hash password if it's being updated
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->db->table($this->table)
                       ->where('id', $id)
                       ->update($data);
    }

    /**
     * Verify user credentials
     */
    public function verify_credentials($email, $password)
    {
        $user = $this->get_user_by_email($email);

        if ($user && password_verify($password, $user['password'])) {
            // Check if user is active
            if ($user['status'] === 'active') {
                return $user;
            }
        }

        return false;
    }
}
