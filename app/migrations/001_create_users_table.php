<?php

class Create_users_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('users')) {
            return;
        }

        $this->_lava->dbforge
            ->add_field([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => TRUE,
                    'auto_increment' => TRUE,
                    'null'           => FALSE,
                ],
                'full_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                    'unique'     => TRUE,
                ],
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'role' => [
                    'type'       => 'ENUM',
                    'constraint' => "'admin','instructor','staff','trainee'",
                    'null'       => FALSE,
                    'default'    => 'trainee',
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'active','inactive','suspended'",
                    'null'       => FALSE,
                    'default'    => 'active',
                ],
                'qr_code' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => TRUE,
                ],
                'phone' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => TRUE,
                ],
                'address' => [
                    'type'       => 'TEXT',
                    'null'       => TRUE,
                ],
                'guardian_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => TRUE,
                ],
                'guardian_contact' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => TRUE,
                ],
                'created_at' => [
                    'type'    => 'DATETIME',
                    'null'    => FALSE,
                    'default' => 'CURRENT_TIMESTAMP',
                ],
                'updated_at' => [
                    'type'    => 'DATETIME',
                    'null'    => TRUE,
                    'default' => NULL,
                ],
            ])
            ->add_key('id', primary: TRUE)
            ->add_key('email', name: 'email_idx')
            ->add_key('role', name: 'role_idx')
            ->add_key('qr_code', name: 'qr_code_idx')
            ->create_table('users');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('users');
    }
}