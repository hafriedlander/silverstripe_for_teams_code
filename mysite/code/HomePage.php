<?php

class HomePage extends Page {
	static $many_many = [
		'CarouselImages' => 'Image'
	];

	static $many_many_extraFields = [
		'CarouselImages' => [
			'Sort' => 'Int'
		]
	];

	function OrderedCarouselImages() {
		return $this->CarouselImages()->Sort('Sort');
	}

	function getCMSFields() {
		$fields = parent::getCMSFields();

		// Create a GridField configuration based off an existing template
		$config = GridFieldConfig::create();

		$config->addComponent(new GridFieldButtonRow('before'));
		$config->addComponent(new GridFieldAddExistingAutocompleter('buttons-before-right'));
		$config->addComponent(new GridFieldToolbarHeader());
		$config->addComponent($dataCols = new GridFieldDataColumns());
		$config->addComponent(new GridFieldDeleteAction(true));
		$config->addComponent(new GridFieldOrderableRows());

		$dataCols->setDisplayFields(['CMSThumbnail' => 'Thumbnail', 'Title' => 'Title']);

		$grid = GridField::create('Carousel', 'Carousel', $this->CarouselImages(), $config);

		$fields->addFieldToTab('Root.Carousel', $grid);

		return $fields;
	}
}

class HomePage_Controller extends Page_Controller {

	function CarouselStyle() {
		$details = new ArrayList();

		$count = $this->CarouselImages()->Count();
		$time = $count * 3;

		for ($i = 0; $i < $count; $i++) {
			$details->push(new ArrayData([
				'Time'            => $time,
				'I'               => $i,
				'ZIndex'          => ($count - $i),
				'TransitOutStart' => floor(100 / $count) * $i + floor(100 / $count * .8),
				'TransitOutEnd'   => floor(100 / $count) * $i + floor(100 / $count),
				'TransitInStart'  => $i == 0 ? 100 - floor(100 / $count * .2) : 99.9
			]));

			return $details;
		}
	}
}
