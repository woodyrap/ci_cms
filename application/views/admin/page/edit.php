<h3><?php echo empty($page->id) ? $this->lang->line('add_a_new_page') : $this->lang->line('edit_page') . $page->title; ?></h3>
<?php echo $this->session->flashdata('error'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>            
        <td><?php echo $this->lang->line('page_parent'); ?></td>
        <td><?php echo form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('page_template'); ?></td>
        <td><?php echo form_dropdown('template', array('page'=>'Page', 'news_archive'=>'News archive', 'homepage'=>'Homepage', 'portfolio'=>'Portfolio', 'contact'=>'Contact Us'), $this->input->post('template') ? $this->input->post('template') : $page->template); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('page_title'); ?></td>
        <td><?php echo form_input('title', set_value('title', $page->title)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('page_slug') ?></td>
        <td><?php echo form_input('slug', set_value('slug', $page->slug)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('page_body'); ?></td>
        <td><?php echo form_textarea('body', set_value('body', $page->body), 'class="tmce1"'); ?></td>
    </tr>
    <tr>            
        <td></td>
        <td><?php echo form_submit('submit', $this->lang->line('page_button_save'), 'class="btn btn-primary"'); ?></td>
    </tr>
</table>
<?php echo form_close(); ?>
