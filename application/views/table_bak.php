                <table class = "table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('index_product_name'); ?></th>
                            <th><?php echo $this->lang->line('index_product_category_id'); ?></th>
                            <th><?php echo $this->lang->line('index_product_edit'); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($listing)): foreach ($listing as $list): ?>	
                                <tr>
                                    <td><?php echo $list->name; ?></td>
                                    <td><?php echo $list->category_name; ?></td>
                                    <td><?php echo btn_info($list->id); ?></td>                                    
                                     dialog contents on hidden div                                                    
                                    <div id="<?php echo 'modal-content-' . $list->id; ?>" class="hide">
                                        <div id="<?php echo 'modal-body-' . $list->id; ?>">
                                             put whatever you want to show up on bootbox here 
                                            <h2><?php echo $list->name; ?></h2>
                                            <p><?php echo $list->longdesc; ?></p>
                                        </div>
                                    </div>        
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3"><?php echo $this->lang->line('index_we_could_not_find_any_products'); ?></td>
                        </tr>
                    <?php endif; ?>	

                    </tbody>
                </table>                                  