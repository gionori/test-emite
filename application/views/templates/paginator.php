<?php
    $records_count = count($result['data']);
    $records_total = $result['count'];
    $page_size = $result['page_size'];
    $page_number = $result['page_number'];

    $pages_count = ceil($records_total / $page_size);

    if ($records_count != 0):
?>

    <nav>
        <ul class="pagination justify-content-center">

        <li class="page-item <?php echo $page_number == 0 ? 'disabled' : '' ?>">
            <a
                class="page-link"
                href="<?php echo $base_url . '/' . $page_size .'/' . ($page_number - 1) ?>"
            >
                Anterior
            </a>
        </li>

            <?php for ($i = 1; $i <= $pages_count; $i++): ?>
                <li class="page-item <?php echo ($page_number + 1 === $i) ? 'active' : '' ?>">
                    <a
                        class="page-link"
                        href="<?php echo $base_url . '/' . $page_size .'/' . ($i - 1) ?>"
                    >
                        <?php echo $i ?>
                    </a>
                </li>
            <?php endfor; ?>      

            <li class="page-item <?php echo $page_number == ($pages_count - 1) ? 'disabled' : '' ?>">
                <a
                    class="page-link"
                    href="<?php echo $base_url . '/' . $page_size .'/' . ($page_number + 1) ?>"
                >
                    Siguiente
                </a>
        </li>

        </ul>
    </nav>

<?php endif; ?>
