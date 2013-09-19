<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_image_to_categories extends CI_Migration {

    public function up() {
        $fields = array(
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => 1000,
            )
        );        
        $this->dbforge->add_column('categories', $fields);        
    }

    public function down() {
        $this->dbforge->drop_column('categories',$fields);
    }

}    