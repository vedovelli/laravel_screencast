<?php

class Access_Controller extends Base_Controller {

	/**
	* Retornar a tela de login
	*/
	public function action_index(){

		return View::make('access.index');

	}

	/**
	* Recebe usuario, senha e remember, para efetuar o login
	*/
	public function action_login(){

		$username = Input::get('username');
		$password = Input::get('password');

		if(!$username && !$password){

			/**
			* Caso não tenha sido passado nem usuario nem senha, redireciona
			* para a tela de login com feedback para o usuario.
			*/
			return Redirect::to('access')->with('warning', 'Ambos usuario e senha são obrigatórios');

		} else {

			/**
			* Pega a informação passada atraves do checkbox remember
			*/
			$remember = Input::get('remember');

			/**
			* Monta o array com as credenciais de acesso, passando true ou null
			* na propriedade remember, para que seja criado o cookie em caso true
			*/
			$credentials﻿ = array(
				'username' => strtolower($username),
				'password' => $password,
				'remember' => !empty($remember) ? $remember : null,
			);

			/**
			* Faz o login
			*/
			if (Auth::attempt($credentials﻿)){

				return Redirect::to('/');

			} else {

				/**
				* Caso os dados informados não estejam corretos, redireciona
				* com feedback para o usuario.
				*/
				return Redirect::to('access')->with('warning', 'Falha no login');

			}
		}

	}

	public function action_logout(){
		/**
		* Efetua o logout
		*/
		Auth::logout();

		/**
		* Redireciona com feedback para o usuario
		*/
		return Redirect::to('access')->with('info', 'Logout efetuado com sucesso');

	}

}
