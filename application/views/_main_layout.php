<?php $this->load->view('components/page_head'); ?>

<body>    
    <div class="container">
        <section>
            <h1><?php echo anchor('', strtoupper(config_item('site_name'))); ?></h1>
        </section>

        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse">
                        <?php echo get_menu($menu); ?>
                        <ul class="nav pull-right">
                            <li><?php echo anchor('', $this->lang->line('back_to') . strtoupper(config_item('site_name'))); ?></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php $this->load->view('templates/' . $subview); ?>
        </div>
    </div>

    <?php $this->load->view('components/page_tail'); ?>