<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC Model • Framework PHP Profissional</title>
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="/css/help.css">
</head>

<body>


    <header>
        <div class="navbar">
            <a href="/" class="logo logo-only">
                <img src="/img/FaviconWhite.png" alt="MVC Model">
            </a>


            <div class="navbar-btn-group">
                <a href="/help" class="back-btn">
                    <i data-lucide="book-open"></i>
                    Documentação
                </a>

                <a href="/test" class="back-btn">
                    <i data-lucide="flask-conical"></i>
                    Testes
                </a>
            </div>
        </div>
    </header>

    <main>

        <!-- HERO -->
        <section class="container">
            <div class="help-header">
                <div class="hero-logo-wrapper">
                    <img src="/img/logo.png" alt="MVC Model" class="hero-logo">
                </div>

                <p>
                    Framework PHP profissional inspirado no Laravel,
                    criado para produtividade, organização e performance real.
                </p>
            </div>

            <div class="help-cards">
                <a href="/help" class="help-card">
                    <div class="icon-badge"><i data-lucide="book-open"></i></div>
                    <div class="card-title">Documentação</div>
                    <div class="card-desc">Guias oficiais e exemplos práticos</div>
                    <div class="card-link">Acessar <i data-lucide="arrow-right"></i></div>
                </a>

                <a href="/help/documentation" class="help-card">
                    <div class="icon-badge"><i data-lucide="layers"></i></div>
                    <div class="card-title">Guia Completo</div>
                    <div class="card-desc">Debug, Cache, Cron, Email, JWT e muito mais</div>
                    <div class="card-link">Explorar <i data-lucide="arrow-right"></i></div>
                </a>

                <a href="https://github.com/maquitogw" target="_blank" class="help-card">
                    <div class="icon-badge"><i data-lucide="github"></i></div>
                    <div class="card-title">Open Source</div>
                    <div class="card-desc">Código aberto, versionado e confiável</div>
                    <div class="card-link">GitHub <i data-lucide="arrow-up-right"></i></div>
                </a>
            </div>
        </section>

        <!-- FEATURES -->
        <div class="container">

            <div class="help-cards">

                <div class="features-section">
                    <h2>Recursos Implementados</h2>

                    <div class="features-grid">
                        <a href="/help/documentation#debug" class="feature-item" style="text-decoration: none; color: inherit;">
                            <i data-lucide="palette"></i>
                            <div class="feature-name">Debug Avançado</div>
                        </a>
                        <a href="/help/documentation#cache" class="feature-item" style="text-decoration: none; color: inherit;">
                            <i data-lucide="database"></i>
                            <div class="feature-name">Cache Multi-Driver</div>
                        </a>
                        <a href="/help/documentation#cron" class="feature-item" style="text-decoration: none; color: inherit;">
                            <i data-lucide="clock-3"></i>
                            <div class="feature-name">Agendador Cron</div>
                        </a>
                        <a href="/help/documentation#email" class="feature-item" style="text-decoration: none; color: inherit;">
                            <i data-lucide="mail-check"></i>
                            <div class="feature-name">Email SMTP</div>
                        </a>
                        <a href="/help/documentation#email" class="feature-item" style="text-decoration: none; color: inherit;">
                            <i data-lucide="shield-check"></i>
                            <div class="feature-name">JWT Auth</div>
                        </a>
                        <a href="/help/documentation#mode" class="feature-item" style="text-decoration: none; color: inherit;">
                            <i data-lucide="toggle-left"></i>
                            <div class="feature-name">Dev / Production</div>
                        </a>
                    </div>
                </div>

            </div>

            <!-- QUICK START -->
            <section class="container">
                <div class="help-header">
                    <h1>Comece em Minutos</h1>
                    <p>Sem gambiarra, sem mágica escondida</p>
                </div>

                <div class="help-cards">
                    <div class="help-card">
                        <div class="icon-badge"><i data-lucide="download"></i></div>
                        <div class="card-title">Instalação</div>
                        <div class="card-desc"><code>composer install</code></div>
                    </div>

                    <div class="help-card">
                        <div class="icon-badge"><i data-lucide="settings"></i></div>
                        <div class="card-title">Configuração</div>
                        <div class="card-desc">Configure o arquivo <code>.env</code></div>
                    </div>

                    <div class="help-card">
                        <div class="icon-badge"><i data-lucide="terminal"></i></div>
                        <div class="card-title">Executar</div>
                        <div class="card-desc"><code>php -S localhost:8000</code></div>
                    </div>
                </div>
            </section>

            <!-- COMPLETE FEATURES -->
            <section class="container">
                <div class="help-header">
                    <h1>Principais Funcionalidades</h1>
                    <p>Tudo que você precisa para construir aplicações modernas</p>
                </div>

                <div class="help-cards">
                    <a href="/help/documentation#routes" class="help-card">
                        <div class="icon-badge"><i data-lucide="share-2"></i></div>
                        <div class="card-title">Sistema de Rotas</div>
                        <div class="card-desc">GET, POST, grupos e nomeação</div>
                        <div class="card-link">Aprender <i data-lucide="arrow-right"></i></div>
                    </a>

                    <a href="/help/documentation#controllers" class="help-card">
                        <div class="icon-badge"><i data-lucide="code"></i></div>
                        <div class="card-title">Controladores</div>
                        <div class="card-desc">Classes App, Request, Response</div>
                        <div class="card-link">Usar <i data-lucide="arrow-right"></i></div>
                    </a>

                    <a href="/help/documentation#database" class="help-card">
                        <div class="icon-badge"><i data-lucide="database"></i></div>
                        <div class="card-title">Banco de Dados</div>
                        <div class="card-desc">INSERT, SELECT, UPDATE, DELETE</div>
                        <div class="card-link">Consultar <i data-lucide="arrow-right"></i></div>
                    </a>

                    <a href="/help/documentation#views" class="help-card">
                        <div class="icon-badge"><i data-lucide="layout"></i></div>
                        <div class="card-title">Views</div>
                        <div class="card-desc">Templates e renderização de HTML</div>
                        <div class="card-link">Exibir <i data-lucide="arrow-right"></i></div>
                    </a>

                    <a href="/help/documentation#files" class="help-card">
                        <div class="icon-badge"><i data-lucide="folder-open"></i></div>
                        <div class="card-title">Arquivos</div>
                        <div class="card-desc">Gerenciamento seguro de storage</div>
                        <div class="card-link">Gerenciar <i data-lucide="arrow-right"></i></div>
                    </a>

                    <a href="/help/documentation#middleware" class="help-card">
                        <div class="icon-badge"><i data-lucide="filter"></i></div>
                        <div class="card-title">Middlewares</div>
                        <div class="card-desc">Debug, Security, Session, Logs</div>
                        <div class="card-link">Processar <i data-lucide="arrow-right"></i></div>
                    </a>
                </div>
            </section>

    </main>

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