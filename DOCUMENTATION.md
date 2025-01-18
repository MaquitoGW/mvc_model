# Documentação

## Como criar uma rota?

Para criar uma rota, siga os seguintes passos:

1. No arquivo `routes/web.php`, instancie a classe de rotas:
   
   ```php
   use lib\Routes;
   
   $route = new Routes();
   ```

2. Agora, você pode definir suas rotas usando os métodos **`get`** e **`post`**:

   - **GET**: Para rotas de leitura de dados.
   - **POST**: Para rotas que manipulam dados enviados.

   Exemplo:

   ```php
   $route->get("home", [Site::class, "index"]);
   $route->post("form", [FormController::class, "submit"]);
   ```

### Explicação dos parâmetros

- O **primeiro parâmetro** é o caminho da sua rota, por exemplo:
  
  ```php
  $route->get("home");
  ```

- O **segundo parâmetro** é o controlador responsável por processar a rota. Deve ser passado como um array contendo a **classe do controlador** e o **método** a ser chamado:

  ```php
  $route->get("home", [Site::class, "index"]);
  ```

#### Criando seu controlador

Para criar um controlador, vá até o diretório `/Controllers` e crie um arquivo PHP com a seguinte estrutura:

```php
namespace Controllers;

class NomeDoControlador extends App {
    public function index() {
        // Código do método
    }
}
```

- O **segundo parâmetro** da rota é uma array e deve conter **dois valores**: [A classe do controlador, o método a chamar].
  
- O **terceiro parâmetro** é opcional e serve para indicar se a rota não faz parte de um grupo. Se não fizer parte de um grupo, defina como `true`.

---

## Grupos de Rotas

Para criar um grupo de rotas, use a estrutura de **prefixo** e **grupo**:

1. Defina o **prefixo** para todas as rotas do grupo:

   ```php
   $route->prefix("admin")->group(function ($e) {
       // Aqui vão as rotas do grupo
   });
   ```

2. Dentro do `group`, você pode definir rotas com o prefixo mencionado. Use o parâmetro da função, que neste exemplo é `$e`, para definir as rotas:

   ```php
   $route->prefix("admin")->group(function ($e) {
       $e->get("dashboard", [AdminController::class, "dashboard"]);
       $e->post("login", [AuthController::class, "login"]);
   });
   ```

#### Explicação

- O **prefixo** é um caminho que será adicionado na frente de todas as rotas dentro do grupo. Por exemplo, a rota `"dashboard"` ficará acessível em `"admin/dashboard"`.

- O parâmetro `$e` é um objeto que permite definir métodos **GET** e **POST** dentro do grupo.

---

## Finalizando as rotas

Sempre finalize suas rotas com o método:

```php
$route->exit();
```

---

## Controladores e Classes Úteis

A classe `Response` fornece métodos úteis para controle de navegação, mensagens e retornos.

### Métodos da classe `Response`

- **`redirect($url)`**: Redireciona para a URL especificada.
  
- **`back()`**: Retorna à página anterior. Funciona após um redirecionamento.

- **`message($name, $value)`**: Cria uma mensagem na sessão, ideal para usar em conjunto com `redirect` ou `back`.

   Exemplo:
   ```php
   Response::message('success', 'Operação realizada com sucesso!')->redirect('/home');
   ```

- **`getMessage($name)`**: Recupera uma mensagem da sessão. Retorna `null` se a mensagem não existir.

- **`abort($code, $message = null)`**: Retorna uma página de erro com o código HTTP fornecido. A mensagem é opcional.
  
   Exemplo:
   ```php
   Response::abort(404, 'Página não encontrada');
   ```

- **`attribute($name)`**: Recupera um parâmetro da URL. Por exemplo, em uma URL com parâmetros como `?id=1`, você pode acessar o valor de `id` com:
  
   ```php
   Response::attribute('id');
   ```

### Todos esses métodos são estáticos

Isso significa que eles podem ser chamados diretamente pela classe:

```php
Response::abort(403, 'Acesso negado');
```

---

## Personalizando Páginas de Erro

Se você deseja personalizar as páginas de erro, edite o arquivo:

```php
views/err.php
```

---

## Exibindo Páginas (Views)

Para retornar uma página de **view** no seu controlador, utilize o método `view` da classe `Response`:

```php
return Response::view("nome-da-view", ['variavel1' => $valor1, 'variavel2' => $valor2]);
```

### Estrutura de Arquivos de View

- As views são localizadas no diretório `views/`.
- Para organizar as views em pastas, siga a convenção:
  
  ```php
  Response::view("pasta.nome-da-view", ['variavel' => $valor]);
  ```

Exemplo de uma view simples em `views/index.php`:

```php
<h1>Bem-vindo, <?= $variavel ?></h1>
```
