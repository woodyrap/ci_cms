<h3><?php echo empty($category->id) ? $this->lang->line('add_a_new_category') : $this->lang->line('edit_category') . $category->name; ?></h3>
<?php echo $this->session->flashdata('error'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>            
        <td><?php echo $this->lang->line('category_name'); ?></td>
        <td><?php echo form_input('name', set_value('name', $category->name)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('category_shortdesc'); ?></td>
        <td><?php echo form_input('shortdesc', set_value('shortdesc', $category->shortdesc), 'class="tmce1"'); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('category_longdesc'); ?></td>
        <td><?php echo form_textarea('longdesc', set_value('longdesc', $category->longdesc), 'class="tmce1"'); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('category_status'); ?></td>
        <td><?php echo form_dropdown('status', $enums_status, $this->input->post('status') ? $this->input->post('status') : $category->status); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('category_parent_id'); ?></td>
        <td><?php echo form_dropdown('parent_id', $categories_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $category->parent_id); ?></td>
    </tr>
    <tr>            
        <td></td>
        <td><?php echo form_submit('submit', $this->lang->line('category_button_save'), 'class="btn btn-primary"'); ?></td>
    </tr>
</table>
<?php echo form_close(); ?>
