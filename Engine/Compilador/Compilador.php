<?php 
	namespace Magic\Engine\Compilador;
	Class Compilador implements InterfaceCompilador {
		public function compilarTodos($conteudo){
			return $this->compilar($conteudo);
		}
		public function compilar($conteudo){
			return $conteudo;
		}
	}
?>