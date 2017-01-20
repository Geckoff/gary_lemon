<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php bloginfo('name'); wp_title(); ?></title>
        <link rel="icon" href="<?php bloginfo('template_url') ?>/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/favicon.ico" type="image/x-icon" />
        <?php wp_head(); ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section id="header">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 col-md-10">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="<?php echo get_home_url(); ?>">GARY LEMON</a>
                                <button type="button" data-toggle="modal" data-target="#myModal" class="order btn btn-default navbar-btn">Send a Request</button>
                            </div>



                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <?php wp_nav_menu(array(
                                    'theme_location' => 'header_menu',
                                    'container' => '',
                                    'menu_class' => 'nav navbar-nav',
                                )); ?>
                            </div><!-- /.navbar-collapse -->

                        </div>

                        <div class="col-md-2 col-sm-2  hidden-xs">
                            <button type="button" data-toggle="modal" data-target="#myModal" class="order btn btn-default navbar-btn">Send a Request</button>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </nav>
            <div class="main-header-lemon">
                <div class="header-name">
                    <h1>Gary Lemon</h1>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5 name-underline"></div>
                    </div>
                </div>
                <div class="container">
                    <button type="button" data-toggle="modal" data-target="#myModal" class="name-sour order btn btn-default navbar-btn">Your party will not be sour</button>
                </div>
            </div>
        </section>

        <section id="modal-window">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="garik">
                        </div>
                        <div class="modal-body">



                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span class="fa-stack">
                                  <i class="fa fa-circle-thin fa-stack-2x"></i>
                                  <i class="fa fa-times fa-stack-1x"></i>
                              </span>
                          </button>

                            <form id="myForm" role="form" data-toggle="validator" class="garik-form">
                                <h2>Send a Request</h2>
                                <div class="form-group">
                                    <p>Your Name</p>
                                    <input type="text" name="name" class="form-control"  placeholder="Name"  required />
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group">
                                    <p>Your Phone Number</p>
                                    <input type="tel" name="phone" class="form-control" placeholder="970 111 1111"  required />
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group">
                                    <p>Your Comment</p>
                                    <textarea class="form-control" id="comment" rows="3" placeholder="Comment"></textarea>
                                </div>
                                <button type="submit" class="order btn btn-default">Send Request</button>

                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </section>