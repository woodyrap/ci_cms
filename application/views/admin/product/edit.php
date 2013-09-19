<h3><?php echo empty($product->id) ? $this->lang->line('add_a_new_product') : $this->lang->line('edit_product') . $product->name; ?></h3>
<?php echo $this->session->flashdata('error'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>            
        <td><?php echo $this->lang->line('product_name'); ?></td>
        <td><?php echo form_input('name', set_value('name', $product->name)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_product_order'); ?></td>
        <td><?php echo form_input('product_order', set_value('product_order', $product->product_order)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_shortdesc'); ?></td>
        <td><?php echo form_input('shortdesc', set_value('shortdesc', $product->shortdesc), 'class="tmce1"'); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_longdesc'); ?></td>
        <td><?php echo form_textarea('longdesc', set_value('longdesc', $product->longdesc), 'class="tmce1"'); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_thumbnail'); ?></td>
        <td><?php echo form_textarea('thumbnail', set_value('thumbnail', $product->thumbnail), 'class="tmce2"'); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_image'); ?></td>
        <td><?php echo form_textarea('image', set_value('image', $product->image), 'class="tmce2"'); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_category_id'); ?></td>
        <td><?php echo form_dropdown('category_id', $categories, $this->input->post('category_id') ? $this->input->post('category_id') : $product->category_id); ?></td>
    </tr>    
    <tr>            
        <td><?php echo $this->lang->line('product_class'); ?></td>
        <td><?php echo form_input('class', set_value('class', $product->class)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_grouping'); ?></td>
        <td><?php echo form_input('grouping', set_value('grouping', $product->grouping)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_status'); ?></td>
        <td><?php echo form_dropdown('status', $enums_status, $this->input->post('status') ? $this->input->post('status') : $product->status); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_featured'); ?></td>
        <td><?php echo form_dropdown('featured', $enums_featured, $this->input->post('featured') ? $this->input->post('featured') : $product->featured); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_other_feature'); ?></td>
        <td><?php echo form_dropdown('other_feature', $enums_other_feature, $this->input->post('other_feature') ? $this->input->post('other_feature') : $product->other_feature); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('product_price'); ?></td>
        <td><?php echo form_input('price', set_value('price', $product->price)); ?></td>
    </tr>
    <tr>            
        <td></td>
        <td><?php echo form_submit('submit', $this->lang->line('product_button_save'), 'class="btn btn-primary"'); ?></td>
    </tr>
</table>
<?php echo form_close(); ?>
