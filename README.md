<div align="center">
  <img src="Public/img/logo.png"  />
</div>

###

<div align="center">
  <h1>MVC Model - Framework PHP</h1>
  <p><strong>Versão 1.0-beta</strong> | Inspirado no Laravel com toques personalizados</p>
  
  ### 📚 [DOCUMENTAÇÃO PROFISSIONAL HTML](documentation.html)
  
  **[👉 Clique aqui para ver a documentação completa e interativa](documentation.html)**
  
  Ou acesse a [página de índice](docs.html) para navegar por todas as documentações.
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

- [✅] Middleware
- [✅] Validação de formulários
- [✅] Autenticação e Gerenciamento de Sessões
- [❌] Suporte a migrações de banco de dados

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

Abra o arquivo `.env` na raiz do seu projeto e configure as variáveis do banco de dados, URL e modo:

```ini
# URL do Site
URL="http://localhost/"

# Modo da Aplicação (Dev ou Production)
MODE=Dev

# Banco de Dados
DB=mysql
DB_HOST=localhost
DB_NAME=mvc
DB_USER=root
DB_PASS=

# Debug
DEBUG=true
```

**Configuração do Modo:**

```ini
# Modo Dev - Desenvolvimento
MODE=Dev
# - Exibe erros e exceções
# - Ativa debug (dd, dump, logView, cutErr)
# - Mostra stack trace detalhado

# Modo Production - Produção
MODE=Production
# - Oculta erros do usuário
# - Registra erros em storage/logs/php_errors.log
# - Desativa debug
```

Antes de rodar o projeto, instale as dependências:

```bash
composer install
```


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

## Sistema de Debug com Estilo

Sistema de debug similar ao Laravel com exibição visual atraente. As funções de debug funcionam apenas quando `DEBUG=true` está configurado no arquivo `.env`.

### Configuração

```ini
# .env
DEBUG=true   # Habilita debug
DEBUG=false  # Desabilita debug
```

### Funções de Debug

#### `dd(...$vars)`
Exibe variáveis com estilo e interrompe a execução.

```php
dd($usuario, $dados); // Exibe e para tudo
```

#### `dump(...$vars)`
Exibe variáveis com estilo sem interromper a execução.

```php
dump($usuario, $dados); // Exibe e continua
```

#### `logView($data, $label = 'INFO')`
Armazena informações em log no arquivo `storage/logs/debug.log`. Útil para registrar dados durante a execução.

```php
logView($usuario, 'USER_INFO'); // Registra em storage/logs/debug.log
logView(['status' => 'ok'], 'PROCESS');
```

#### `cutErr($callback, $logError = false)`
Captura erros com `try-catch`. Exibe o erro na tela ou registra em log conforme o parâmetro.

**Parâmetros:**
- `$callback`: Função a ser executada
- `$logError`: `false` = exibe na tela (padrão), `true` = salva em `storage/logs/errors.log`

```php
// Exibir erro na tela
cutErr(function() {
    $resultado = sql::SELECT("usuarios")->where("id", 999)->first();
    echo "ID do usuário: " . $resultado['id'];
});

// Registrar erro em log
cutErr(function() {
    $arquivo = fopen('arquivo_inexistente.txt', 'r');
}, true); // Erro será salvo em storage/logs/errors.log
```

**Exemplo com autenticação:**
```php
cutErr(function() {
    $usuario = sql::SELECT("usuarios")->where("email", $_POST['email'])->first();
    
    if (!$usuario || !password_verify($_POST['senha'], $usuario['password'])) {
        throw new Exception("E-mail ou senha incorretos");
    }
    
    session_start();
    $_SESSION['user_id'] = $usuario['id'];
    Response::redirect('/dashboard');
}, false); // Mostra erro na tela se houver
```

### Informações Exibidas

Ao usar `dd()`, `dump()` ou `cutErr()`, as seguintes informações aparecem:

- 📁 **Arquivo**: Nome do arquivo onde o debug foi chamado
- 📍 **Linha**: Número da linha
- 🌐 **Rota**: URL da requisição atual
- 📊 **Tipo de dado**: STRING, ARRAY, OBJECT, INT, BOOL, NULL
- 🔍 **Conteúdo**: Visualização completa do dado (com expandir para arrays/objetos)

### Exemplo Completo

```php
// No seu controlador
public function registrar() {
    $dados = $_POST;
    
    // Debug para verificar os dados
    dump($dados); // Exibe os dados recebidos
    
    // Capturar erro ao inserir
    cutErr(function() {
        sql::INSERT("usuarios", $dados)->execute();
        Response::message('success', 'Usuário registrado!')->redirect('/login');
    });
}
```

---

## Sistema de Cache (CacheerPHP)

Este projeto utiliza o **CacheerPHP**, um sistema de cache minimalista e poderoso com suporte a múltiplos drivers.

### Configuração do Cache

As configurações de cache são definidas no arquivo `.env`:

