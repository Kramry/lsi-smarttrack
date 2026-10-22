<?php

class Create_announcements_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('announcements')) {
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
                'title' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'content' => [
                    'type' => 'TEXT',
                    'null' => FALSE,
                ],
                'target_audience' => [
                    'type'       => 'ENUM',
                    'constraint' => "'all','trainee','instructor','staff','admin'",
                    'null'       => FALSE,
                    'default'    => 'all',
                ],
                'priority' => [
                    'type'       => 'ENUM',
                    'constraint' => "'low','normal','high','urgent'",
                    'null'       => FALSE,
                    'default'    => 'normal',
                ],
                'posted_by' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'draft','published','archived'",
                    'null'       => FALSE,
                    'default'    => 'draft',
                ],
                'published_at' => [
                    'type'    => 'DATETIME',
                    'null'    => TRUE,
                    'default' => NULL,
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
            ->add_key('target_audience', name: 'target_audience_idx')
            ->add_key('status', name: 'status_idx')
            ->add_key('published_at', name: 'published_at_idx')
            ->create_table('announcements');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('announcements');
    }
}
