<div align="center">
  <img src="Public/img/logo.png"  />
</div>

###

<div align="center">
  <a href="https://www.linkedin.com/in/maquitogw/" target="_blank">
    <img src="https://img.shields.io/static/v1?message=LinkedIn&logo=linkedin&label=&color=0077B5&logoColor=white&labelColor=&style=for-the-badge" height="25" alt="linkedin logo"  />
  </a>
  <a href="mailto:maicongoncalves826@gmail.com" target="_blank">
    <img src="https://img.shields.io/static/v1?message=Gmail&logo=gmail&label=&color=D14836&logoColor=white&labelColor=&style=for-the-badge" height="25" alt="gmail logo"  />
  </a>
  <a href="https://x.com/maquitogw" target="_blank">
    <img src="https://img.shields.io/static/v1?message=Twitter&logo=twitter&label=&color=1DA1F2&logoColor=white&labelColor=&style=for-the-badge" height="25" alt="twitter logo"  />
  </a>
  <a href="https://instagram.com/maquitogw" target="_blank">
    <img src="https://img.shields.io/static/v1?message=Instagram&logo=instagram&label=&color=E4405F&logoColor=white&labelColor=&style=for-the-badge" height="25" alt="instagram logo"  />
  </a>
</div>

###

<h3 align="left">👩‍💻 Sobre o Projeto</h3>

<p align="left">
  O objetivo desse projeto é testar minhas habilidades em programação PHP. Esse MVC foi fortemente inspirado no Laravel, mas com um toque personalizado. Este projeto ainda não está 100% finalizado e muitas funcionalidades ainda serão adicionadas. Abaixo estão algumas funções futuras que pretendo incluir. Este projeto foi desenvolvido utilizando o PHP 8.2.
</p>

> **🚨 Aviso Importante**: Não recomendo o uso desse MVC em projetos grandes, apenas para estudos ou em projetos de pequeno a médio porte.

### 📝 Licença

Este projeto está licenciado sob a [Licença MIT](LICENSE). Sinta-se à vontade para usar, estudar e até contribuir.

### 💪 Contribuições

Se você tem sugestões de melhorias ou correções, fique à vontade para abrir uma **issue** ou enviar um **pull request**.

### 🔮 Funcionalidades Futuras

- [❌] Middleware
- [❌] Validação de formulários
- [❌] Autenticação e Gerenciamento de SessõesSuporte a migrações de banco de dados

### 🆙 Como Baixar e Usar
> **Última versão**: v1.0-beta

Para obter a última versão estável, execute o seguinte comando no seu terminal:

```bash
git clone --branch v1.0-beta git@github.com:MaquitoGW/mvc_model.git
```

Se preferir baixar para estudos ou obter a versão mais recente, use:

```bash
git clone https://github.com/MaquitoGW/mvc_model.git
```

###
###

# Documentação do MVC Model

Esta documentação fornece uma explicação detalhada de como configurar rotas, controladores, grupos de rotas, manipulação de arquivos e banco de dados, e como utilizar o padrão MVC em seu projeto.

