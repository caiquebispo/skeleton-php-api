# Skeleton PHP Application

## Descrição

Este é uma estrutura de projeto em PHP puro moderno usando os mais variados recursos disponíveis na comunidade.

## Requisitos

- Vesao do PHP 8.4
- Composer

## Instalação

1. Clone o repositório:
    ```sh
    git clone https://github.com/caiquebispo/skeleton-php-application.git
    cd skeleton-php-application
    ```
2. Entrando no contêiner:
    ```sh
    docker exec -it skeleton-php-application bash
    ```
   
3. Instale as dependências:
    ```sh
    composer install
    ```

4. Configure o arquivo `.env`:
    ```sh
    cp .env.exemple .env
    ```

## Estrutura do Projeto

- `App/Controllers`: Contém os controladores da aplicação.
- `App/Models`: Contém os modelos da aplicação.
- `database/migrations`: Contém os arquivos de migração do banco de dados.
- `public`: Contém os arquivos públicos acessíveis via web (ex: index.php).
- `composer.json`: Arquivo de configuração do Composer.

## Configuração do Banco de Dados

O arquivo `.env` deve ser configurado com as informações do banco de dados. Exemplo para SQLite:

```dotenv
DB_CONNECTION="sqlite"
DB_HOST=""
DB_DATABASE="../database/skeleton_db.sqlite"
DB_USERNAME=""
DB_PASSWORD=""
```

## Uso

### Criar uma Nova Migração

Para criar uma nova migração, utilize o comando:

```sh
composer migration-create NomeDaMigration
```


### Executar Migrações

As migrations são executadas automaticamente ao iniciar o contêiner:

### Exemplo de Controlador

```php
<?php

namespace Skeleton\SkeletonPhpApplication\Controllers;

use Illuminate\Routing\Controller;
use Skeleton\SkeletonPhpApplication\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return User::all();
    }
}
```

## Autores

- Caique Bispo (caiquebispodanet86@gmail.com)

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