```ini
# Driver: file (padrão), redis, database, array
CACHE_DRIVER=file

# Redis Configuration (if using redis driver)
REDIS_HOST=localhost
REDIS_PORT=6379
REDIS_DB=0
```

### Drivers Disponíveis

- **`file`** (padrão): Armazena cache em arquivos no diretório `storage/cache`
- **`redis`**: Utiliza Redis para cache rápido em memória
- **`database`**: Armazena cache em uma tabela do banco de dados
- **`array`**: Cache em memória durante a requisição (sem persistência)

### Helpers de Cache

O projeto oferece funções auxiliares para facilitar o uso do cache:

#### `cache_put($key, $value, $ttl = null, $namespace = null)`
Armazena um valor no cache.

```php
cache_put('user_profile_1', ['name' => 'John Doe'], 3600); // TTL de 1 hora
cache_put('config_key', $value, null, 'settings'); // Com namespace
```

#### `cache_get($key, $default = null, $namespace = null)`
Recupera um valor do cache.

```php
$user = cache_get('user_profile_1');
$user = cache_get('user_profile_1', ['name' => 'Guest']); // Com valor padrão
```

#### `cache_has($key, $namespace = null)`
Verifica se uma chave existe no cache.

```php
if (cache_has('user_profile_1')) {
    $user = cache_get('user_profile_1');
}
```

#### `cache_forget($key, $namespace = null)`
Remove um valor do cache.

```php
cache_forget('user_profile_1');
```

#### `cache_flush($namespace = null)`
Limpa todo o cache (ou um namespace específico).

```php
cache_flush(); // Limpa tudo
cache_flush('settings'); // Limpa apenas o namespace 'settings'
```

#### `cache_remember($key, $ttl, $callback, $namespace = null)`
Recupera do cache ou executa um callback e armazena o resultado.

```php
$user = cache_remember('user_profile_1', 3600, function() {
    return sql::SELECT("users")->where("id", 1)->get();
});
```

#### `cache_pull($key, $default = null, $namespace = null)`
Recupera e remove uma chave do cache.

```php
$user = cache_pull('user_profile_1'); // Remove após obter
```

### Exemplo Prático

```php
public function getUserProfile($userId) {
    // Tenta obter do cache
    $user = cache_remember("user_profile_{$userId}", 3600, function() use ($userId) {
        // Se não estiver em cache, busca no banco
        return sql::SELECT("users")->where("id", $userId)->get();
    });
    
    return Response::view("user-profile", ['user' => $user]);
}
```

## Sistema de Cron Jobs

O projeto inclui um sistema completo para agendamento e execução de tarefas periódicas.

### Configuração Básica

```php
// Registrar uma tarefa que executa diariamente
Cron::register('my_task', function() {
    echo "Executando tarefa diária!";
})->daily('my_task');

// Executar crons
$result = Cron::run();
```

### Agendamentos Disponíveis

```php
// Simples
Cron::register('task', $callback)->everyMinute('task');
Cron::register('task', $callback)->everyFiveMinutes('task');
Cron::register('task', $callback)->hourly('task');
Cron::register('task', $callback)->daily('task');

// Com horário específico
Cron::register('task', $callback)->dailyAt('14:30', 'task');
Cron::register('task', $callback)->weeklyOn(1, '09:00', 'task'); // Toda segunda às 9h
Cron::register('task', $callback)->monthlyOn(15, '10:00', 'task'); // Dia 15 às 10h

// Customizado com cron expression
Cron::register('task', $callback, '*/5 * * * *'); // A cada 5 minutos
```

### Exemplos Práticos

#### Limpeza de Cache Expirado
```php
Cron::register('clear_cache', function() {
    try {
        sql::DELETE("cache")
            ->where("expires_at", "<", date("Y-m-d H:i:s"))
            ->execute();
        echo "Cache limpo com sucesso";
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
})->daily('clear_cache');
```

#### Envio de E-mails
```php
Cron::register('send_emails', function() {
    $emails = sql::SELECT("email_queue")
        ->where("status", "pending")
        ->get();
    
    foreach ($emails as $email) {
        // Mail::send($email['to'], $email['subject'], $email['body']);
        sql::UPDATE("email_queue")
            ->set(['status' => 'sent'])
            ->where("id", $email['id'])
            ->execute();
    }
})->everyFiveMinutes('send_emails');
```

### Monitoramento

```php
// Listar todas as tarefas
$tasks = Cron::list();

// Status de todas as tarefas
$status = Cron::status();

// Histórico de execução
$logs = Cron::getLog('my_task', 10); // Últimas 10 execuções

// Próxima execução
$nextRun = Cron::nextRun('0 0 * * *'); // Próxima execução diária
```

### Integração do Sistema

#### Opção 1: Rota HTTP (Recomendado)

Crie uma rota protegida que executa os crons:

```php
// routes/web.php
$route->get("admin/cron-run", [AdminController::class, "runCron"], true);

// Controllers/AdminController.php
public function runCron() {
    if (request()->query('token') !== env('CRON_TOKEN')) {
        return Response::abort(403, 'Forbidden');
    }
    return Response::json(Cron::run());
}
```

