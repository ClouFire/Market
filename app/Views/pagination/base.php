<div class="row">
    <div class="col-md-12 text-center">
        <div class="site-block-27">
            <ul>
                <?php if(!empty($back)) : ?>
                    <li><a href="<?= $back; ?>">&lt;</a></li>
                <?php endif; ?>
                <?php if(!empty($pages_left)) : ?>
                    <?php foreach($pages_left as $page_left) :?>
                        <li><a href="<?= $page_left['link']; ?>"><?= $page_left['number']; ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <li class="active"><span><?= $current_page; ?></span></li>

                <?php if(!empty($pages_right)) : ?>
                    <?php foreach($pages_right as $page_right) :?>
                        <li><a href="<?= $page_right['link']; ?>"><?= $page_right['number']; ?></a></li>
                    <?php endforeach; ?>

                    <?php if(!empty($forward)) : ?>
                        <li><a href="<?= $forward; ?>">&gt;</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
