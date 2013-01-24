<?php

class Home_Controller extends Base_Controller {

	/**
	* Filtro no construtor determina que todos os métodos acessados
	* via rotas deste controller necessitam de usuario logado
	*/
	function __construct(){
		$this->filter('before', 'auth')->except(array('db'));
	}

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
	public function action_db()
	{

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
			Schema::table('users', function($table){
				$table->create();
				$table->increments('id');
				$table->string('username');
				$table->string('password', 60);
			});
			return 'Sucesso';
		} catch(Exception $e){

			return 'Tabela já existe. Nenhuma ação adicional.';

		}
	}

}