Configure no cron do sistema para chamar a cada minuto:
```bash
* * * * * curl http://seu-site.com/admin/cron-run?token=seu_token
```

#### Opção 2: Arquivo PHP Independente

Use o arquivo `cron-runner.php` na raiz do projeto:

```bash
* * * * * /usr/bin/php /caminho/para/seu/projeto/cron-runner.php
```

#### Opção 3: Windows Task Scheduler

```
schtasks /create /tn "MVC Model Cron" /tr "php C:\caminho\cron-runner.php" /sc minute
```

### Documentação Completa

Para mais informações, veja:
- [CRON.md](lib/CRON.md) - Documentação completa
- [cron_examples.php](lib/cron_examples.php) - Exemplos práticos
- [cron-runner.php](cron-runner.php) - Arquivo para execução

---

## E-mail e Autenticação com Tokens JWT

### E-mail com PHPMailer

O sistema integra a biblioteca **PHPMailer** para envio seguro de e-mails via SMTP. Suporta Gmail, Outlook, AWS SES e qualquer servidor SMTP.

#### Configuração

```env
# .env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_senha_app
MAIL_FROM_NAME=Seu Site
```

#### Uso Básico

```php
use lib\Mail;

// Envio simples
$mail = new Mail();
$resultado = $mail->send('Subject', '<h1>Olá!</h1>', ['recipient@example.com']);

if ($resultado['success']) {
    echo "E-mail enviado com sucesso!";
} else {
    echo "Erro: " . $resultado['error'];
}
```

#### Em Controllers

```php
public function enviarBemVindo($email) {
    $mail = new Mail();
    $html = "<h1>Bem-vindo!</h1><p>Sua conta foi criada com sucesso.</p>";
    
    return $mail->send('Bem-vindo ao site', $html, [$email]);
}
```

#### Com Cron Jobs

```php
Cron::register('send_pending_emails', function() {
    $mail = new Mail();
    $emails = sql::SELECT("email_queue")->where("status", "pending")->get();
    
    foreach ($emails as $email) {
        $mail->send($email['subject'], $email['body'], [$email['recipient']]);
        sql::UPDATE("email_queue")->set(['status' => 'sent'])->where("id", $email['id'])->execute();
    }
})->everyFiveMinutes('send_pending_emails');
```

### Autenticação com JWT

O sistema usa **Firebase/php-jwt** para criar e validar tokens seguros. Ideal para APIs e autenticação stateless.

#### Uso Básico

```php
use lib\Token;

// Criar token
$token = Token::create($user_id);
// Retorna: eyJ0eXAiOiJKV1QiLCJhbGc...

// Validar token
if (Token::isValid($token)) {
    echo "Token válido!";
    $payload = Token::decode($token);
    $user_id = $payload->user_id;
} else {
    echo "Token inválido ou expirado";
}
```

#### Autenticação em Middlewares

```php
// Middlewares/AuthTokenMiddleware.php
class AuthTokenMiddleware extends Middleware {
    public function handle() {
        $token = request()->bearerToken();
        
        if (!$token || !Token::isValid($token)) {
            return Response::abort(401, 'Unauthorized');
        }
        
        $payload = Token::decode($token);
        request()->setUser($payload);
    }
}
```

#### Login com Geração de Token

```php
public function login($email, $password) {
    $user = sql::SELECT("users")->where("email", $email)->first();
    
    if ($user && password_verify($password, $user['password'])) {
        $token = Token::create($user['id']);
        return Response::json(['token' => $token, 'user' => $user]);
    }
    
    return Response::json(['error' => 'Invalid credentials'], 401);
}
```

#### Validação de Token no Frontend

```javascript
// JavaScript - Fetch API
const token = localStorage.getItem('authToken');

fetch('/api/perfil', {
    headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
    }
})
.then(r => r.json())
.then(data => console.log(data));
```

### Documentação Detalhada

Para mais informações e exemplos avançados, veja:
- [EMAIL_TOKEN.md](lib/EMAIL_TOKEN.md) - Guia completo de e-mail e tokens
- Configuração de Gmail, Outlook e AWS SES
- Fluxos de autenticação avançados
- Segurança e best practices

---

### Agradecimentos especiais

Este projeto integra o **[CacheerPHP](https://github.com/CacheerPHP/CacheerPHP)**, um sistema de cache excelente desenvolvido por **[Silvio Silva](https://github.com/silviooosilva)**. 

Agradecemos sinceramente ao criador pela criação de uma solução de cache tão bem estruturada, minimalista e fácil de usar. A implementação do CacheerPHP neste projeto contribui significativamente para melhorar a performance e a eficiência da aplicação, oferecendo suporte a múltiplos drivers de cache e uma API intuitiva.

Se você encontrar valor no CacheerPHP, considere apoiar o desenvolvedor através do [Buy Me a Coffee](https://buymeacoffee.com/silviooosilva) ou contribuindo no repositório.

###
###

<p align="center">@ 2024 Maicon Gonçalves Wandermazz</p>