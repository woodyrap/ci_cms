<?php $this->load->view('admin/components/page_head'); ?>
<body>
    <div class="navbar navbar-s navbar-inverse">
        <div class="navbar-inner">
            <a class="brand" href="<?php echo site_url('admin/dashboard'); ?>"><?php echo $meta_title; ?></a>
            <ul class="nav">
                <li class="active"><a href="<?php echo site_url('admin/dashboard'); ?>"><?php $this->lang->line('dashboard'); ?></a></li>
                <li><?php echo anchor('admin/page', $this->lang->line('pages')); ?></li>
                <li><?php echo anchor('admin/page/order', $this->lang->line('order_pages')); ?></li>
                <li><?php echo anchor('admin/article', $this->lang->line('news_articles')); ?></li>
                <li><?php echo anchor('admin/user', $this->lang->line('users')); ?></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Main column -->
            <div class="span9">
               <?php $this->load->view($subview); ?>                
            </div>
            <!-- Sidebar -->
            <div class="span3">
                <section>
                    <?php echo mailto($web_master, '<i class="icon-user"></i>' . $web_master); ?><br>                    
                    <?php echo anchor('admin/user/logout', '<i class="icon-off"></i>' . $this->lang->line('logout')); ?>
                </section>
            </div>
        </div>
    </div> 

    <?php $this->load->view('admin/components/page_tail'); ?>