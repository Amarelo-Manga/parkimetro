<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php wp_head(); ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/fonts/fonts.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

        <link rel='stylesheet' media='(min-width: 320px) and (max-width: 480px)' href='<?php echo get_template_directory_uri()?>/assets/css/mobile.css' />
        <link rel='stylesheet' media='(min-width: 481px) and (max-width: 768px)' href='<?php echo get_template_directory_uri()?>/assets/css/tablet.css' />
        <!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=UA-38298279-1"></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());

			  gtag('config', 'UA-38298279-1');
			</script>

    </head>
    <body <?php body_class(); ?>>
        <!--Menu-->
        <header class="container-fluid sobrepor fixar-botao cor-fundo-mobile slider">
            <div class="container">
                <div class="row amarelo ml-auto mr-3 d-flex justify-content-end w-50 pt-2 flex-nowrap">
                    <a href="http://etraining.com.br/etraining-express" target="_blank" class="btn btn-outline-warning arredondar mr-4 col-lg-4 col-md-5 col-sm-6 sobrepor"><i class="fa fa-user" aria-hidden="true"></i>Acesso Restrito</a>
                    <a href="<?php the_permalink(149)?>" class="btn fundo-amarelo arredondar espacamento-botao col-lg-4 col-md-5 col-sm-6 sobrepor"><i class="fa fa-phone" aria-hidden="true"></i>Fale Conosco</a>
                </div>
                <div class="row">
                    <nav id="main_menu" class="navbar navbar-expand-lg navbar-light sobrepor espacamento-mobile">
                        <a class="navbar-brand col-lg-4 logo" href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri()?>/assets/images/logo.png" alt="Logo Parkímetro"></a>
                        <div id="menu" class="col-lg-8">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <?php 
                                    $args = array( 
                                            'theme_location' => 'top', 
                                            'menu_class'=> 'col-lg-12 navbar-nav',   
                                            'menu_id'=> 'top-menu'
                                        );
                                    wp_nav_menu( $args ); 
                                ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </header>