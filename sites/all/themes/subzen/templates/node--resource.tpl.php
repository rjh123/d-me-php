<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>

      <?php if ($unpublished): ?>
        <mark class="unpublished"><?php print t('Unpublished'); ?></mark>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <div class="type-image-wrapper">

<?php
// figure out rti sub image of none for some resources
    // if ($variables['type'] == 'resource'){
    //   $items = field_get_items('node', $node, 'field_resource_image');
    //   $type = field_get_items('node', $node, 'field_resource_type');
    //   if(!empty($field)){
    //     //print "mistake";
    //     print render($content['field_resource_image']);
    //   }elseif{
    //     $type == 'document'
    //   }
    // }
?>
<?php
switch ($node->type) {
    //case 'booklet': $resource_image = 'field_image_for_booklet'; break;
    case 'documents': $resource_image = 'field_document_image'; break;
    case 'external_links_websites': $resource_image = 'field_link_website_image'; break;
    case 'module_resource':  $resource_image = 'field_online_module_image'; break;
    case 'podcast': $resource_image = 'field_podcast_image'; break;
    case 'presentation': $resource_image = 'field_presentation_image'; break;
    case 'resource_page': $resource_image = 'field_resource_page_image'; break;
    case 'video_resource': $resource_image = 'field_video_thumbnail_image'; break;
    case 'webinar': $resource_image = 'field_webinar_image'; break;
  }
?>

<?php
// figure out rti sub image of none for some resources
// set variable for each of the term id's

  $items = field_get_items('node', $node, 'field_resource_image');
  $type = field_get_items('node', $node, 'field_resource_type');
  $documents = $variables['field_resource_type'][0]['taxonomy_term']->tid == '13';
  if(empty($items)){
    switch($type){
      case 'documents' : echo "<img src='/sites/all/themes/subzen/images/document-icon-large.png' >";

      }
    }
    
    //if($variables['field_resource_type'][0]['taxonomy_term']->tid == '13'){
      
    //}
  }
?>

    <?php print render($content['field_resource_type']); ?>
    <?php print render($content['field_resource_image']); ?>
  </div>


  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);




    //print render($content);
  ?>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</article>
