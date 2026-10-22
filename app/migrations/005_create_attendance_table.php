<?php

class Create_attendance_table {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if ($this->_lava->dbforge->table_exists('attendance')) {
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
                'trainee_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'class_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                ],
                'date' => [
                    'type' => 'DATE',
                    'null' => FALSE,
                ],
                'time_in' => [
                    'type' => 'TIME',
                    'null' => TRUE,
                ],
                'time_out' => [
                    'type' => 'TIME',
                    'null' => TRUE,
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => "'present','late','absent','excused'",
                    'null'       => FALSE,
                    'default'    => 'absent',
                ],
                'remarks' => [
                    'type' => 'TEXT',
                    'null' => TRUE,
                ],
                'recorded_by' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => TRUE,
                    'null'       => TRUE,
                ],
                'recorded_method' => [
                    'type'       => 'ENUM',
                    'constraint' => "'qr_scan','manual','nfc','face_recognition'",
                    'null'       => FALSE,
                    'default'    => 'qr_scan',
                ],
                'location_verified' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'unsigned'   => TRUE,
                    'null'       => FALSE,
                    'default'    => 0,
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
            ->add_key('trainee_id', name: 'trainee_id_idx')
            ->add_key('class_id', name: 'class_id_idx')
            ->add_key('date', name: 'date_idx')
            ->add_key(['trainee_id', 'class_id', 'date'], unique: TRUE, name: 'attendance_unique')
            ->create_table('attendance');
    }

    public function down()
    {
        $this->_lava->dbforge->drop_table('attendance');
    }
}
