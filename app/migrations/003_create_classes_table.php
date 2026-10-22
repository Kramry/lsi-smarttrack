<?php

class Create_classes_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('classes')) {
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
                'program_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'instructor_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'start_date' => [
                    'type' => 'DATE',
                    'null' => FALSE,
                ],
                'end_date' => [
                    'type' => 'DATE',
                    'null' => FALSE,
                ],
                'schedule' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => TRUE,
                ],
                'max_capacity' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'null'       => TRUE,
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'active','completed','cancelled'",
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
            ->add_key('program_id', name: 'program_id_idx')
            ->add_key('instructor_id', name: 'instructor_id_idx')
            ->add_key('status', name: 'status_idx')
            ->create_table('classes');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('classes');
    }
}
