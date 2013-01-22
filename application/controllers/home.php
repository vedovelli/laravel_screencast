<?php

class Home_Controller extends Base_Controller {

	/**
	* Responsavel por exibir o Dashboard
	*/
	public function action_index()
	{
		return View::make('home.index');
	}

	/**
	* Responsavel por criar a tabela no banco de dados
	*/
	public function action_db(){

		/**
		* Docs: http://laravel.com/docs/database/schema
		*/
		try{
			Schema::table('profiles', function($table){
				$table->create();
				$table->increments('id');
				$table->string('firstname');
				$table->string('lastname');
				$table->timestamps();
			});
			return 'Sucesso';
		} catch(Exception $e){
			return 'Tabela já existe. Nenhuma ação adicional.';
		}
	}

}