# Projeto Laravel API de Usuários

Este projeto é uma API RESTful construída usando o framework Laravel. Ele permite realizar operações CRUD (Criar, Ler, Atualizar, Deletar) em uma lista de usuários.

## Começando

Siga estas instruções para obter uma cópia do projeto operacional em sua máquina local para fins de desenvolvimento.

## Instalação

1. Clonar o Repositório

    ```
    git clone https://github.com/Mirian97/crud-user-laravel-11.git

    cd crud-user-laravel-11
    ```

2. Instalar Dependências

    ```
    composer install
    ```

3. Configurar o Ambiente: Copie o arquivo .env.example para .env

    ```
    cp .env.example .env
    ```

4. Gerar a Chave da Aplicação

    ```
    php artisan key:generate
    ```

5. Rodar as Migrations: Execute as migrations para criar as tabelas do banco de dados

    ```
    php artisan migrate
    ```

6. Iniciar o servidor de desenvolvimento

    ```
    php artisan serve
    ```

    Isso iniciará o servidor em http://localhost:8000

## Fazendo Requisições

Agora que o servidor está rodando, você pode fazer requisições para os endpoints definidos. Aqui estão alguns exemplos usando curl:

-   Listar Usuários

    ```
    curl http://localhost:8000/users
    ```

-   Mostrar detalhes de um Usuário

    ```
    curl http://localhost:8000/users/1
    ```

-   Adicionar um Novo Usuário

    ```
    curl -X POST http://localhost:8000/users \
     -H 'Content-Type: application/json' \
     -d '{"name": "John Doe", "email": "john@example.com", "password": "yourpassword"}'
    ```

-   Atualizar Usuário

    ```
    curl -X PUT http://localhost:8000/users/1 \
     -H 'Content-Type: application/json' \
     -d '{"name": "John Updated", "email": "johnupdated@example.com", "password": "newpassword"}'
    ```

-   Excluir Usuário

    ```
    curl -X DELETE http://localhost:8000/users/1
    ```
