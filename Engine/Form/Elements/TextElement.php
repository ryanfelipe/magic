<?php 
namespace Magic\Engine\Form\Elements;
use Magic\Engine\Form\AbstractElement;
use Magic\Engine\Form\ElementView;

/**
* 		
*/
class TextElement extends AbstractElement
{
	public $attrs = array("type"=>"text");

	function setUp(){
		global $registry;
		$this->view = $registry->ViewHandler->prepare(new ElementView("input",$this));
	}
	
}

?>