<?php
require_once LIB_DIR . '/globals.php';

function make_item_head($item) {
    $head = '';
    if ($author = metadata($item, array('Dublin Core', 'Creator')))
        $head = $author;
    if ($title = metadata($item, array('Dublin Core', 'Title'))) {
        if (strlen($head) > 0)
            $head .= ', ';
        $head .= $title;
    }
    return $head;
}

function get_theme_option_with_default($option, $def, $theme = null) {
    $value = get_theme_option($option, $theme);
    if ($value == null || strlen($value) == 0)
        $value = $def;
    return $value;
}

function get_year($date) {
    if ($date == null || $date == 'na')
        return null;
    $parse = date_parse($date);
    if ($parse['error_count'] > 0)
        return $date;
    $year = $parse['year'];
    if ($year != null && strlen($year) > 0)
        return $year;
    return $date;
}

function add_element($citation, $element, $begin = null, $end = null, $separator = ', ') {
    if ($element == null)
        return $citation;
    $element = trim($element);
    if (strlen($element) == 0 || $element == 'na')
        return $citation;
    if ($separator && strlen($citation) > 0)
        $citation .= $separator;
    if ($begin)
        $citation .= $begin;
    $citation .= $element;
    if ($end)
        $citation .= $end;
    return $citation;
}

function make_article_citation($item, $html) {
    $collection =  get_collection_for_item($item);
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), '\'', '\'');
    $journal = metadata($item, array('Dublin Core', 'Source'));
    if (!$journal && $collection)
        $journal = metadata($collection, array('Dublin Core', 'Title'));
    $citation = add_element($citation, $journal, $html ? '<em>' : null, $html ? '</em>' : null);
    $publisher = metadata($item, array('Dublin Core', 'Publisher'));
    if (!$publisher && $collection)
        $publisher = metadata($collection, array('Dublin Core', 'Publisher'));
    $citation = add_element($citation, $publisher);
    return $citation;
}

function make_paper_citation($item, $html) {
    $collection =  get_collection_for_item($item);
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), '\'', '\'');
    $conference = metadata($item, array('Dublin Core', 'Source'));
    if (!$conference && $collection)
        $conference = metadata($collection, array('Dublin Core', 'Title'));
    $citation = add_element($citation, $conference, $html ? __('in') . ' <em>' : null, $html ? '</em>' : null);
    $editor = metadata($item, array('Dublin Core', 'Contributor'));
    if (!$editor && $collection)
        $editor = metadata($collection, array('Dublin Core', 'Creator'));
    $citation = add_element($citation, $editor, __('ed. '));
    $publisher = metadata($item, array('Dublin Core', 'Publisher'));
    if (!$publisher && $collection)
        $publisher = metadata($collection, array('Dublin Core', 'Publisher'));
    $citation = add_element($citation, $publisher);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Date')));
    return $citation;
}

function make_book_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), $html ? '<em>' : null, $html ? '</em>' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Contributor')), __('ed. '));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Publisher')));
    return $citation;
}

function make_manual_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), $html ? '<em>' : null, $html ? '</em>' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Identifier')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Source')));
    return $citation;
}

function make_thesis_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), $html ? '<em>' : null, $html ? '</em>, thesis' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Identifier')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Source')));
    return $citation;
}

function make_report_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), $html ? '<em>' : null, $html ? '</em>' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Identifier')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Source')));
    return $citation;
}

function make_text_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), $html ? '<em>' : null, $html ? '</em>' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Publisher')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Date')));
    return $citation;
}

function make_website_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Title')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Source')), $html ? '<span class="citation-url">' : null, $html ? '</span>' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Date')), __('accessed '));
    return $citation;
}

function make_hyperlink_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Title')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Source')), $html ? '<span class="citation-url">' : null, $html ? '</span>' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Date')), __('accessed '));
    return $citation;
}

function make_moving_image_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')));
    return $citation;
}

function make_still_image_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, get_year(metadata($item, array('Dublin Core', 'Date'))), null, null, ' ');
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')));
    return $citation;
}

function make_default_citation($item, $html) {
    $citation = add_element("", metadata($item, array('Dublin Core', 'Creator')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Title')), $html ? '<em>' : null, $html ? '</em>' : null);
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Identifier')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Publisher')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Source')));
    $citation = add_element($citation, metadata($item, array('Dublin Core', 'Date')));
    return $citation;
}

function make_citation($item, $html = true) {
    $type = $item->getItemType();
    $type = $type ? $type->name : 'Unknown';
    if ($type == get_theme_option_with_default('Article Item Type', 'Article'))
        return make_article_citation($item, $html);
    if ($type == get_theme_option_with_default('Conference Paper Type', 'Conference Paper'))
        return make_paper_citation($item, $html);
    if ($type == get_theme_option_with_default('Book Item Type', 'Book'))
        return make_book_citation($item, $html);
    if ($type == get_theme_option_with_default('Manual Item Type', 'Manual'))
        return make_manual_citation($item, $html);
    if ($type == get_theme_option_with_default('Thesis Item Type', 'Thesis'))
        return make_thesis_citation($item, $html);
    if ($type == get_theme_option_with_default('Report Item Type', 'Report'))
        return make_book_citation($item, $html);
    if ($type == get_theme_option_with_default('Text Item Type', 'Text'))
        return make_book_citation($item, $html);
    if ($type == get_theme_option_with_default('Website Item Type', 'Website'))
        return make_website_citation($item, $html);
    if ($type == get_theme_option_with_default('Hyperlink Item Type', 'Hyperlink'))
        return make_hyperlink_citation($item, $html);
    if ($type == get_theme_option_with_default('Moving Image Item Type', 'Moving Image'))
        return make_moving_image_citation($item, $html);
    if ($type == get_theme_option_with_default('Still Image Item Type', 'Still Image'))
        return make_still_image_citation($item, $html);
    return make_default_citation($item, $html);
}

function get_random_hero_shot() {
    foreach (get_records('Collection', array('featured' => true, 'sort_field' => 'random')) as $collection) {
        foreach (get_records('Item', array('collection' => $collection->id, 'hasImage' => true, 'sort_field' => 'random')) as $item)
            return $item;
    }
    return null;
}