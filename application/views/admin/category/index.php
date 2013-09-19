<section>
    <h2><?php echo $this->lang->line('title_category'); ?></h2>
    <?php echo anchor('admin/category/edit', '<i class="icon-plus"></i>' .  $this->lang->line('index_add_a_category')); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('index_category_name'); ?></th>
                <th><?php echo $this->lang->line('index_category_parent_id'); ?></th>
                <th><?php echo $this->lang->line('index_category_edit'); ?></th>
                <th><?php echo $this->lang->line('index_category_delete'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($categories)): foreach ($categories as $category): ?>	
                    <tr>
                        <td><?php echo anchor('admin/category/edit/' . $category->id, $category->name); ?></td>
                        <td><?php echo $category->parent_name; ?></td>
                        <td><?php echo btn_edit('admin/category/edit/' . $category->id); ?></td>
                        <td><?php echo btn_delete('admin/category/delete/' . $category->id); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"><?php echo $this->lang->line('index_we_could_not_find_any_categories'); ?></td>
                </tr>
            <?php endif; ?>	
        </tbody>
    </table>
</section>