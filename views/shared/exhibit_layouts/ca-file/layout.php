<?php

/*CA FILE */
$position = isset($options['file-position'])
    ? html_escape($options['file-position'])
    : 'left';
$size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'fullsize';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<div class="exhibit-items <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">

 <?php foreach ($attachments as $attachment): ?>
        <?php $item = $attachment->getItem(); ?>
        <?php $file = $attachment->getFile(); ?>
        <?php $altText = "Item"; ?>
            <?php if  ($title = (metadata($item, array("Dublin Core", "Title")))): ?>
            <?php $altText =  $title; ?>
            <?php endif; ?> 
       <?php $href = exhibit_builder_exhibit_item_uri($item); ?>    
       <?php if  ($url = (metadata($item, array("Item Type Metadata", "URL")))): ?>
       <?php $href = $url; ?>
       <?php endif; ?> 
               
        
            <?php echo file_markup($file, array('imageSize'=>$size, 'linkAttributes' =>array('href'=>"$href", 'class'=>'exhibit-item-link'), 'imgAttributes'=>array('alt' =>  "$altText", 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>
           <?php if ($attachment['caption']): ?>
           <div class="exhibit-item-caption">
                <?php echo $attachment['caption']; ?>
          </div>       
          <?php elseif ($description = (metadata($item, array("Dublin Core", "Description"), array('no_escape'=>TRUE)))): ?>
           <div class="exhibit-item-caption">
                <p><?php echo  $description; ?></p>
          </div>
            <?php endif; ?>
 
      
  <?php endforeach; ?>
</div>

