<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_categories extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'shortdesc' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'longdesc' => array(
                    'type' => 'TEXT',                     
            ),
            'status' => array(
                    'type' => 'ENUM',
                    'constraint' => "'active', 'inactive'",
                    'default'=> 'active',                    
            ),
            'parent_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'default'=> 0,                    
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('categories');
    }

    public function down() {
        $this->dbforge->drop_table('categories');
    }

}    