<section>
    <h2><?php echo $this->lang->line('title_product'); ?></h2>
    <?php echo anchor('admin/product/edit', '<i class="icon-plus"></i>' .  $this->lang->line('index_add_a_product')); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('index_product_name'); ?></th>
                <th><?php echo $this->lang->line('index_product_category_id'); ?></th>
                <th><?php echo $this->lang->line('index_product_edit'); ?></th>
                <th><?php echo $this->lang->line('index_product_delete'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products)): foreach ($products as $product): ?>	
                    <tr>
                        <td><?php echo anchor('admin/product/edit/' . $product->id, $product->name); ?></td>
                        <td><?php echo $product->category_name; ?></td>
                        <td><?php echo btn_edit('admin/product/edit/' . $product->id); ?></td>
                        <td><?php echo btn_delete('admin/product/delete/' . $product->id); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"><?php echo $this->lang->line('index_we_could_not_find_any_products'); ?></td>
                </tr>
            <?php endif; ?>	
        </tbody>
    </table>
</section>