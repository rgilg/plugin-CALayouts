<?php

/*CA GALLERY */

$showcasePosition = isset($options['showcase-position'])
    ? html_escape($options['showcase-position'])
    : 'none';
$showcaseFile = $showcasePosition !== 'none' && !empty($attachments);
$galleryPosition = isset($options['gallery-position'])
    ? html_escape($options['gallery-position'])
    : 'left';
$galleryFileSize = isset($options['gallery-file-size'])
    ? html_escape($options['gallery-file-size'])
    : 'thumbnail';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<?php if ($showcaseFile): ?>
<div class="gallery-showcase <?php echo $showcasePosition; ?> with-<?php echo $galleryPosition; ?> captions-<?php echo $captionPosition; ?>">
    <?php
	     $attachment = array_shift($attachments);
		 $item = $attachment->getItem(); ?>
        <?php $file = $attachment->getFile(); ?>
        <?php $altText = "Item"; ?>
            <?php if  ($title = (metadata($item, array("Dublin Core", "Title")))): ?>
            <?php $altText =  $title; ?>
            <?php endif; ?> 
       
	   <?php $href = exhibit_builder_exhibit_item_uri($item); ?>    
       <?php if  ($url = (metadata($item, array("Item Type Metadata", "URL")))): ?>
       <?php $href = $url; ?>
       <?php endif; ?> 
           
            <?php echo file_markup($file, array('imageSize'=>'fullsize', 'linkAttributes' =>array('href'=>"$href"), 'imgAttributes'=>array('alt' =>  "$altText", 'title' => metadata($item, array("Dublin Core", "Title"))))); ?>
            <?php if ($attachment['caption']): ?>
           <div class="exhibit-item-caption">
                <?php echo $attachment['caption']; ?>
          </div>
          
          <?php elseif ($description = (metadata($item, array("Dublin Core", "Description"), array('no_escape'=>TRUE)))): ?>
           <div class="exhibit-item-caption">
                <p><?php echo  $description; ?></p>
          </div>
            <?php endif; ?>
</div>
<?php endif; ?>
<div class="gallery <?php if ($showcaseFile || !empty($text)) echo "with-showcase $galleryPosition"; ?> captions-<?php echo $captionPosition; ?>">
   
   
   <?php foreach ($attachments as $attachment): ?>
  <div class="exhibit-item exhibit-gallery-item size-<?php echo $galleryFileSize; ?> ">
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
           
		   <?php echo file_markup($file, array('imageSize'=>$galleryFileSize, 'linkAttributes' =>array('href'=> "$href", 'class'=>'exhibit-item-link'), 'imgAttributes'=>array('alt' =>  "$altText", 'title' => metadata($item, array("Dublin Core", "Title")))), null); ?>
		   
		   <?php if ($attachment['caption']): ?>
           <div class="exhibit-item-caption">
                <?php echo $attachment['caption']; ?>
          </div>
          
          <?php elseif ($description = (metadata($item, array("Dublin Core", "Description"), array('no_escape'=>TRUE)))): ?>
           <div class="exhibit-item-caption">
                <p><?php echo $description; ?></p>
          </div>
            <?php endif; ?>
 
    </div>
  <?php endforeach; ?>
    
    
</div>
<?php echo $text; ?>
