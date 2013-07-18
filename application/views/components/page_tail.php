<script src="<?php echo site_url('js/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo site_url('js/bootstrap.min.js'); ?>"></script>

<!--        <script type="text/javascript">
    $('.carousel').carousel()
</script>-->
<script>
    jQuery(document).ready(function($) {

        $('#myCarousel').carousel({
            interval: 3000
        });

        $('#carousel-text').html($('#slide-content-0').html());

        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid', function(e) {
            var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-' + id).html());
        });

        //New Modal and AJAX function
        var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function    ?>';
        var controller = 'page';

        $(function() {
            $("#list").addClass('loader');
            if ($('#list').is(':visible')) {
                load_data_ajax(null);
            }                       
            
            $(document).on('click', '.edit-record', function(e) {
                e.preventDefault();

                $(".modal-body").html('');
                $(".modal-body").addClass('loader');
                $("#dialog-carousel").modal('show');
                load_data_ajax($(this).attr('data-id'));
            });            
            
            $("#btn-close").click(function(e) {
                $('#myCarousel').carousel('cycle');
                $("#dialog-carousel").modal('hide');
            });
        });

        // Function support by ajax
        function load_data_ajax(type) {
            $.ajax({
                'url': base_url + controller + '/get_list_view',
                'type': 'POST', //the way you want to send data to your URL
                'data': {'type': type},
                'success': function(data) { //probably this request will return anything, it'll be put in var "data"
                    //var container = $('#container'); //jquery selector (get element by id)
                    console.log('Here 1');
                    if (data) {
                        //container.html(data);
                        if (type == null) {
                            console.log('Here True');
                            $("#list").removeClass('loader');
                            $("#list").html(data);
                        } else {
                            console.log('Here False');
                            $('#myCarousel').carousel('pause');
                            $(".modal-body").removeClass('loader');
                            $(".modal-body").html(data);
                        }
                    }
                }
            });
        }
        //End of New Modal and AJAX function
    });
</script>
</body>
</html>