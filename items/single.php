<?php
$caption = make_citation($item, true, false);
$citation = make_citation($item);
$title = metadata($item, array('Dublin Core', 'Title'));
$description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 150));
if (get_theme_option('Single Line Item'))
    $class = "single-line item record";
else
    $class = "item record"
?>
<div class="<?php echo $class; ?>">
    <h4><?php echo link_to_item($caption, array(), 'show', $item); ?></h4>
    <div class="item-meta">
        <?php if (metadata($item, 'has thumbnail')): ?>
            <div class="item-img">
                <?php echo link_to_item(item_image('square_thumbnail', array(), 0, $item), array(), 'show', $item); ?>
            </div>
        <?php endif; ?>

        <?php if ($citation): ?>
            <p class="item-citation">
                <?php echo $citation; ?>
            </p>
        <?php endif; ?>

        <?php if ($description): ?>
            <p class="item-description">
                <?php echo $description; ?>
            </p>
        <?php endif; ?>

        <?php if (metadata($item, 'has tags')): ?>
    <p class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
        <?php echo tag_string($item); ?></p>
    </p>
    <?php endif; ?>
    </div>
</div>
