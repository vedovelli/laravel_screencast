#Código de suporte ao futuro screencast sobre Laravel Framework
*Laravel* - docs: http://laravel.com/docs/

## Instruções

* Clonar o repositorio na pasta escolhida para ser a pasta do projeto
* Configurar o Laravel (acredite: é simples!)
	Docs: http://laravel.com/docs/install
* Criar um virtual host local apontando para a `pasta_de_instalacao/public/` *(neste caso o Google é seu melhor amigo.)*
* Acessar a URL `http://*seu_host_local*>/home/db` para criar a tabela *profiles* no banco de dados.
* Insira o usuario no banco de dados

```sql
INSERT INTO users (id, username, password) 
VALUES 
(1, 'vedovelli', '$2a$08$L/r8zfEdfYQyAGyte0TULuhA7eLuY1uq1UiQXVcEiZX2OKEmoy/wa');

```

* Acessar a URL `http://*seu_host_local*>/`
* Usuário e senha: vedovelli/1234

Só isso!

## Código da aplicação
O código específico da aplicação pode ser encontrado nos seguintes diretórios
* application/controllers
* application/models
* application/views
* public/css
* public/js

## Observações
* Não há AJAX. A aplicação é oldschool.