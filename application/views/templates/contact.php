<!-- Main content -->
<div class="span9">    
    <div class="row">
        <article>
            <h2><?php echo e($page->title); ?></h2>                                    
            <?php if (isset($send_email)): ?>                
                <?php //do_alert($send_email);?>            
            <?php endif; ?>
        </article>
        <section>     
            <div class="span3">
                <form id="formContact" name="formContact">
                    <div class="control-group">
                        <label class="control-label" for="fullname"><i class="icon-user"></i> Full Name</label>
                        <div class="controls controls-row">
                            <input type="text" class="input-large" name="fullname" id="fullname" placeholder="Cool Person">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="inputemail"><i class="icon-envelope"></i> Email</label>
                        <div class="controls">
                            <input type="text" class="input-large" name="inputemail" id="inputemail" placeholder="you@yourdomain.com">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="inputsubject"><i class="icon-question-sign"></i> Subject</label>
                        <div class="controls">
                            <input type="text" class="input-large" name="inputsubject" id="inputsubject" placeholder="what's up?">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="inputmessage"><i class="icon-pencil"></i> Message</label>
                        <div class="controls">
                            <textarea rows="6" class="input-large" name="inputmessage" id="inputmessage" placeholder="What's on your mind?"></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-success" id="sendmail" >Send Message</button>
                            <span id="showloader"></span>
                        </div>
                    </div>
                </form>
                <br class="clear">
            </div>
        </section><!-- End Section -->
        <section> 
            <div class="span6">
                <div class="fluidMedia">
                    <iframe frameborder="0" src="<?php echo $url_google_maps ?>"></iframe>                    
                </div><!--end fluidMedia -->
                <div class="well-small">
                    <p class="tagline"><?php echo $page->body; ?></p>
                </div>
            </div>
        </section><!-- End Section -->
    </div>    
</div>

<!-- Sidebar -->
<div class="span3 sidebar">
    <h2>Recent news</h2>
    <?php $this->load->view('sidebar'); ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
            $('#formContact').validate({
                rules: {
                fullname: {
                minlength: 2,
            required: true
                },
            inputemail: {
            required: true,
            email: true
                },
                inputsubject: {
                minlength: 2,
            required: true
                },
                inputmessage: {
                minlength: 2,
        required: true
            }
        },
            highlight: function(element) {
        $(element).closest('.control-group').removeClass('success').addClass('error');
        },
            success: function(element) {
        element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
       },
            submitHandler: function(form) {
                
            var form_data = {
                fullname: $('#fullname').val(),
                inputemail: $('#inputemail').val(),
                inputsubject: $('#inputsubject').val(),
                inputmessage: $('#inputmessage').val(),
            ajax: '1'
                };

            $.ajax({
                url: '<?php echo site_url() . "page/submit_email"; ?>',
                type: 'GET',
                data: form_data,
                    success: function(msg) {
                        bootbox.alert(msg, function() {
                        location.reload(true);
                });
                },
                    error: function(data) {
                        bootbox.alert('Error.!');
            }
        });

    return false;
        }
    
    });
});    
// end document.ready   
</script>