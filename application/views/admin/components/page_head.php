<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $meta_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!-- Bootstrap -->
        <link href="<?php echo site_url('css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo site_url('css/admin.css'); ?>" rel="stylesheet" media="screen">
        
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="<?php echo site_url('js/bootstrap.min.js'); ?>"></script>
        
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
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                content_css: "css/content.css",
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            }); 
        </script>
        <!-- /TinyMCE -->
    </head>