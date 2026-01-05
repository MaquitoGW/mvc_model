### Versão 1.0.0

#### Problemas resolvidos:

- **Rotas demoradas para carregamento**  
  Antes, ao tentar buscar uma rota, se a rota estivesse disponível apenas depois de uma interação, a página precisava ser recarregada para exibir o caminho corretamente.  
  **Solução:** Agora, a chamada da classe do controlador só ocorre ao final, no método `exit()`. Métodos `POST` e `GET` verificam se o valor da URL coincide com o método chamado, enviando a array da classe e método do controlador. Em seguida, o cabeçalho é enviado e, no final, o `exit()` os chama. Com isso, as rotas percorrem todas as rotas definidas e identificam aquelas que possuem o nome correto.

- **Problemas de sessão duplicada**  
  Antes, a sessão estava sendo iniciada em múltiplos locais, causando erros de "sessão já iniciada".  
  **Solução:** Implementação de um **Middleware** responsável por iniciar a sessão em um único ponto centralizado.

- **Uso incorreto de AND em SQL**  
  O SQL não utilizava corretamente a cláusula `AND` ao definir múltiplos `where` ou `whereLike` nas consultas.  
  **Solução:** Correção na lógica para garantir que múltiplas condições utilizem `AND` corretamente.

- **Método Query personalizado**  
  Foi adicionado o método `Query()` que permite realizar buscas com SQL personalizado, mantendo a compatibilidade com as demais funções do sistema.

- **Erros em caminhos de arquivos e diretórios**  
  Houve correção nos erros de obtenção dos caminhos corretos de arquivos e diretórios.

- **Sistema de sessões de usuário**  
  Um novo sistema de sessões de usuário foi criado para evitar conflitos com o `Session` já em uso pelo sistema.

---

#### Melhorias implementadas:

- **Sistema de Debug com Estilo**  
  Implementado um sistema de debug similar ao Laravel com funções `dd()`, `dump()`, `logView()` e `cutErr()` que exibem variáveis com estilo visual atraente. As funções incluem exibição de rota e tratamento inteligente de erros. Apenas funcionam quando `DEBUG=true` está configurado no `.env`.  
  **Arquivos:** `lib/debug.php`, `Middlewares/DebugMiddleware.php`, `lib/debug_examples.php`

- **Sistema de Cache (CacheerPHP)**  
  Integrado o [CacheerPHP](https://github.com/CacheerPHP/CacheerPHP) com suporte a múltiplos drivers (File, Redis, Database, Array). Foram criadas funções auxiliares intuitivas para facilitar o uso do cache: `cache_put()`, `cache_get()`, `cache_has()`, `cache_forget()`, `cache_flush()`, `cache_remember()` e `cache_pull()`.  
  **Arquivos:** `lib/cache.php`, `lib/CACHE_DRIVERS.md`, `lib/cache_examples.php`

- **Sistema de Cron Jobs**  
  Desenvolvido um sistema completo de cron jobs para agendamento de tarefas periódicas. Suporta agendamentos simples (minutos, horas, dias, semanas, meses) e expressões cron customizadas. Inclui sistema de logging automático de execuções.  
  **Arquivos:** `lib/cron.php`, `lib/CRON.md`, `lib/cron_examples.php`

- **E-mail com PHPMailer**  
  Integrado o PHPMailer para envio de e-mails via SMTP com suporte a múltiplos provedores (Gmail, Outlook, AWS SES). Sistema completo de configuração via `.env`.  
  **Arquivos:** `lib/mail.php`, `lib/EMAIL_TOKEN.md`, `lib/email_token_examples.php`

- **Autenticação com JWT**  
  Implementado sistema de tokens JWT usando Firebase/php-jwt para autenticação stateless. Suporta criação, validação e decodificação de tokens.  
  **Arquivos:** `lib/token.php`, `lib/EMAIL_TOKEN.md`, `lib/email_token_examples.php`

- **Configuração de Modo (Production/Dev)**  
  Adicionada configuração `MODE` no `.env` para controlar comportamento de erros. Em modo `Dev`, exibe erros e debug. Em modo `Production`, oculta erros do usuário e registra em log.  
  **Arquivos:** `lib/mode.php`, `lib/MODE_CONFIG.md`, `.env`, `index.php`

---

#### Melhorias a serem desenvolvidas:

- **Aprimorar o sistema de envio de e-mails.**
- **Implementar um sistema de Tokens JWT para autenticação.**
- **Implementar um sistema de migrations para o banco de dados.**
- **Criar um executável em C** para abrir um servidor PHP, rodar migrations e gerenciar crons.
  
- **Adicionar um sistema de funções globais:**
  - `Mview()` -> Função para exibir a saída de uma informação.
  - `LogView()` -> Função para armazenar em log a saída de uma informação.
  - `CutErr()` -> Função que captura erros, utilizando `try-catch`, e, dependendo do segundo parâmetro, exibe o erro na tela ou o salva no log.

- **Adicionar uma tela de exibição de erros, semelhante à do Laravel**, para melhorar a visualização e o debug de erros nas páginas.

- **Adicionar uma nova configuração no arquivo `.env`:**
  - `MODE = (Production | Dev)`  
    - **Production**: Quando ativado, desativa todos os erros do PHP.
    - **Dev**: Quando ativado, permite a visualização de erros, incluindo a exibição da tela de erros.