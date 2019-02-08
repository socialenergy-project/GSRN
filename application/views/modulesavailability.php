<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <!--
        <link rel="apple-touch-icon" sizes="76x76" href="public/assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="public/assets/img/favicon.png">
        -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


        <title>Social Energy</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="<?= base_url() ?>public/assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="<?= base_url() ?>public/assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Paper Dashboard core CSS    -->
        <link href="<?= base_url() ?>public/assets/css/paper-dashboard.css" rel="stylesheet"/>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">

        <!--  Fonts and icons     -->
        <link href="<?= base_url() ?>public/assets/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="<?= base_url() ?>public/assets/css/themify-icons.css" rel="stylesheet">

        <link rel="stylesheet" href="<?= base_url() ?>public/assets/cssj/gridstack.css"/>
        <link rel="stylesheet" href="<?= base_url() ?>public/assets/cssj/gridstack-extra.css"/>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>

        <script src="<?= base_url() ?>public/assets/jsj/gridstack.js"></script>

        <script src="<?= base_url() ?>public/assets/jsj/gridstack.jQueryUI.js"></script>


        <script type="text/javascript" src="<?= base_url() ?>public/assets/js/graph/Chart.bundle.min.js"></script>

        <script src="<?= base_url() ?>public/assets/jsj/morphext.min.js"></script>

        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>public/assets/css/materialize.min.css"  />


        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>public/assets/css/morphext.css"  />
        <style type="text/css">
            #grid1 {
                background: #DCDCDC;

            }

            #grid2 {
                background: #DCDCDC;

            }

            .grid-stack-item-content {
                color: #2c3e50;
                text-align: center;
                background-color: #778899;
            }

            #grid2 .grid-stack-item-content {
                background-color: #9caabc;
            }

            .grid-stack-item-removing {
                opacity: 0.5;
            }

            .trash {
                height: 150px;
                width:300px;
                widows:300px;
                margin-bottom: 20px;
                background: rgba(255, 0, 0, 0.1) center center url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDQzOC41MjkgNDM4LjUyOSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDM4LjUyOSA0MzguNTI5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTQxNy42ODksNzUuNjU0Yy0xLjcxMS0xLjcwOS0zLjkwMS0yLjU2OC02LjU2My0yLjU2OGgtODguMjI0TDMwMi45MTcsMjUuNDFjLTIuODU0LTcuMDQ0LTcuOTk0LTEzLjA0LTE1LjQxMy0xNy45ODkgICAgQzI4MC4wNzgsMi40NzMsMjcyLjU1NiwwLDI2NC45NDUsMGgtOTEuMzYzYy03LjYxMSwwLTE1LjEzMSwyLjQ3My0yMi41NTQsNy40MjFjLTcuNDI0LDQuOTQ5LTEyLjU2MywxMC45NDQtMTUuNDE5LDE3Ljk4OSAgICBsLTE5Ljk4NSw0Ny42NzZoLTg4LjIyYy0yLjY2NywwLTQuODUzLDAuODU5LTYuNTY3LDIuNTY4Yy0xLjcwOSwxLjcxMy0yLjU2OCwzLjkwMy0yLjU2OCw2LjU2N3YxOC4yNzQgICAgYzAsMi42NjQsMC44NTUsNC44NTQsMi41NjgsNi41NjRjMS43MTQsMS43MTIsMy45MDQsMi41NjgsNi41NjcsMi41NjhoMjcuNDA2djI3MS44YzAsMTUuODAzLDQuNDczLDI5LjI2NiwxMy40MTgsNDAuMzk4ICAgIGM4Ljk0NywxMS4xMzksMTkuNzAxLDE2LjcwMywzMi4yNjQsMTYuNzAzaDIzNy41NDJjMTIuNTY2LDAsMjMuMzE5LTUuNzU2LDMyLjI2NS0xNy4yNjhjOC45NDUtMTEuNTIsMTMuNDE1LTI1LjE3NCwxMy40MTUtNDAuOTcxICAgIFYxMDkuNjI3aDI3LjQxMWMyLjY2MiwwLDQuODUzLTAuODU2LDYuNTYzLTIuNTY4YzEuNzA4LTEuNzA5LDIuNTctMy45LDIuNTctNi41NjRWODIuMjIxICAgIEM0MjAuMjYsNzkuNTU3LDQxOS4zOTcsNzcuMzY3LDQxNy42ODksNzUuNjU0eiBNMTY5LjMwMSwzOS42NzhjMS4zMzEtMS43MTIsMi45NS0yLjc2Miw0Ljg1My0zLjE0aDkwLjUwNCAgICBjMS45MDMsMC4zODEsMy41MjUsMS40Myw0Ljg1NCwzLjE0bDEzLjcwOSwzMy40MDRIMTU1LjMxMUwxNjkuMzAxLDM5LjY3OHogTTM0Ny4xNzMsMzgwLjI5MWMwLDQuMTg2LTAuNjY0LDguMDQyLTEuOTk5LDExLjU2MSAgICBjLTEuMzM0LDMuNTE4LTIuNzE3LDYuMDg4LTQuMTQxLDcuNzA2Yy0xLjQzMSwxLjYyMi0yLjQyMywyLjQyNy0yLjk5OCwyLjQyN0gxMDAuNDkzYy0wLjU3MSwwLTEuNTY1LTAuODA1LTIuOTk2LTIuNDI3ICAgIGMtMS40MjktMS42MTgtMi44MS00LjE4OC00LjE0My03LjcwNmMtMS4zMzEtMy41MTktMS45OTctNy4zNzktMS45OTctMTEuNTYxVjEwOS42MjdoMjU1LjgxNVYzODAuMjkxeiIgZmlsbD0iI2ZmOWNhZSIvPgoJCTxwYXRoIGQ9Ik0xMzcuMDQsMzQ3LjE3MmgxOC4yNzFjMi42NjcsMCw0Ljg1OC0wLjg1NSw2LjU2Ny0yLjU2N2MxLjcwOS0xLjcxOCwyLjU2OC0zLjkwMSwyLjU2OC02LjU3VjE3My41ODEgICAgYzAtMi42NjMtMC44NTktNC44NTMtMi41NjgtNi41NjdjLTEuNzE0LTEuNzA5LTMuODk5LTIuNTY1LTYuNTY3LTIuNTY1SDEzNy4wNGMtMi42NjcsMC00Ljg1NCwwLjg1NS02LjU2NywyLjU2NSAgICBjLTEuNzExLDEuNzE0LTIuNTY4LDMuOTA0LTIuNTY4LDYuNTY3djE2NC40NTRjMCwyLjY2OSwwLjg1NCw0Ljg1MywyLjU2OCw2LjU3QzEzMi4xODYsMzQ2LjMxNiwxMzQuMzczLDM0Ny4xNzIsMTM3LjA0LDM0Ny4xNzJ6IiBmaWxsPSIjZmY5Y2FlIi8+CgkJPHBhdGggZD0iTTIxMC4xMjksMzQ3LjE3MmgxOC4yNzFjMi42NjYsMCw0Ljg1Ni0wLjg1NSw2LjU2NC0yLjU2N2MxLjcxOC0xLjcxOCwyLjU2OS0zLjkwMSwyLjU2OS02LjU3VjE3My41ODEgICAgYzAtMi42NjMtMC44NTItNC44NTMtMi41NjktNi41NjdjLTEuNzA4LTEuNzA5LTMuODk4LTIuNTY1LTYuNTY0LTIuNTY1aC0xOC4yNzFjLTIuNjY0LDAtNC44NTQsMC44NTUtNi41NjcsMi41NjUgICAgYy0xLjcxNCwxLjcxNC0yLjU2OCwzLjkwNC0yLjU2OCw2LjU2N3YxNjQuNDU0YzAsMi42NjksMC44NTQsNC44NTMsMi41NjgsNi41N0MyMDUuMjc0LDM0Ni4zMTYsMjA3LjQ2NSwzNDcuMTcyLDIxMC4xMjksMzQ3LjE3MnogICAgIiBmaWxsPSIjZmY5Y2FlIi8+CgkJPHBhdGggZD0iTTI4My4yMiwzNDcuMTcyaDE4LjI2OGMyLjY2OSwwLDQuODU5LTAuODU1LDYuNTctMi41NjdjMS43MTEtMS43MTgsMi41NjItMy45MDEsMi41NjItNi41N1YxNzMuNTgxICAgIGMwLTIuNjYzLTAuODUyLTQuODUzLTIuNTYyLTYuNTY3Yy0xLjcxMS0xLjcwOS0zLjkwMS0yLjU2NS02LjU3LTIuNTY1SDI4My4yMmMtMi42NywwLTQuODUzLDAuODU1LTYuNTcxLDIuNTY1ICAgIGMtMS43MTEsMS43MTQtMi41NjYsMy45MDQtMi41NjYsNi41Njd2MTY0LjQ1NGMwLDIuNjY5LDAuODU1LDQuODUzLDIuNTY2LDYuNTdDMjc4LjM2NywzNDYuMzE2LDI4MC41NSwzNDcuMTcyLDI4My4yMiwzNDcuMTcyeiIgZmlsbD0iI2ZmOWNhZSIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=) no-repeat;
                margin-left: 700px;
            }

            .sidebar2 {
                background: rgba(0, 255, 0, 0.1);
                height: 150px;
                width:700px;
                padding: 25px 0;
                text-align: center;
                float: left;
            }

            .sidebar2 .grid-stack-item {
                width: 200px;
                height: 100px;
                border: 2px dashed green;
                text-align: center;
                line-height: 100px;
                z-index: 10;
                background: rgba(0, 255, 0, 0.1);
                cursor: default;
                display: inline-block;
            }

            .sidebar2 .grid-stack-item .grid-stack-item-content {
                background: none;
            }


            body{

                background-color: #F7F7F7;  


            }


        </style>


    </head>
    <body>

        <!-- modal start  -->
        <?php $this->view('extra/plugin'); ?>
        <!-- modal end  --> 


        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="danger">


                <?php $this->view('sideMenu/sideMenu'); ?>
            </div>

            <div class="main-panel">

                <?php $this->view('header/headerMenu'); ?>  

                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">


                                    <div class="header">
                                        <h4 class="title"></h4>
                                    </div>
                                    <div class="content">

                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-8">
                                                   
                                                        <div class="header">
                                                            <h4 class="title">GSRN Enable Componets</h4>
                                                        </div>
                                                        <div class="content">
                                                            <?php
                                                            echo form_open('modulesAvailability/savequest');
                                                            ?>

                                                            <!-- Start Here new Questionaire   -->


                                                            <!-- End Here  Questionaire   -->
                                                         

                                                           <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
																		
                                                                        <label>1) Enable ANALYTICS component</label>
                                                                        <?php
                                                                        $checked = "";
                                                                        if (isset($Analytics))
                                                                        {
                                                                            if ($Analytics == "Enable")
                                                                            {
                                                                                $checked = "checked='checked'";
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <div class="switch">
                                                                            <label>
                                                                                Disable 
                                                                                <input type="checkbox" name="analyrics1" id="analyrics1" <?= $checked ?> >
                                                                                <span class="lever"></span>
                                                                                Enable
                                                                            </label>
                                                                            <?= form_error('analyrics1'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                          

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>1) Enable LCMS component</label>
                                                                        <?php
                                                                        $checked = "";
                                                                        if (isset($LcmsCom))
                                                                        {
                                                                            if ($LcmsCom == "Enable")
                                                                            {
                                                                                $checked = "checked='checked'";
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <div class="switch">
                                                                            <label>
                                                                                Disable 
                                                                                <input type="checkbox" name="lcmscom1" id="lcmscom1" <?= $checked ?> >
                                                                                <span class="lever"></span>
                                                                                Enable
                                                                            </label>
                                                                            <?= form_error('lcmscom1'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


          
                                                           
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>1) Enable GAME component</label>
                                                                        <?php
                                                                        $checked = "";
                                                                        if (isset($GameCom))
                                                                        {
                                                                            if ($GameCom == "Enable")
                                                                            {
                                                                                $checked = "checked='checked'";
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <div class="switch">
                                                                            <label>
                                                                                Disable 
                                                                                <input type="checkbox" name="gamecom1" id="gamecom1" <?= $checked ?> >
                                                                                <span class="lever"></span>
                                                                                Enable
                                                                            </label>
                                                                            <?= form_error('gamecom1'); ?>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>



                                                         <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>1) Enable ENERGY PROFILE component</label>
                                                                        <?php
																		
                                                                        $checked = "";
                                                                        if (isset($EnergyCom))
                                                                        {
                                                                            if ($EnergyCom == "Enable")
                                                                            {
                                                                                $checked = "checked='checked'";
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <div class="switch">
                                                                            <label>
                                                                                Disable 
                                                                                <input type="checkbox" name="eneProcom1" id="eneProcom1" <?= $checked ?> >
                                                                                <span class="lever"></span>
                                                                                Enable
                                                                            </label>
                                                                            <?= form_error('eneProcom1'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>1) Enable MARKET PLACE component</label>
                                                                        <?php
                                                                        $checked = "";
                                                                        if (isset($MarketPlaCom))
                                                                        {
                                                                            if ($MarketPlaCom == "Enable")
                                                                            {
                                                                                $checked = "checked='checked'";
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <div class="switch">
                                                                            <label>
                                                                                Disable 
                                                                                <input type="checkbox" name="marketPlacecom1" id="marketPlacecom1" <?= $checked ?> >
                                                                                <span class="lever"></span>
                                                                                Enable
                                                                            </label>
                                                                            <?= form_error('eneProcom1'); ?>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>





                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                                                            <div class="clearfix"></div>
                                                            </form>
                                                        </div>
                                                   
                                                </div>
                                            </div>




                                        </div>

                                        <footer class="footer">

                                            <?php $this->view('footer/footer'); ?>  

                                        </footer>


                                    </div>
                                </div>


                                </body>

    <!--   Core JS Files  <script src="public/assets/js/jquery-1.10.2.js" type="text/javascript"></script> -->

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>



                                <script type="text/javascript" src="<?= base_url() ?>public/assets/daterangepicker/moment.min.js"></script>

                                <script type="text/javascript" src="<?= base_url() ?>public/assets/daterangepicker/daterangepicker.js"></script>

                                <link type="text/css" rel="stylesheet" href="<?= base_url() ?>public/assets/daterangepicker/daterangepicker.css"  />


                                <script type="text/javascript">

                                    $("#js-rotating").Morphext({
                                        // The [in] animation type. Refer to Animate.css for a list of available animations.
                                        animation: "fadeIn", //"bounceIn",rotateIn
                                        // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
                                        separator: ",",
                                        // The delay between the changing of each phrase in milliseconds.
                                        speed: 7000,
                                        complete: function () {
                                            // Called after the entrance animation is executed.
                                        }
                                    });

                                    $(document).ready(function () {
                                        $('select').material_select();

                                        $('#hiedulevwithhome').val($('#hiedulevwithhome1').val());
                                        $('#ifhecfhov').val($('#ifhecfhov1').val());
                                        $('#energyclassacu_2').val($('#energyclassacu_21').val());
                                        $('#ifhowmanclasainh_1').val($('#ifhowmanclasainh1').val());
                                        $('#ifdoyletloiunr_1').val($('#ifdoyletloiunr').val());
                                        $('#iftmekwmrw_1').val($('#iftmekwmrw').val());
                                        $('#ifwitdeokwkhh_1').val($('#ifwitdeokwkhh').val());
                                        $('#ifwhisthappthconthemaen_1').val($('#ifwhisthappthconthemaen').val());
                                        $('#ifwhisapro_1').val($('#ifwhisapro').val());
                                        $('#ifiddoyknwhap1_1').val($('#ifiddoyknwhap1').val());
                                        $('#ifaypybemolf2_1').val($('#ifaypybemolf2').val());


                                        $('#ifaypybemolf2').on('change', function () {
                                            $('#ifaypybemolf2_1').val($('#ifaypybemolf2').val());
                                        });


                                        $('#ifiddoyknwhap1').on('change', function () {
                                            $('#ifiddoyknwhap1_1').val($('#ifiddoyknwhap1').val());
                                        });


                                        $('#ifwhisapro').on('change', function () {
                                            $('#ifwhisapro_1').val($('#ifwhisapro').val());
                                        });

                                        $('#hiedulevwithhome1').on('change', function () {
                                            $('#hiedulevwithhome').val($('#hiedulevwithhome1').val());
                                        });

                                        $('#ifhecfhov1').on('change', function () {
                                            $('#ifhecfhov').val($('#ifhecfhov1').val());
                                        });


                                        $('#energyclassacu_21').on('change', function () {
                                            $('#energyclassacu_2').val($('#energyclassacu_21').val());
                                        });


                                        $('#ifhowmanclasainh1').on('change', function () {
                                            $('#ifhowmanclasainh_1').val($('#ifhowmanclasainh1').val());
                                        });

                                        $('#ifdoyletloiunr').on('change', function () {
                                            $('#ifdoyletloiunr_1').val($('#ifdoyletloiunr').val());
                                        });

                                        $('#iftmekwmrw').on('change', function () {
                                            $('#iftmekwmrw_1').val($('#iftmekwmrw').val());
                                        });


                                        $('#ifwitdeokwkhh').on('change', function () {
                                            $('#ifwitdeokwkhh_1').val($('#ifwitdeokwkhh').val());
                                        });


                                        $('#ifwhisthappthconthemaen').on('change', function () {
                                            $('#ifwhisthappthconthemaen_1').val($('#ifwhisthappthconthemaen').val());
                                        });



                                        $.ajax({
                                            type: "POST",
                                            url: "<? echo site_url('UserPosition/sposition'); ?>",
                                            dataType: 'json',
                                            cache: false,
                                            data: {
                                                type_of_action: "click",
                                                action: "Questionnaire",
                                                'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
                                            },
                                            beforeSend: function () {
                                                $(".overlay2").show();


                                            },
                                            complete: function () {
                                                // $("#spiaj").css("display", "none");
                                                $(".overlay2").hide();
                                            },
                                            success: function (msg) {



                                            },
                                            error: function (jqXHR, textStatus, errorThrown)
                                            {


                                            }
                                        });



<?php
if (isset($failedQuestIntoSystem))
{


    echo "Materialize.toast('An error occurred please try again later', 5000, 'red rounded');";
}
?>

                                    });


                                </script>

                                </html>
