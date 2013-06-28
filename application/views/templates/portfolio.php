<!-- Main content -->
<div class="span9">
    <section id="portfolio">
        <div class="row">
            <form id=portfolio-search-form" class="form-search form-horizontal pull-right">
                <div class="input-append span9">
                    <input type="text" class="search-query" placeholder="Search">
                    <button type="submit" class="btn"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
        <div class="row">
                    <?php
                        foreach ($listing as $list){

                          if($list['parent_id'] == 0){
                              //echo "</div>\n</div>\n<div class=\"pr grid_12 clearfix\">&nbsp;</div>\n<div class=\"catagory_1 clearfix\">\n";
                              echo "<div class=\"span2\" >\n";
                              //echo "<span class=\"meta\">".$list['shortdesc']."</span>\n";
                              echo "<h4 class=\"title \">".$list['name']."</h4>\n";
                              echo $list['shortdesc']."\n</div>\n<div class=\"span7\">\n";
                          }else{
                              $longdesc = $list['longdesc'];                                                                
                              echo "<div class='span2'>" . anchor('page/products_by_category/' . $list['id'], $longdesc) . "</div>";                              
                              //$thumbnail=convert_image_path($imagepath);
                              //echo "<a class=\"portfolio_item float alpha\" href=\"". site_url()."/".lang('web_folder'). "/product/".$list['id']. "\">\n";
                              //echo "<span>".	$list['name']."</span>\n";
                              //echo "<img src='".$thumbnail."' class='thumbnail'/></a>\n";	
                          }
                        }
                              echo "</div>\n";
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
