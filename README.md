## Introdução

    * Documentação da api Disponivel em http://localhost:8007/doc após configuração do projeto
    * Utlização deve ser realizada via Postman, Insomnia ou outra ferramenta de testes de Api

## Rodando o Projeto Via Docker

### Passo a Passo Instalação e Configuração

1. Clonar o projeto e acessar a pasta do mesmo

```
git clone https://github.com/mtripolone/ProductStore.git && cd ProductStore
```

2. Dar permissão na storage:

```
sudo chmod -R 777 storage
```

3. Copiar env.example para .env:

```
   cp .env.example .env
```

4. Buildar a docker:

```
docker-compose up -d
```

5. Acessar a docker utilizando o comando abaixo

```
docker exec -it yampi_test_app sh
```

6. Rodar os comandos de configuração para a docker:

```
composer install
php artisan key:generate
php artisan migrate
```

7. Acessar no navegador para validar:

```
http://localhost/8007
```

### Api e Utilização

#### Routes
    * Rotas Púlicas
        * Pesquisa de Produtos
            * Pesquisa por ID
            * Pequisa por nome e categoria
            * Pesquisa por produtos com e sem imagem (a URL deve ser informada no body da requisição)
            * Pesquisa por todos os produtos
            * Pesquisa por categoria
        * Gerar Token 
        * Login (para criar novo token a partir do mesmo usuário ja criado)
    * Rotas Privadas (Necessário Autenticação Sanctum)
        * Criação de Produto
        * Delete de Produto
        * Update de Produto
        * Logout/Delete Token

### Command

1. Dentro da Docker, executar o comando abaixo para importar produtos da API Fake (limit de 20)
```
php artisan products:import
```

2. Para importar um produto especifico da API Fake
```
php artisan products:import --id=1
```

By - Matheus Tripolone