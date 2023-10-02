<?php include_once resolvePartial('header'); ?>

<?php include_once resolvePartial('sidebar'); ?>

    <main class="py-4" style="margin-left:280px">
        <div class="container">
            <?php include_once
                /** @var string $pagePath */
            $pagePath ?>
        </div>
    </main>

<?php include_once resolvePartial('footer'); ?>