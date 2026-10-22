<?php

class Create_inquiries_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('inquiries')) {
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
                'sender_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'recipient_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => TRUE,
                ],
                'subject' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'message' => [
                    'type' => 'TEXT',
                    'null' => FALSE,
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'open','in_progress','resolved','closed'",
                    'null'       => FALSE,
                    'default'    => 'open',
                ],
                'priority' => [
                    'type'       => 'ENUM',
                    'constraint' => "'low','normal','high','urgent'",
                    'null'       => FALSE,
                    'default'    => 'normal',
                ],
                'ai_suggested_reply' => [
                    'type' => 'TEXT',
                    'null' => TRUE,
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
            ->add_key('sender_id', name: 'sender_id_idx')
            ->add_key('recipient_id', name: 'recipient_id_idx')
            ->add_key('status', name: 'status_idx')
            ->create_table('inquiries');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('inquiries');
    }
}
