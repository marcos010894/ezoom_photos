# Configuração do Projeto

Este projeto é composto por duas partes: o back-end, que é construído com Laravel, e o front-end, que é uma aplicação PHP simples.

## Pré-requisitos

- Certifique-se de ter um servidor com PHP ^8.
- O back-end roda com Laravel, então, certifique-se de ter o Laravel e o Composer instalados.

## Configurando o Back-end

1. Acesse seu servidor de gerenciamento de banco de dados (MySQL).
2. Importe o arquivo `ezoom_packs.sql` para o banco de dados.
3. Copie o arquivo `.env.example`: Copie o arquivo `.env.example` para `.env`. Você pode fazer isso com o comando `cp .env.example .env`.
4. Configure o arquivo `.env`: Edite o arquivo `.env` para incluir suas configurações de banco de dados. Você precisará fornecer o nome do banco de dados, o usuário, a senha e o host.

Agora, vamos configurar o projeto usando o Composer:

5. Instale as dependências do Composer: Navegue até o diretório do projeto e execute `composer install`. Isso instalará todas as dependências PHP que o projeto precisa.
6. Execute as migrações do banco de dados: Execute `php artisan migrate` para criar as tabelas necessárias no seu banco de dados.
7. Inicie o servidor de desenvolvimento: Finalmente, você pode iniciar o servidor de desenvolvimento executando `php artisan serve`. Você deve ser capaz de acessar o aplicativo em http://localhost:8000.

## Configurando o Front-end

1. Altere a rota no arquivo `axiosbase.js` de acordo com o seu ambiente local, por exemplo, `http://localhost:8000`.
2. Dentro do script `uploadImages`, configure a variável `$url` de acordo, mantendo a mesma endpoint.

Em seguida, basta rodar o seu projeto do front-end em qualquer local que roda o PHP 8^ como o XAMPP, LAMPP entre outros. 

Se você tiver o PHP devidamente instalado, você pode usar o comando `php -S localhost:8090` para iniciar o servidor.
