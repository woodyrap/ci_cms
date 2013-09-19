<div class="modal-header">
    <h3><?php echo $this->lang->line('title_login'); ?></h3>
    <p><?php echo $this->lang->line('login_please_login_using_your_credentials'); ?></p>
</div>
<div class="modal-body">   
    <?php echo $this->session->flashdata('error'); ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
    <table class="table">
        <tr>            
            <td><?php echo  $this->lang->line('login_email');?></td>
            <td><?php echo form_input('email'); ?></td>
        </tr>
        <tr>            
            <td><?php echo  $this->lang->line('login_password');?></td>
            <td><?php echo form_password('password'); ?></td>
        </tr>
        <tr>            
            <td></td>
            <td><?php echo form_submit('submit', $this->lang->line('login_button'), 'class="btn btn-primary"'); ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>