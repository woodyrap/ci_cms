<section>
    <h2><?php echo $this->lang->line('order_pages'); ?></h2>
    <p class="alert alert-info"><?php echo $this->lang->line('order_drag_to_order_pages_and_then_click_save'); ?></p>
    <div id="orderResult"></div>
    <input type="button" id="save" value="<?php echo $this->lang->line('order_save_button'); ?>" class="btn btn-primary" />
</section>
<script>
    $(function() {
        $.post('<?php echo site_url('admin/page/order_ajax'); ?>', {}, function(data){
            $('#orderResult').html(data);
        });
        
        $('#save').click(function(){
            oSortable = $('.sortable').nestedSortable('toArray');
            $('#orderResult').slideUp(function(){
                $.post('<?php echo site_url('admin/page/order_ajax'); ?>', { sortable: oSortable}, function(data){
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                }); 
            });           
        });
    });
</script>