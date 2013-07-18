<!-- Main content -->
<div class="span9">
    <section id="portfolio">
        <div class="row">
            <form id=portfolio-search-form" class="form-search form-horizontal pull-right">
                <div class="input-append span9">
                    <input type="text" class="search-query" placeholder="<?php echo $this->lang->line('search'); ?>">
                    <button type="submit" class="btn"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
        <div class="row">            
            <?php
            $str = '';
            $last_id = 0;            
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
