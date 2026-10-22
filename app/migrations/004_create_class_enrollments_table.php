<?php

class Create_class_enrollments_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('class_enrollments')) {
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
                'class_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'trainee_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'enrollment_date' => [
                    'type'    => 'DATETIME',
                    'null'    => FALSE,
                    'default' => 'CURRENT_TIMESTAMP',
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'enrolled','completed','dropped'",
                    'null'       => FALSE,
                    'default'    => 'enrolled',
                ],
                'created_at' => [
                    'type'    => 'DATETIME',
                    'null'    => FALSE,
                    'default' => 'CURRENT_TIMESTAMP',
                ],
            ])
            ->add_key('id', primary: TRUE)
            ->add_key('class_id', name: 'class_id_idx')
            ->add_key('trainee_id', name: 'trainee_id_idx')
            ->add_key(['class_id', 'trainee_id'], unique: TRUE, name: 'class_trainee_unique')
            ->create_table('class_enrollments');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('class_enrollments');
    }
}
