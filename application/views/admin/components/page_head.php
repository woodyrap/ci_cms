<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $meta_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!-- Bootstrap -->
        <link href="<?php echo site_url('css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo site_url('css/admin.css'); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo site_url('css/datepicker.css'); ?>" rel="stylesheet" media="screen">

        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="<?php echo site_url('js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo site_url('js/bootstrap-datepicker.js'); ?>"></script>

        <?php if (isset($sortable) && $sortable === TRUE): ?>
            <script src="<?php echo site_url('js/jquery-ui-1.10.3.custom.min.js'); ?>"></script>
            <script src="<?php echo site_url('js/jquery.mjs.nestedSortable.js'); ?>"></script>
        <?php endif; ?>


        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- TinyMCE -->
        <script type="text/javascript" src="<?php echo site_url('js/tinymce/tinymce.min.js'); ?>"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea.tmce1",
                theme: "modern",
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor filemanager"
                ],                
                image_advtab: true,
                menubar: false,
                toolbar_items_size: 'small',
                //language : 'es',//
                //content_css: "skins/content.min.css",//
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify |\n\
                          bullist numlist outdent indent | link image | print preview media fullpage | forecolor \n\
                          backcolor emoticons"
                             
            });            
            
            tinymce.init({
                selector: "textarea.tmce2",
                theme: "modern",
                plugins: [
                    "link image media filemanager"
                ],              
                 menubar: false,
                toolbar_items_size: 'small',
                image_advtab: true,
                //language : 'es',//
                //content_css: "skins/content.min.css",//
                toolbar: "insertfile image"
                             
            });            
        </script>
        <!-- /TinyMCE -->
    </head>