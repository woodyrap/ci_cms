<section>
    <h2><?php echo $this->lang->line('title_news_articles'); ?></h2>
    <?php echo anchor('admin/article/edit', '<i class="icon-plus"></i>' .  $this->lang->line('index_add_a_article')); ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('index_title'); ?></th>
                <th><?php echo $this->lang->line('index_pubdate'); ?></th>
                <th><?php echo $this->lang->line('index_edit'); ?></th>
                <th><?php echo $this->lang->line('index_delete'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($articles)): foreach ($articles as $article): ?>	
                    <tr>
                        <td><?php echo anchor('admin/article/edit/' . $article->id, $article->title); ?></td>
                        <td><?php echo $article->pubdate; ?></td>
                        <td><?php echo btn_edit('admin/article/edit/' . $article->id); ?></td>
                        <td><?php echo btn_delete('admin/article/delete/' . $article->id); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3"><?php echo $this->lang->line('index_we_could_not_find_any_articles'); ?></td>
                </tr>
            <?php endif; ?>	
        </tbody>
    </table>
</section>