## Índice
- [Instruções de Configuração do Projeto](#instruções-de-configuração-do-projeto)
- [Como Criar uma Rota](#como-criar-uma-rota)
- [Grupos de Rotas](#grupos-de-rotas)
- [Controladores e Classes Úteis](#controladores-e-classes-úteis)
- [Manipulação de Arquivos](#manipulação-de-arquivos)
- [Personalização de Páginas de Erro](#personalização-de-páginas-de-erro)
- [Exibindo Páginas (Views)](#exibindo-páginas-views)
- [Manipulação de Banco de Dados (SQL)](#manipulação-de-banco-de-dados-sql)
- [Classe Request](#classe-request)



## Instruções de Configuração do Projeto

### 1. Configuração do Ambiente

Abra o arquivo `.env` na raiz do seu projeto e configure as variáveis do banco de dados e a URL do seu site:

```ini
DB=mysql
DB_HOST=localhost
DB_NAME=mvc
DB_USER=root
DB_PASS=

# Configure a URL do seu site
URL="http://localhost/"
```

Antes de rodar o projeto, você precisará instalar as dependências do Composer. No terminal, dentro da pasta do projeto, execute o seguinte comando:

```bash
composer install
```

Isso irá baixar todas as dependências necessárias para o funcionamento do seu projeto.


### 2. Estrutura de Arquivos Estáticos

Coloque todos os seus arquivos estáticos (CSS, JavaScript, imagens, fontes, etc.) na pasta `public/`.  
A pasta `public/` é onde o servidor vai procurar os arquivos acessíveis ao público, como a página inicial e arquivos de estilo.


### 3. Instruções de Uso

Após configurar o `.env` e rodar o Composer, o projeto estará pronto para uso. Aqui estão as etapas principais:

- **Configuração do banco de dados**: Certifique-se de que o banco de dados especificado no arquivo `.env` está criado e configurado corretamente.

- **Acessando o projeto**: Para rodar o projeto, basta acessar a URL configurada no `.env` (por exemplo, `http://localhost`).

> **🚨 Nota**: Agora, seu projeto deve estar pronto para uso, e você pode começar a desenvolver e personalizar conforme necessário!


## Como Criar uma Rota?

1. Abra o arquivo `routes/web.php` para definir suas rotas.

2. Use a classe `Routes` para configurar as rotas:

   ```php
   use lib\Routes;
   $route = new Routes();
   ```

3. Defina suas rotas com os métodos `get` e `post`:

   - **GET**: Para leitura de dados.
   - **POST**: Para enviar dados.

   Exemplos de rotas:

   ```php
   $route->get("home", [Site::class, "index"], true);
   $route->post("form", [FormController::class, "submit"], true);
   ```

4. Para nomear as rotas, você pode fazer o seguinte:

   ```php
   $route->post("submit", [FormController::class, "submit"], true)->name("form.submit");
   ```

5. Finalize sua configuração de rotas com o método `exit()`:

   ```php
   $route->exit();
   ```

## Grupos de Rotas

Para agrupar rotas que compartilham o mesmo prefixo, utilize o seguinte formato:

1. Defina o prefixo e agrupe as rotas:

   ```php
   $route->prefix("admin")->group(function ($e) {
       $e->get("dashboard", [AdminController::class, "dashboard"]);
       $e->post("login", [AuthController::class, "login"]);
   });
   ```

2. O prefixo define um caminho comum para todas as rotas dentro do grupo (por exemplo, `"admin/dashboard"`).

## Controladores e Classes Úteis

### Estrutura de um Controlador

Os controladores devem ser criados na pasta `Controllers` e seguir esta estrutura:

```php
namespace Controllers;

class NomeDoControlador extends App {
    public function index() {
        // Código do método
    }
}
```

### Classe `Response`

A classe `Response` oferece métodos úteis para redirecionamento, navegação, e exibição de mensagens.

#### Métodos:

- **`redirect($url)`**: Redireciona para uma URL.
- **`back()`**: Retorna à página anterior após um redirecionamento.
- **`message($name, $value)`**: Define uma mensagem de sessão.
- **`getMessage($name)`**: Obtém uma mensagem da sessão.
- **`abort($code, $message = null)`**: Exibe uma página de erro com um código HTTP.
- **`attribute($name)`**: Obtém o valor de um parâmetro na URL.

Exemplo de uso:

```php
Response::message('success', 'Operação bem-sucedida!')->redirect('/home');
```

## Manipulação de Arquivos

A classe `File` permite manipulação de arquivos e diretórios na pasta `storage`.

### Métodos da Classe `File`

- **`isDir($dir)`**: Verifica se um diretório existe. Use `get()` para retornar o resultado.
- **`isFile($file)`**: Verifica se um arquivo existe.
- **`rename($newName)`**: Renomeia um arquivo ou diretório.
- **`delete()`**: Deleta um arquivo ou diretório.
- **`permissions($mode)`**: Altera as permissões de um arquivo/diretório.
- **`save($file, $path = '')`**: Salva um arquivo no diretório especificado.
- **`readFile()`**: Lê um arquivo.

Exemplos:

```php
File::isDir("meuDiretorio", true)->get(); // Cria diretório se não existir
File::isFile("imagem.png")->delete()->get(); // Deleta arquivo
```

## Personalização de Páginas de Erro

Para personalizar as páginas de erro, edite o arquivo `views/err.php`. Um exemplo básico para exibir uma página de erro 404:

```php
Response::abort(404, 'Página não encontrada');
```

## Exibindo Páginas (Views)

Para retornar uma view dentro do controlador, utilize o método `view` da classe `Response`:

```php
return Response::view("nome-da-view", ['variavel' => $valor]);
```

### Estrutura de Arquivos de View

- As views devem estar na pasta `views/`.
- Você pode organizar as views em subpastas e referenciá-las usando o ponto (`.`) para acessar:

   ```php
   Response::view("pasta.nome-da-view", ['variavel' => $valor]);
   ```

Exemplo de view:

```php
<h1>Bem-vindo, <?= $variavel ?></h1>
```


## Manipulação de Banco de Dados (SQL)

### Conexão com o Banco de Dados

A classe `sql` gerencia a conexão e manipulação de dados no banco. A conexão é configurada com as credenciais no arquivo `.env`.

### Exemplos de Uso:

- **Inserir dados**:

   ```php
   sql::INSERT("users")->add(['name' => 'John', 'email' => 'john@example.com'])->execute();
   ```

- **Selecionar dados**:

   ```php
   $user = sql::SELECT("users")->where("id", 1)->get();
   ```

- **Atualizar dados**:

   ```php
   sql::UPDATE("users")->set(['name' => 'Jane'])->where("id", 1)->execute();
   ```

- **Deletar dados**:

   ```php
   sql::DELETE("users")->where("id", 1)->execute();
   ```

## Classe Request

A classe `Request` facilita o acesso aos dados das requisições HTTP. Use-a para acessar os dados das superglobais `$_POST`, `$_GET`, `$_FILES` e `$_SERVER`.

#### Métodos:

- **`input($name)`**: Retorna o valor de um campo `$_POST`.
- **`query($name)`**: Retorna o valor de um parâmetro `$_GET`.
- **`files($name)`**: Retorna os arquivos enviados através de `$_FILES`.
- **`header($name)`**: Retorna o valor de um cabeçalho HTTP.

Exemplo de uso:

```php
$request = new Request();

// Acessando POST
$username = $request->input('username');

// Acessando GET
$searchQuery = $request->query('search');

// Acessando arquivos
$file = $request->files('upload');

// Acessando cabeçalho
$userAgent = $request->header('user-agent');
```

###
###

<p align="center">@ 2024 Maicon Gonçalves Wandermazz</p>