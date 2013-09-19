<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_products extends CI_Migration {
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
            'thumbnail' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000',
            ),
            'product_order' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'class' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'grouping' => array(
                'type' => 'VARCHAR',
                'constraint' => '16',
            ),
            'status' => array(
                    'type' => 'ENUM',
                    'constraint' => "'active','inactive'",
                    'default'=> "active",
            ),
            'category_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
            ),
            'featured' => array(
                    'type' => 'ENUM',
                    'constraint' => "'none','front','webshop'",
                    'default'=> "none",
            ),
            'other_feature' => array(
                    'type' => 'ENUM',
                    'constraint' => "'none','most sold','new product'",
                    'default'=> "none",
            ),
            'price' => array(
                    'type' => 'DECIMAL',
                    'constraint' => '10,2',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('products');
    }

    public function down() {
        $this->dbforge->drop_table('products');
    }

}    