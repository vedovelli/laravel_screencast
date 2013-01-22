<?php

/**
* Classe de acesso à tabela profiles no banco de dados
*/
class Profile extends Eloquent{

	/**
	* Indica que a data de criacao e atualizacao dos registros
	* serao automaticamente adicionadas pelo Model
	*/
	public static $timestamps = true;
}