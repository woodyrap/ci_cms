<section>
    <h2><?php echo $this->lang->line('title_user'); ?></h2>
    <?php echo anchor('admin/user/edit', '<i class="icon-plus"></i>' . $this->lang->line('index_add_a_user')); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('index_email'); ?></th>
                <th><?php echo $this->lang->line('index_edit'); ?></th>
                <th><?php echo $this->lang->line('index_delete'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($users)): foreach ($users as $user): ?>	
                    <tr>
                        <td><?php echo anchor('admin/user/edit/' . $user->id, $user->email); ?></td>
                        <td><?php echo btn_edit('admin/user/edit/' . $user->id); ?></td>
                        <td><?php echo btn_delete('admin/user/delete/' . $user->id); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"><?php echo $this->lang->line('index_we_could_not_find_any_user'); ?></td>
                </tr>
            <?php endif; ?>	
        </tbody>
    </table>
</section>