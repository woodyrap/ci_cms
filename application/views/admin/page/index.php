<section>
    <h2><?php echo $this->lang->line('title_pages'); ?></h2>
    <?php echo anchor('admin/page/edit', '<i class="icon-plus"></i>' . $this->lang->line('index_add_a_page')); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('index_title'); ?></th>
                <th><?php echo $this->lang->line('index_parent'); ?></th>
                <th><?php echo $this->lang->line('index_edit'); ?></th>
                <th><?php echo $this->lang->line('index_delete'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pages)): foreach ($pages as $page): ?>	
                    <tr>
                        <td><?php echo anchor('admin/page/edit/' . $page->id, $page->title); ?></td>
                        <td><?php echo $page->parent_slug; ?></td>
                        <td><?php echo btn_edit('admin/page/edit/' . $page->id); ?></td>
                        <td><?php echo btn_delete('admin/page/delete/' . $page->id); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"><?php echo $this->lang->line('index_we_could_not_find_any_pages'); ?></td>
                </tr>
            <?php endif; ?>	
        </tbody>
    </table>
</section>