<p align="center"><img src="https://www.infracommerce.com.br/wp-content/themes/beetech/images/infracommerce.svg"></p>

## Sobre

API challenge

## Instalação

```bash
# clonar repositório
git clone https://github.com/rogerfernandezv/infracart

# Acessar pasta
cd infracart

# instalar componentes
composer install

# copiar .env
cp .env.example .env

# gerar key
php artisan key:generate

# criar arquivo sqlite
touch database/database.sqlite

# migrate
php artisan migrate

# seed
php artisan db:seed

# to testing using php builtin server
php artisan serve

```

## Produtos cadastrados com seed

| Id  | Nome              | Valor
| --- | ---               | ---
| 1   | IPhone Xs         | 7500
| 2   | Notebook          | 4000
| 3   | Macbook           | 9500
| 4   | Tv Samsung        | 2599.99

## Como usar

Pode ser usado postman:
https://www.getpostman.com/

Um json das chamadas para postman pode ser encontrado na pasta _postman

Endpoints v1:

| Endpoints     			| Method 	| Body 	                      | Description
| ---      					| ---       | ---	                      | ---
| /api/v1/carrinho  		| GET       | 		                      | Lista todos carrinhos e produtos
| /api/v1/carrinho/{id}  	| GET       | 		                      | Lista todos produtos de um carrinho
| /api/v1/carrinho     		| POST      | produto_id, quantidade      | Cadastra um carrinho com produto
| /api/v1/carrinho/{id}     | POST      | produto_id, quantidade      | Cadastra um produto em um carrinho
| /api/v1/carrinho/{id}  	| PUT    	| produto_id, quantidade	  | Atualiza quantidade de um produto de um carrinho
| /api/v1/carrinho/{id}	    | DELETE    | produto_id 		          | Deleta um produto de um carrinho


## Licença

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
