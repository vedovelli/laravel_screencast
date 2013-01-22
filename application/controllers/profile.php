<?php

class Profile_Controller extends Base_Controller {

	/**
	* Exibe a lista de profiles
	* @return View object
	*/
	public function action_index(){

		/**
		* Placeholder para a lista a ser injetada na View
		*/
		$return = array();

		/**
		* Lista de usuarios obtida utilizando o Eloquent ORM com paginacao
		* Docs: http://laravel.com/docs/database/eloquent
		*/
		$users =  DB::table('profiles')->order_by('id', 'desc')->paginate(10);

		/**
		* Monta um array a ser passado para a view. Lá, a classe Table
		* do bundle Bootstrapper se encarregara de criar a tabela com a 
		* formatacao fornecida pelo Twitter Bootstrap
		*/
		foreach ($users->results as $user) {
			$return[] = array(
				'id' => $user->id,
		        'fname' => $user->firstname,
		        'lname' => $user->lastname,
		        'action1' => '<a href="'.action('profile@form', array($user->id)).'">editar</a>',
		        'action2' => '<a href="'.action('profile@excluir', array($user->id)).'" class="link_excluir">excluir</a>'
			);
		}

		/**
		* Retorna a view, passando como variaveis a lista apurada mais os links
		* da paginacao.
		*/
		return View::make('profile.lista')
			->with('body', $return)
			->with('paginate', $users->links());
	}

	/**
	* Apresenta o formulario, seja para um novo profile 
	* ou edicao de um existente
	* @param int $id (optional)
	* @return View object
	*/
	public function action_form($id = ""){
		if( isset($id) && $id > 0 ){
			$user = Profile::find($id)->to_array();
		} else {
			$user = array('id'=>'', 'firstname'=>'', 'lastname'=>'');
		}
		return View::make('profile.form')->with('user', $user);
	}

	/**
	* Salvar o profile, seja um novo ou um existente
	*/
	public function action_salvar(){

		Input::flash();

		$input = Input::get();

		$rules = array(
			'firstname' => 'required|alpha',
			'lastname' => 'required|alpha',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			$redir = 'profile/form';
			if( isset($input['id']) && $input['id'] > 0 ){
				$redir = 'profile/form/'.$input['id'];
			}
			return Redirect::to( $redir )->with_input()->with_errors($validation);
		}

		if(isset($input['id']) && $input['id'] > 0){
			$user = Profile::find($input['id']);
		} else {
			$user = new Profile();
		}

		$user->firstname = $input['firstname'];
		$user->lastname = $input['lastname'];

		try{

			$user->save();
			return Redirect::to('profile')->with('status', 'Salvo com sucesso!');

		} catch(Exception $e){

			return Redirect::to('profile/form/'.$input['id'])->with_input();

		}
	}

	/**
	* Exclui um profile
	* @param int $id
	*/
	public function action_excluir($id){
		$user = Profile::find($id);
		$user->delete();
		return Redirect::to('profile')->with('status', 'Removido com sucesso!');
	}

}