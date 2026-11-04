<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#FCFBF8">
    <meta name="description"
        content="SHITA, un espacio para expresar tus emociones, conversar y conocer mejor cómo te sientes.">

    <title>SHITA | Tu espacio emocional</title>

    <link rel="icon" type="image/png" href="<?= URL ?>public/img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?= URL ?>public/css/home.css">
</head>

<body class="landing-page">

    <header class="landing-header">
        <nav class="landing-nav" aria-label="Navegación principal">

            <a href="<?= URL ?>" class="brand" aria-label="SHITA, inicio">
                <span class="brand-icon">✦</span>
                <span>SHITA<span class="brand-dot">.</span></span>
            </a>

            <div class="nav-links">
                <a href="#inicio">Inicio</a>
                <a href="#funciones">Funciones</a>
                <a href="#como-funciona">Cómo funciona</a>
            </div>

            <div class="nav-actions">
                <a href="<?= URL ?>?url=login" class="nav-login">Iniciar sesión</a>
                <a href="<?= URL ?>?url=registro" class="btn btn-small">Crear cuenta <span>↗</span></a>
            </div>

            <a href="<?= URL ?>?url=login" class="mobile-login">Entrar ↗</a>

        </nav>
    </header>

    <main>

        <section class="hero section-wrap" id="inicio">

            <div class="hero-copy">

                <div class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    UN ESPACIO PARA TI
                </div>

                <h1>
                    Escucha lo que
                    <span>sientes.</span>
                    <br>
                    Cuida de ti.
                </h1>

                <p class="hero-description">
                    A veces solo necesitamos un lugar donde expresarnos.
                    SHITA te acompaña a poner en palabras tus emociones,
                    reflexionar sobre tu día y conocerte un poquito más.
                </p>

                <div class="hero-actions">
                    <a href="<?= URL ?>?url=registro" class="btn btn-primary">
                        Comenzar mi camino <span>↗</span>
                    </a>

                    <a href="#funciones" class="btn btn-secondary">
                        Conocer SHITA <span>↓</span>
                    </a>
                </div>

                <div class="hero-note">
                    <span class="note-icon">♡</span>
                    <span>Un momento para ti, a tu propio ritmo.</span>
                </div>

            </div>

            <div class="hero-art" aria-label="Ilustración de un espacio tranquilo">

                <div class="art-orbit orbit-one"></div>
                <div class="art-orbit orbit-two"></div>

                <div class="floating-card floating-card-top">
                    <span class="floating-icon">☀</span>
                    <div>
                        <strong>Respira.</strong>
                        <small>No tienes que resolverlo todo hoy.</small>
                    </div>
                </div>

                <div class="hero-illustration">
                    <div class="illustration-glow"></div>

                    <div class="robot-head">
                        <div class="robot-antenna"></div>
                        <div class="robot-ear ear-left"></div>
                        <div class="robot-ear ear-right"></div>

                        <div class="robot-face">
                            <div class="robot-eyes">
                                <span></span>
                                <span></span>
                            </div>
                            <div class="robot-cheeks">
                                <span></span>
                                <span></span>
                            </div>
                            <div class="robot-smile"></div>
                        </div>

                        <div class="robot-neck"></div>
                    </div>

                    <div class="robot-body">
                        <div class="robot-heart">♡</div>
                    </div>

                    <div class="robot-shadow"></div>
                </div>

                <div class="floating-card floating-card-bottom">
                    <span class="mood-emoji">😌</span>
                    <div>
                        <strong>¿Cómo te sientes?</strong>
                        <small>Todo lo que sientes merece espacio.</small>
                    </div>
                </div>

                <span class="decor decor-star">✦</span>
                <span class="decor decor-sparkle">✧</span>
                <span class="decor decor-heart">♡</span>

            </div>

        </section>

        <section class="intro-strip">
            <div class="section-wrap intro-inner">
                <span class="intro-symbol">✳</span>
                <p>
                    No se trata de estar bien todo el tiempo.
                    <strong>Se trata de darte espacio para sentir.</strong>
                </p>
            </div>
        </section>

        <section class="features section-wrap" id="funciones">

            <div class="section-heading">
                <span class="section-kicker">TU BIENESTAR, A TU MANERA</span>
                <h2>Un espacio que te ayuda<br> a <span>conocerte mejor.</span></h2>
                <p>
                    Pequeñas herramientas para hacer una pausa,
                    expresarte y prestar atención a cómo te sientes.
                </p>
            </div>

            <div class="feature-grid">

                <article class="feature-card feature-chat">
                    <div class="feature-top">
                        <div class="feature-icon icon-lavender">✧</div>
                        <span class="feature-number">01</span>
                    </div>

                    <h3>Habla sin presión</h3>

                    <p>
                        Conversa con SHITA, comparte cómo estuvo tu día
                        y organiza tus pensamientos en un espacio de escucha.
                    </p>

                    <div class="feature-decoration chat-decoration">
                        <span>Hoy fue un día largo...</span>
                        <span class="chat-bubble">Puedes contarme. 💜</span>
                    </div>
                </article>

                <article class="feature-card feature-emotions">
                    <div class="feature-top">
                        <div class="feature-icon icon-mint">♡</div>
                        <span class="feature-number">02</span>
                    </div>

                    <h3>Reconoce tus emociones</h3>

                    <p>
                        Registra cómo te sientes y date un momento
                        para identificar qué está pasando contigo.
                    </p>

                    <div class="emotion-decoration">
                        <span>😊</span>
                        <span>😌</span>
                        <span>😰</span>
                        <span>😴</span>
                    </div>
                </article>

                <article class="feature-card feature-progress">
                    <div class="feature-top">
                        <div class="feature-icon icon-peach">↗</div>
                        <span class="feature-number">03</span>
                    </div>

                    <h3>Observa tu proceso</h3>

                    <p>
                        Consulta tus registros emocionales y observa
                        cómo van cambiando tus experiencias con el tiempo.
                    </p>

                    <div class="progress-decoration">
                        <div style="height: 35%"></div>
                        <div style="height: 60%"></div>
                        <div style="height: 45%"></div>
                        <div style="height: 82%"></div>
                        <div style="height: 68%"></div>
                        <div style="height: 100%"></div>
                    </div>
                </article>

            </div>

        </section>

        <section class="how-section" id="como-funciona">

            <div class="section-wrap how-inner">

                <div class="how-copy">
                    <span class="section-kicker">SIN COMPLICACIONES</span>
                    <h2>Empieza por algo<br><span>pequeño.</span></h2>

                    <p>
                        No necesitas tener todas las respuestas.
                        Solo necesitas un momento para ti.
                    </p>

                    <a href="<?= URL ?>?url=registro" class="btn btn-primary">
                        Quiero comenzar <span>↗</span>
                    </a>
                </div>

                <div class="steps">

                    <article class="step">
                        <span class="step-number">01</span>
                        <div>
                            <h3>Crea tu espacio</h3>
                            <p>Regístrate para acceder a tus conversaciones y registros.</p>
                        </div>
                    </article>

                    <article class="step">
                        <span class="step-number">02</span>
                        <div>
                            <h3>Exprésate con libertad</h3>
                            <p>Conversa o registra cómo te sientes en ese momento.</p>
                        </div>
                    </article>

                    <article class="step">
                        <span class="step-number">03</span>
                        <div>
                            <h3>Conoce tu proceso</h3>
                            <p>Vuelve a tus registros y observa lo que has compartido.</p>
                        </div>
                    </article>

                </div>

            </div>

        </section>

        <section class="final-cta section-wrap">

            <div class="cta-card">
                <div class="cta-decoration">✦</div>

                <span class="section-kicker">TU ESPACIO TE ESPERA</span>

                <h2>Hoy también puedes<br>dedicarte un momento.</h2>

                <p>
                    Empieza a escucharte. Un paso pequeño también cuenta.
                </p>

                <a href="<?= URL ?>?url=registro" class="btn btn-cta">
                    Crear mi cuenta <span>↗</span>
                </a>

                <div class="cta-orb orb-left"></div>
                <div class="cta-orb orb-right"></div>
            </div>

        </section>

    </main>

    <footer class="landing-footer">
        <div class="section-wrap footer-inner">

            <a href="<?= URL ?>" class="brand footer-brand">
                <span class="brand-icon">✦</span>
                <span>SHITA<span class="brand-dot">.</span></span>
            </a>

            <p>Un espacio para escucharte, comprenderte y crecer.</p>

            <a href="<?= URL ?>?url=login" class="footer-login">
                Ya tengo una cuenta ↗
            </a>

        </div>

        <div class="footer-bottom">
            <p>SHITA · Tu bienestar importa.</p>
        </div>

        <div class="footer-instagram">
            <h3>También puedes encontrarnos por aquí ✨</h3>
            <p>Conoce nuestros proyectos y síguenos en Instagram.</p>

            
            <div class="instagram-links">
                <a href="https://www.instagram.com/w.estefa.w/" target="_blank" rel="noopener noreferrer">
                    <span>◎</span> @w.estefa.w
                </a>

                <a href="https://www.instagram.com/9mm.parabellum_/" target="_blank" rel="noopener noreferrer">
                    <span>◎</span> @9mm.parabellum_
                </a>

                <a href="https://www.instagram.com/ab_dallah6938/" target="_blank" rel="noopener noreferrer">
                    <span>◎</span> @ab_dallah6938
                </a>
            </div>
           
        </div>
     

    </footer>

</body>

</html>