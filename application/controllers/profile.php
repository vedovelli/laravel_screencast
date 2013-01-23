<?php

class Profile_Controller extends Base_Controller {

	/**
	* Filtro no construtor determina que todos os métodos acessados
	* via rotas deste controller necessitam de usuario logado
	*/
	function __construct(){
		$this->filter('before', 'auth');
	}

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

		/**
		* Verifica se o $id foi passado. Caso positivo, trata-se
		* de uma acao de edicao. Busca-se o profile no DB e o injeta
		* na View. Caso contrario, cria-se um array contendo as propriedades
		* esperadas, tambem injetando na View.
		* @todo Melhorar esta parte adicionando um VO.
		*/
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

		/**
		* Guarda em memoria os valores vindos do form para
		* repassar aa View em caso de erro de validacao.
		* Docs: http://laravel.com/docs/input#old-input
		*/
		Input::flash();

		/**
		* Pega todos os dados passados atraves do form
		*/
		$input = Input::get();

		/**
		* Array com regras de validacao.
		* Docs: http://laravel.com/docs/validation#validation-rules
		*/
		$rules = array(
			'firstname' => 'required|alpha',
			'lastname' => 'required|alpha',
		);

		/**
		* Executa a validacao, recebendo como parametros
		* os valores inputados no form e as regras determinadas
		* acima.
		*/
		$validation = Validator::make($input, $rules);

		/**
		* Se a validacao falhar, determina se a acao foi uma inclusao ou edicao
		* para redirecionar para o form passando ou nao o ID do profile. Faz o
		* redirecionamento
		*/
		if ($validation->fails())
		{
			$redir = 'profile/form';
			if( isset($input['id']) && $input['id'] > 0 ){
				$redir = 'profile/form/'.$input['id'];
			}
			return Redirect::to( $redir )->with_input()->with_errors($validation);
		}

		/**
		* Determina se eh uma edicao. Caso seja, obtem o profile armazenado no DB.
		* Caso contrário, cria um novo objeto do Model
		*/
		if(isset($input['id']) && $input['id'] > 0){
			$user = Profile::find($input['id']);
		} else {
			$user = new Profile();
		}

		/**
		* Preenche o objeto do Model com as informacoes vindas do form
		*/
		$user->firstname = $input['firstname'];
		$user->lastname = $input['lastname'];

		try{

			/**
			* Salva o profile, redirecionando para a lista com mensagem de sucesso
			* A mensagem existira apenas em memoria no primeiro carregamento da lista
			*/
			$user->save();
			return Redirect::to('profile')->with('status', 'Salvo com sucesso!');

		} catch(Exception $e){

			/**
			* Em caso de falha, redireciona para o formulario, com os valores
			* passados para este metodo. Os valores serao utilizados para
			* preencher os campos do form.
			* @todo Adicionar mensagem de erro
			*/
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