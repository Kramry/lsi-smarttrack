<?php

class Create_training_programs_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('training_programs')) {
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
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'description' => [
                    'type' => 'TEXT',
                    'null' => TRUE,
                ],
                'duration_hours' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'null'       => TRUE,
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'active','inactive'",
                    'null'       => FALSE,
                    'default'    => 'active',
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
            ->add_key('status', name: 'status_idx')
            ->create_table('training_programs');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('training_programs');
    }
}
