<?php
class CALayoutsPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_filters = array('exhibit_layouts');

	protected $_hooks = array('public_head');

    public function hookPublicHead($args)
    {
        queue_css_file('jcarousel.responsive');
        queue_js_file('jcarousel.responsive');
        queue_js_file('jquery.jcarousel.min');
    }

    public function filterExhibitLayouts($layouts)
    {
    $layouts['ca-file'] = array(
            'name' => 'CA File',
            'description' => 'Custom version of File layout.'
        );
		$layouts['ca-file-text'] = array(
            'name' => 'CA File with Text',
            'description' => 'Custom version of File with Text layout.'
        );
		$layouts['ca-gallery'] = array(
            'name' => 'CA Gallery',
            'description' => 'Custom version of Gallery layout.'
        );

		$layouts['ca-slideshow'] = array(
            'name' => 'CA Slideshow',
            'description' => 'Layout for displaying JCarousel slideshows of Omeka items.'
        );

        return $layouts;
    }
}
