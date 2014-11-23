<?php 
add_filter( 'post_gallery', 'fat_custom_post_gallery', 10, 2 );
function fat_custom_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;
    $imagesPerPage = 15;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'size'       => 'thumbnail',
        'perpage'    => $imagesPerPage,
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array(
            'include' => $include, 
            'post_status' => 'inherit', 
            'post_type' => 'attachment', 
            'post_mime_type' => 'image', 
            'order' => $order, 
            'orderby' => $orderby
            ));

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array(
            'post_parent' => $id,
            'exclude' => $exclude,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
            ));

    } else {
        $attachments = get_children( array(
            'post_parent' => $id,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
            ));
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }




//PAGINATION
    // Work out how many pages we need and what page we are currently on
    $imageCount = count( $attachments );
    $pageCount = ceil( $imageCount / $imagesPerPage );
    $getgalleryPage = ""; // gets rid of the undefined index notice
    if(isset( $_GET['galleryPage'] )){ $getgalleryPage = $_GET['galleryPage']; }

    $currentPage = intval( $getgalleryPage );
    if ( empty($currentPage) || $currentPage <= 0 ) $currentPage = 1;
    
    $maxImage = $currentPage * $imagesPerPage;
    $minImage = ( $currentPage -1 ) * $imagesPerPage;
    
    
    if ($pageCount > 1)
    {
        $page_link = get_permalink();
        $page_link_perma = true;
        if ( strpos($page_link, '?')!== false )
            $page_link_perma = false;

        $gplist = '<div id="gallery__top" class="gallery__pages-list pagination cf"><ul id="sneak-scroll" class="page-numbers">';
        for ( $j = 1; $j <= $pageCount; $j++)
        {
            if ( $j == $currentPage )
                $gplist .= '<li><span class="page-numbers current">'.$j.'</span></li>';
            else
                $gplist .= '<li><a class="page-numbers" href="'.$page_link. ( ($page_link_perma?'?':'&amp;') ). 'galleryPage='.$j.'">'.$j.'</a></li>';
        }

        $gplist .= '</ul></div>';
    }
    else
        $gplist = '';
//END PAGINATION



//gallery html output

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = "<h4>Gallery</h4><div id='$selector' class='gallery galleryid-{$id}'>";

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        if ($k >= $minImage && $k < $maxImage) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        }
        $k++;
    }

    $output .= "\n<div style='clear: both;' />&nbsp;</div>$gplist\n</div>\n";

    return $output;
}?>