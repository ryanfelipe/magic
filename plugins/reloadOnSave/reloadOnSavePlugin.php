<?php 
/**
* Plugin para recarregar a página quando templates ou php's que interferem naquela página forem salvos
*/
class ReloadOnSavePlugin extends AbstractPlugin
{
	protected $files;
	protected $version = 1.0;
	protected $compatibleWith = array("1");
	function init()
	{
		ini_set('xdebug.max_nesting_level', 0);
		$this->registerHooks();
	}
	function appendJS(){
		$this->html->addScript($this->getJs("reloadOnSave.js"));
	}
	function reload(){
		header("content-type: application/json");
		$modDate = $this->getLastModDate();
		$time = $_SESSION['roSave'.path_base];
		$json = new MAjax;
		if ($modDate !== $_SESSION['roSave'.path_base]) {
			$json->setStatusCode(200);
			$_SESSION['roSave'.path_base] = $modDate;
			$json->render();
		} else {
			$json->setStatusCode(304);
			$json->render();
		}
	}
	function getLastModDate(){
		$modDate = 0;
		foreach($this->files as $file){
			if (is_file($file)) {
				$modDateFile = filectime($file);
				if ($modDateFile > $modDate) {
					$modDate = $modDateFile;
				}
			}
		}
		return $modDate;
	}
	function setFiles($files){
		$this->files = $files;
	}
}

?>