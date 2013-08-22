<!-- Main content -->
<div class="span9">
    <section id="portfolio">
        <div class="row">
            <form id="portfolio-search-form" class="form-search form-horizontal pull-right" method="post">
                <div class="input-append span9">
                    <input type="text" class="search-query"  id="input_search_form" placeholder="<?php echo $this->lang->line('search'); ?>">
                    <button type="submit" class="btn" id="btn_search_form"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
        <div class="row">            
            <?php
            $str = '';
            $last_id = 0;
            if ($search) {
                echo $table;
            } else {
                foreach ($listing as $list) {
                    if ($list['parent_id'] == 0) {
                        if ($last_id != $list['parent_id']) {
                            $str .= '</ul>' . PHP_EOL;
                            $str .= '</div> <!-- Enf of span7-->' . PHP_EOL;
                        }
                        $str .= '<div class="span2" >' . PHP_EOL;
                        $str .= '<h4 class="title">' . $list['name'] . '</h4>' . PHP_EOL;
                        $str .= '<p>' . $list['shortdesc'] . '</p>' . PHP_EOL;
                        $str .= "</div>" . PHP_EOL;
                        $str .= '<div class="span7">' . PHP_EOL;
                        $str .= '<ul class="thumbnails">' . PHP_EOL;
                        $last_id = $list['id'];
                    } else {
                        $str .= '<li class="span2">' . PHP_EOL;
                        $str .= '<a href="' . site_url('page/products_by_category/' . $list['id']) . '" class="thumbnail">' . PHP_EOL;
                        $str .= '<center>' . $list['image'] . '</center>' . PHP_EOL;
                        $str .= '</a>' . PHP_EOL;
                        $str .= '</li>' . PHP_EOL;
                    }
                }
            }
            echo $str;
            ?>
        </div>
    </section><!-- portfolio-->
</div>

<!-- Sidebar -->
<div class="span3 sidebar">
    <article>
        <h2><?php echo e($page->title); ?></h2>
        <?php echo $page->body; ?>
    </article>
</div>

<!-- Modal Definition -->
<div class="modal hide" id="dialog-product">    
    <!--<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="btn-close">x</button>
        <h3>INFORMATION ABOUT PRODUCT</h3>
    </div>-->

    <div class="modal-body">
    </div>

    <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn btn-primary" id="btn-close"><?php echo $this->lang->line('close'); ?></a>        
    </div>
</div>
<!-- Enf of Modal Definition -->

<script type="text/javascript">
    $("#btn_search_form").click(function(e) {
        var form_data = {
            inputsearchform: $('#input_search_form').val(),
            ajax: '1'
        };
        var link = '<?php echo site_url() . "search"; ?>';
        //console.log(link);
        $.ajax({
            url: link,
            type: 'POST',
            data: form_data,
            success: function(msg) {
                $('body').html(msg);
            },
            error: function(data) {
                bootbox.alert("Error!. " + $("#body").html(data));
            }
        });

        return false;
    });

    $(document).on('click', '.info-record', function(e) {
        e.preventDefault();

        $(".modal-body").html('');
        $(".modal-body").addClass('loader');
        $("#dialog-product").modal('show');
        var id = $(this).attr('modal-id');
        get_product_ajax(id);
    });

    $("#btn-close").click(function(e) {
        $("#dialog-product").modal('hide');
    });

    // Function support by ajax
    function get_product_ajax(id) {
        var function_data = {
            id_product: id
        };
        var link = '<?php echo site_url() . "search/get_product_ajax"; ?>';
        $.ajax({
            url: link,
            type: 'POST',
            data: function_data,
            success: function(data) {
                if (data) {                    
                    $(".modal-body").removeClass('loader');
                    $(".modal-body").html(data);
                }
            },
            error: function(data) {
                bootbox.alert("Error!. " + $("#body").html(data));
            }
        });
    }
    //End of New Modal and AJAX function

</script> <!-- End of Script Search Form-->