<h3><?php echo empty($article->id) ? $this->lang->line('add_a_new_article') : $this->lang->line('edit_article') . $article->title; ?></h3>
<?php echo $this->session->flashdata('error'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>            
        <td><?php echo $this->lang->line('article_publication_date'); ?></td>
        <td><?php echo form_input('pubdate', set_value('pubdate', $article->pubdate), 'class="datepicker"'); ?></td>
    </tr>
        <tr>            
        <td><?php echo $this->lang->line('article_title'); ?></td>
        <td><?php echo form_input('title', set_value('title', $article->title)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('article_slug'); ?></td>
        <td><?php echo form_input('slug', set_value('slug', $article->slug)); ?></td>
    </tr>
    <tr>            
        <td><?php echo $this->lang->line('article_body'); ?></td>
        <td><?php echo form_textarea('body', set_value('body', $article->body), 'class="tmce1"'); ?></td>
    </tr>
    <tr>            
        <td></td>
        <td><?php echo form_submit('submit', $this->lang->line('article_button_save'), 'class="btn btn-primary"'); ?></td>
    </tr>
</table>
<?php echo form_close(); ?>

<script>
$(function(){
    $('.datepicker').datepicker({ format : 'yyyy-mm-dd'});
});
</script>