<nav class="mb-5">
    <ol class="breadcrumb">
        <?php foreach ($breadcrumb as $item): ?>
            <li class="breadcrumb-item">
                <?php
                    if (!$item['is_active']) {
                ?>
                        <a href="<?php echo $item['path'] ?>">
                            <?php echo $item['label'] ?>
                        </a>
                <?php                        
                    } else {
                        echo $item['label'];
                    }
                ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>