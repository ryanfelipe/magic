<?php 
/**
* Compilador padrão de unidade css do Magic
*/
class MagicDefaultJsCompiladorMinificacaoDecorator extends AbstractCompiladorDecorator
{
	
	public function compilar($content)
	{
		return $content;
		//return \JShrink\Minifier::minify($content);
	}
}
?>