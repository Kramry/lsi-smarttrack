<?php

class Create_activity_logs_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('activity_logs')) {
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
                'user_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => TRUE,
                ],
                'action' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => FALSE,
                ],
                'entity_type' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => TRUE,
                ],
                'entity_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => TRUE,
                ],
                'description' => [
                    'type' => 'TEXT',
                    'null' => TRUE,
                ],
                'ip_address' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 45,
                    'null'       => TRUE,
                ],
                'user_agent' => [
                    'type' => 'TEXT',
                    'null' => TRUE,
                ],
                'previous_hash' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 64,
                    'null'       => TRUE,
                ],
                'current_hash' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 64,
                    'null'       => TRUE,
                ],
                'created_at' => [
                    'type'    => 'DATETIME',
                    'null'    => FALSE,
                    'default' => 'CURRENT_TIMESTAMP',
                ],
            ])
            ->add_key('id', primary: TRUE)
            ->add_key('user_id', name: 'user_id_idx')
            ->add_key('action', name: 'action_idx')
            ->add_key('entity_type', name: 'entity_type_idx')
            ->add_key('created_at', name: 'created_at_idx')
            ->create_table('activity_logs');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('activity_logs');
    }
}
