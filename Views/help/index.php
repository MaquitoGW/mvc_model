<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Ajuda • MVC Model</title>

    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="/css/help.css">
</head>

<body>

    <header>
        <div class="navbar">
            <a href="/" class="logo logo-only">
                <img src="/img/FaviconWhite.png" alt="MVC Model">
            </a>


            <a href="/" class="back-btn">
                <i data-lucide="arrow-left"></i>
                Voltar
            </a>
        </div>
    </header>

    <div class="container">

        <div class="help-header">
            <h1>Centro de Ajuda</h1>
            <p>Documentação oficial e guias práticos para todos os sistemas do MVC Model</p>
        </div>

        <div class="version-info">
            Versão <strong>1.0</strong> • Atualizado em Janeiro de 2026
        </div>

        <div class="help-cards">

            <a class="help-card" href="/help/documentation">
                <div class="icon-badge"><i data-lucide="book-open"></i></div>
                <div class="card-title">Documentação Completa</div>
                <div class="card-desc">Visão geral de todos os sistemas e recursos do framework</div>
                <div class="card-link">Acessar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#debug">
                <div class="icon-badge"><i data-lucide="palette"></i></div>
                <div class="card-title">Sistema de Debug</div>
                <div class="card-desc">dd(), dump(), logView(), cutErr() com estilo</div>
                <div class="card-link">Aprender <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#cache">
                <div class="icon-badge"><i data-lucide="zap"></i></div>
                <div class="card-title">Cache</div>
                <div class="card-desc">Multi-driver: File, Redis, Database, Array</div>
                <div class="card-link">Explorar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#cron">
                <div class="icon-badge"><i data-lucide="clock-3"></i></div>
                <div class="card-title">Cron Jobs</div>
                <div class="card-desc">Agendamentos prontos e expressões customizadas</div>
                <div class="card-link">Descobrir <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#email">
                <div class="icon-badge"><i data-lucide="mail"></i></div>
                <div class="card-title">Email & JWT Auth</div>
                <div class="card-desc">SMTP, PHPMailer, Tokens seguros</div>
                <div class="card-link">Configurar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#routes">
                <div class="icon-badge"><i data-lucide="share-2"></i></div>
                <div class="card-title">Sistema de Rotas</div>
                <div class="card-desc">GET, POST, grupos e nomeação de rotas</div>
                <div class="card-link">Criar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#controllers">
                <div class="icon-badge"><i data-lucide="code"></i></div>
                <div class="card-title">Controladores</div>
                <div class="card-desc">Classes App, Request, Response</div>
                <div class="card-link">Usar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#database">
                <div class="icon-badge"><i data-lucide="database"></i></div>
                <div class="card-title">Banco de Dados</div>
                <div class="card-desc">INSERT, SELECT, UPDATE, DELETE</div>
                <div class="card-link">Consultar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#files">
                <div class="icon-badge"><i data-lucide="folder-open"></i></div>
                <div class="card-title">Manipulação de Arquivos</div>
                <div class="card-desc">Classe File para gerenciar storage</div>
                <div class="card-link">Gerenciar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#views">
                <div class="icon-badge"><i data-lucide="layout"></i></div>
                <div class="card-title">Sistema de Views</div>
                <div class="card-desc">Views, templates e estrutura de pastas</div>
                <div class="card-link">Exibir <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#middleware">
                <div class="icon-badge"><i data-lucide="filter"></i></div>
                <div class="card-title">Middlewares</div>
                <div class="card-desc">Debug, Security, Session, Logs</div>
                <div class="card-link">Processar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#config">
                <div class="icon-badge"><i data-lucide="settings"></i></div>
                <div class="card-title">Configuração</div>
                <div class="card-desc">Ambiente, .env e estrutura do projeto</div>
                <div class="card-link">Configurar <i data-lucide="arrow-right"></i></div>
            </a>

            <a class="help-card" href="/help/documentation#agradecimentos">
                <div class="icon-badge"><i data-lucide="heart"></i></div>
                <div class="card-title">Agradecimentos Especiais</div>
                <div class="card-desc">CacheerPHP, PHPMailer, Firebase JWT e mais</div>
                <div class="card-link">Ver <i data-lucide="arrow-right"></i></div>
            </a>

        </div>

    </div>

    <footer class="footer">
        <div class="footer-container">

            <!-- Brand -->
            <div class="footer-brand">
                <img src="/img/logo.png" alt="MVC Model">
                <p>
                    Framework PHP moderno inspirado no Laravel,
                    focado em produtividade, organização e performance.
                </p>
            </div>

            <!-- Links -->
            <div class="footer-links">

                <div class="footer-column">
                    <h4>Navegação</h4>
                    <a href="/">Home</a>
                    <a href="/help">Centro de Ajuda</a>
                    <a href="/help/documentation">Documentação</a>
                    <a href="/test">Testes</a>
                </div>

                <div class="footer-column">
                    <h4>Principais Seções</h4>
                    <a href="/help/documentation#debug">Debug</a>
                    <a href="/help/documentation#cache">Cache</a>
                    <a href="/help/documentation#cron">Cron Jobs</a>
                    <a href="/help/documentation#email">Email & JWT</a>
                </div>

                <div class="footer-column">
                    <h4>Comunidade</h4>
                    <a href="https://github.com/maquitogw/mvc_model" target="_blank">
                        <i data-lucide="github"></i> GitHub
                    </a>
                    <a href="https://www.linkedin.com/in/maquitogw/" target="_blank">
                        <i data-lucide="linkedin"></i> LinkedIn
                    </a>
                    <a href="mailto:maicongoncalves826@gmail.com" target="_blank">
                        <i data-lucide="mail"></i> Email
                    </a>
                </div>

            </div>
        </div>

        <!-- Bottom -->
        <div class="footer-bottom">
            <span>© <?= date('Y') ?> MVC Model</span>
            <span>Licença MIT</span>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

</body>

</html>