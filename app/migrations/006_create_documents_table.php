<?php

class Create_documents_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('documents')) {
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
                    'null'       => FALSE,
                ],
                'document_type' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => FALSE,
                ],
                'file_name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => FALSE,
                ],
                'file_path' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 500,
                    'null'       => FALSE,
                ],
                'file_size' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'null'       => TRUE,
                ],
                'mime_type' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => TRUE,
                ],
                'description' => [
                    'type' => 'TEXT',
                    'null' => TRUE,
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'pending','approved','rejected'",
                    'null'       => FALSE,
                    'default'    => 'pending',
                ],
                'ocr_processed' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                    'default'    => 0,
                ],
                'access_level' => [
                    'type'       => 'ENUM',
                    'constraint' => "'public','private','restricted'",
                    'null'       => FALSE,
                    'default'    => 'private',
                ],
                'uploaded_by' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
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
            ->add_key('user_id', name: 'user_id_idx')
            ->add_key('document_type', name: 'document_type_idx')
            ->add_key('status', name: 'status_idx')
            ->create_table('documents');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('documents');
    }
}
