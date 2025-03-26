# Teste Leonardo - Laravel Project

Este repositório contém o projeto Laravel. A seguir estão as instruções detalhadas para configurar e rodar o projeto.

### Requisitos

Versão do Laravel: 11.x

Versão do PHP: 8.x

Dependências:

Laravel Sail

MySQL

---

Clone o repositório usando o comando Git:

git clone **git@github.com:LeoFeitosa/teste-leonardo.git**

Se você preferir usar HTTPS, utilize:

git clone **https://github.com/LeoFeitosa/teste-leonardo.git**

---

Dentro do diretório do projeto, instale as dependências via Composer:

composer install

---

Crie o arquivo `.env` a partir do exemplo:

cp .env.example .env

No arquivo `.env`, configure as variáveis de ambiente para o banco de dados:

**DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel  
DB_USERNAME=sail  
DB_PASSWORD=password**

Ainda no arquivo `.env`, configure as credenciais para acessar a API balldontlie:

**BALLDONTLIE_URL**=https://api.balldontlie.io/v1  
**BALLDONTLIE_API_KEY**=~~se encontra no documento de descrição do teste~~

---

Instale o **Sail** com o **MySQL**:

php artisan sail:install

Suba o container do **Sail** com o seguinte comando:

./vendor/bin/sail up

Para criar as tabelas no banco de dados, execute as migrations:

./vendor/bin/sail artisan migrate

Se você quiser popular o banco com dados fictícios, execute:

./vendor/bin/sail artisan db:seed

---

Caso deseje popular o banco de dados com dados da **API balldontlie**, execute o job:

1. Coloque os **jobs** na fila:

   ./vendor/bin/sail artisan fetch:ball-dont-lie

2. Execute o *worker* para processar a fila e consumir os dados:

   ./vendor/bin/sail artisan queue:work

---

Para rodar os **testes automatizados**, utilize o comando:

./vendor/bin/sail artisan test

---

Testes práticos com **Insomnia**

Importe o arquivo de configuração do Insomnia. O arquivo **[baixe aqui](https://drive.google.com/file/d/1gB8E9Q2PG5FthH3zBqrRyVoQZdju9aJm/view?usp=drive_link)** contém todos os endpoints já configurados. Após importar, os endpoints estarão separados de forma simples e clara.

Existem dois tipos de roles para os usuários:

**Admin**: Pode realizar qualquer operação na API, incluindo criação, edição, visualização e exclusão de itens, além de gerenciar outros usuários.

**User**: Pode criar, editar e visualizar itens, mas não pode excluir itens.

Para testar os endpoints, registre um usuário com os dados neste formato:

**Admin**:
{
"name": "Teste",
"email": "teste1@email.com",
"password": "senha123",
"password_confirmation": "senha123",
"role": "admin"
}

**User**:
{
"name": "Teste",
"email": "teste2@email.com",
"password": "senha123",
"password_confirmation": "senha123",
"role": "user"
}

Após o login, o **Insomnia** irá preencher automaticamente o token no cabeçalho de todas as requisições.

Você pode usar o token de autorização nos headers dos endpoints como `X-Authorization` ou `Authorization`. Se utilizar o header `Authorization`, o token deve ser prefixado com `Bearer `:

- `Authorization: Bearer <token>`
- `X-Authorization: <token>`

Após seguir os passos acima, o projeto estará completamente funcional e pronto para ser testado.
