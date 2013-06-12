<div class="modal-header">
    <h3><?php echo empty($user->id) ?  $this->lang->line('add_a_new_user') : $this->lang->line('edit_user') . $user->name; ?></h3>
</div>
<div class="modal-body">   
    <?php echo $this->session->flashdata('error'); ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
    <table class="table">
        <tr>            
            <td><?php echo $this->lang->line('user_name'); ?></td>
            <td><?php echo form_input('name', set_value('name',$user->name)); ?></td>
        </tr>
        <tr>            
            <td><?php echo $this->lang->line('user_email'); ?></td>
            <td><?php echo form_input('email', set_value('email',$user->email)); ?></td>
        </tr>
        <tr>            
            <td><?php echo $this->lang->line('user_password'); ?></td>
            <td><?php echo form_password('password'); ?></td>
        </tr>
        <tr>            
            <td><?php echo $this->lang->line('user_confirm_password'); ?></td>
            <td><?php echo form_password('password_confirm'); ?></td>
        </tr>
        <tr>            
            <td></td>
            <td><?php echo form_submit('submit', $this->lang->line('user_save_button'), 'class="btn btn-primary"'); ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>