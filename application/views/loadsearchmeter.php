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


        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

        <link href="<?= base_url() ?>public/assets/css/sideBar.css" rel="stylesheet"/>

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
            <?php
            $this->view('extra/chat');
            ?>   
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
                                        <h4 class="title">Energy Profile</h4>
                                    </div>
                                    <div class="content">

                                        <div class="container-fluid">
                                            <h1>MY ENERGY PROFILE!</h1>

                                            <div class="row" id="rowID" style="display:block">
                                                <input type="text" id="daterangeID" name="daterange" value="<? echo date('m/d/Y') . " - " . date('m/d/Y', strtotime('+1 day', strtotime(date('m/d/Y')))); ?>" class="gdrmsSelec" />

                                                       <div class="input-field col s12 gdrmsSelec">
                                                    <select  name="selectMeter" id="selectMeter">
                                                        <option value="0" disabled selected>Select Meter</option>
                                                        <option value="772926606454">User 1</option>
                                                        <option value="228945150440522">User 2</option>
                                                        <option value="132650148173539">User 3</option>
                                                        <option value="132650144839343">User 4</option>
                                                    </select>
                                                    <label>Select Meter</label>
                                                </div>
                                                <a class="waves-effect waves-light btn-large" id="search_box2">Search serch</a> 
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6" >
                                                    <div class="grid-stack grid-stack-6" id="grid1" >
                                                        <canvas id='myChart' width='550' height='300'></canvas> 
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="grid-stack grid-stack-6" id="grid2">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6" >
                                                    <div class="grid-stack grid-stack-6" id="grid1" >
                                                        <canvas id='myChart2' width='550' height='300'></canvas> 
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="grid-stack grid-stack-6" id="grid2">
                                                    </div>
                                                </div>

                                            </div>

                                            <hr/>

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

                            <link type="text/css" rel="stylesheet" media="all" href="<?= base_url() ?>public/assets/css/chat.css" />
                            <link type="text/css" rel="stylesheet" media="all" href="<?= base_url() ?>public/assets/css/screen.css" />
                            <script type="text/javascript" src="<?= base_url() ?>public/assets/jsj/chat.js"></script>

                            <script type="text/javascript">
                                var startDate;
                                var endDate;
                                var items;
                                var barGraph;


                                var ctx2 = document.getElementById("myChart2");

                                var ctx = document.getElementById("myChart");

                                Chart.defaults.global.defaultFontColor = 'red';

                                var color = Chart.helpers.color;



                                var barChartDataX = {
                                    labels: [
                                        "00:14:00",
                                        "00:29:00",
                                        "00:44:00",
                                        "00:59:00",
                                        "01:14:00",
                                        "01:29:00",
                                        "01:44:00",
                                        "01:59:00",
                                        "02:14:00",
                                        "02:29:00",
                                        "02:44:00",
                                        "02:59:00",
                                        "03:14:00",
                                        "03:29:00",
                                        "03:44:00",
                                        "03:59:00",
                                        "04:14:00",
                                        "04:29:00",
                                        "04:44:00",
                                        "04:59:00",
                                        "05:14:00",
                                        "05:29:00",
                                        "05:44:00",
                                        "05:59:00",
                                        "06:14:00",
                                        "06:29:00",
                                        "06:44:00",
                                        "06:59:00",
                                        "07:14:00",
                                        "07:29:00",
                                        "07:44:00",
                                        "07:59:00",
                                        "08:14:00",
                                        "08:29:00",
                                        "08:44:00",
                                        "08:59:00",
                                        "09:14:00",
                                        "09:29:00",
                                        "09:44:00",
                                        "09:59:00",
                                        "10:14:00",
                                        "10:29:00",
                                        "10:44:00",
                                        "10:59:00",
                                        "11:14:00",
                                        "11:29:00",
                                        "11:44:00",
                                        "11:59:00",
                                        "12:14:00",
                                        "12:29:00",
                                        "12:44:00",
                                        "12:59:00",
                                        "13:14:00",
                                        "13:29:00",
                                        "13:44:00",
                                        "13:59:00",
                                        "14:14:00",
                                        "14:29:00",
                                        "14:44:00",
                                        "14:59:00",
                                        "15:14:00",
                                        "15:29:00",
                                        "15:44:00",
                                        "15:59:00",
                                        "16:14:00",
                                        "16:29:00",
                                        "16:44:00",
                                        "16:59:00",
                                        "17:14:00",
                                        "17:29:00",
                                        "17:44:00",
                                        "17:59:00",
                                        "18:14:00",
                                        "18:29:00",
                                        "18:44:00",
                                        "18:59:00",
                                        "19:14:00",
                                        "19:29:00",
                                        "19:44:00",
                                        "19:59:00",
                                        "20:14:00",
                                        "20:29:00",
                                        "20:44:00",
                                        "20:59:00",
                                        "21:14:00",
                                        "21:29:00",
                                        "21:44:00",
                                        "21:59:00",
                                        "22:14:00",
                                        "22:29:00",
                                        "22:44:00",
                                        "22:59:00",
                                        "23:14:00",
                                        "23:29:00",
                                        "23:44:00",
                                        "23:59:00"

                                    ],
                                    datasets: [{
                                            label: 'kwh ',
                                            backgroundColor: [
                                                'rgba(54, 162, 235, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)'
                                            ],
                                            borderWidth: 1,
                                            data: [
                                                12,
                                                19,
                                                3,
                                                5,
                                                8,
                                                8,
                                                10,
                                                14,
                                                12,
                                                16,
                                                12,
                                                17,
                                                13,
                                                17,
                                                19,
                                                11,
                                                17,
                                                6,
                                                17,
                                                12,
                                                12,
                                                7,
                                                3,
                                                7,
                                                10,
                                                12,
                                                19,
                                                12,
                                                10,
                                                4,
                                                8,
                                                5,
                                                9,
                                                12,
                                                4,
                                                6,
                                                9,
                                                10,
                                                13,
                                                4,
                                                12,
                                                12,
                                                15,
                                                8,
                                                8,
                                                9,
                                                7,
                                                8,
                                                10,
                                                11,
                                                10,
                                                5,
                                                9,
                                                8,
                                                4,
                                                7,
                                                3,
                                                8,
                                                10,
                                                11,
                                                2,
                                                7,
                                                9,
                                                10,
                                                9,
                                                10,
                                                12,
                                                8,
                                                9,
                                                10,
                                                11,
                                                12,
                                                8,
                                                9,
                                                10,
                                                7,
                                                9,
                                                10,
                                                5,
                                                9,
                                                7,
                                                9,
                                                13,
                                                17,
                                                8,
                                                12,
                                                13,
                                                15,
                                                12,
                                                6,
                                                12,
                                                15,
                                                2,
                                                4,
                                                7,
                                                8

                                            ]
                                        }]
                                };



                                $(function () {
                                    $.ajax({
                                        type: "POST",
                                        url: "<? echo site_url('UserPosition/sposition'); ?>",
                                        dataType: 'json',
                                        cache: false,
                                        data: {
                                            type_of_action: "click",
                                            action: "My Energy Profile",
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

                                    var config = {
                                        type: 'line',
                                        data: {
                                            labels: ["00:14:00",
                                                "00:29:00",
                                                "00:44:00",
                                                "00:59:00",
                                                "01:14:00",
                                                "01:29:00",
                                                "01:44:00",
                                                "01:59:00",
                                                "02:14:00",
                                                "02:29:00",
                                                "02:44:00",
                                                "02:59:00",
                                                "03:14:00",
                                                "03:29:00",
                                                "03:44:00",
                                                "03:59:00",
                                                "04:14:00",
                                                "04:29:00",
                                                "04:44:00",
                                                "04:59:00",
                                                "05:14:00",
                                                "05:29:00",
                                                "05:44:00",
                                                "05:59:00",
                                                "06:14:00",
                                                "06:29:00",
                                                "06:44:00",
                                                "06:59:00",
                                                "07:14:00",
                                                "07:29:00",
                                                "07:44:00",
                                                "07:59:00",
                                                "08:14:00",
                                                "08:29:00",
                                                "08:44:00",
                                                "08:59:00",
                                                "09:14:00",
                                                "09:29:00",
                                                "09:44:00",
                                                "09:59:00",
                                                "10:14:00",
                                                "10:29:00",
                                                "10:44:00",
                                                "10:59:00",
                                                "11:14:00",
                                                "11:29:00",
                                                "11:44:00",
                                                "11:59:00",
                                                "12:14:00",
                                                "12:29:00",
                                                "12:44:00",
                                                "12:59:00",
                                                "13:14:00",
                                                "13:29:00",
                                                "13:44:00",
                                                "13:59:00",
                                                "14:14:00",
                                                "14:29:00",
                                                "14:44:00",
                                                "14:59:00",
                                                "15:14:00",
                                                "15:29:00",
                                                "15:44:00",
                                                "15:59:00",
                                                "16:14:00",
                                                "16:29:00",
                                                "16:44:00",
                                                "16:59:00",
                                                "17:14:00",
                                                "17:29:00",
                                                "17:44:00",
                                                "17:59:00",
                                                "18:14:00",
                                                "18:29:00",
                                                "18:44:00",
                                                "18:59:00",
                                                "19:14:00",
                                                "19:29:00",
                                                "19:44:00",
                                                "19:59:00",
                                                "20:14:00",
                                                "20:29:00",
                                                "20:44:00",
                                                "20:59:00",
                                                "21:14:00",
                                                "21:29:00",
                                                "21:44:00",
                                                "21:59:00",
                                                "22:14:00",
                                                "22:29:00",
                                                "22:44:00",
                                                "22:59:00",
                                                "23:14:00",
                                                "23:29:00",
                                                "23:44:00",
                                                "23:59:00"],
                                            datasets: [{
                                                    label: "kwh",
                                                    backgroundColor: [
                                                        'rgba(54, 162, 235, 0.2)'
                                                    ],
                                                    borderColor: [
                                                        'rgba(54, 162, 235, 1)'
                                                    ],
                                                    data: [
                                                        12,
                                                        19,
                                                        3,
                                                        5,
                                                        8,
                                                        8,
                                                        10,
                                                        14,
                                                        12,
                                                        16,
                                                        12,
                                                        17,
                                                        13,
                                                        17,
                                                        19,
                                                        11,
                                                        17,
                                                        6,
                                                        17,
                                                        12,
                                                        12,
                                                        7,
                                                        3,
                                                        7,
                                                        10,
                                                        12,
                                                        19,
                                                        12,
                                                        10,
                                                        4,
                                                        8,
                                                        5,
                                                        9,
                                                        12,
                                                        4,
                                                        6,
                                                        9,
                                                        10,
                                                        13,
                                                        4,
                                                        12,
                                                        12,
                                                        15,
                                                        8,
                                                        8,
                                                        9,
                                                        7,
                                                        8,
                                                        10,
                                                        11,
                                                        10,
                                                        5,
                                                        9,
                                                        8,
                                                        4,
                                                        7,
                                                        3,
                                                        8,
                                                        10,
                                                        11,
                                                        2,
                                                        7,
                                                        9,
                                                        10,
                                                        9,
                                                        10,
                                                        12,
                                                        8,
                                                        9,
                                                        10,
                                                        11,
                                                        12,
                                                        8,
                                                        9,
                                                        10,
                                                        7,
                                                        9,
                                                        10,
                                                        5,
                                                        9,
                                                        7,
                                                        9,
                                                        13,
                                                        17,
                                                        8,
                                                        12,
                                                        13,
                                                        15,
                                                        12,
                                                        6,
                                                        12,
                                                        15,
                                                        2,
                                                        4,
                                                        7,
                                                        8
                                                    ],
                                                    fill: false,
                                                }]
                                        },
                                        options: {
                                            responsive: true,
                                            title: {
                                                display: true,
                                                text: 'Energy consumption ( typical day )'
                                            },
                                            tooltips: {
                                                mode: 'index',
                                                intersect: false,
                                            },
                                            hover: {
                                                mode: 'nearest',
                                                intersect: true
                                            },
                                            scales: {
                                                xAxes: [{
                                                        display: true,
                                                        scaleLabel: {
                                                            display: true,
                                                            labelString: 'Month'
                                                        }
                                                    }],
                                                yAxes: [{
                                                        display: true,
                                                        scaleLabel: {
                                                            display: true,
                                                            labelString: 'Value'
                                                        }
                                                    }]
                                            }
                                        }
                                    };
                                    var MONTHS = ["00:14:00",
                                        "00:29:00",
                                        "00:44:00",
                                        "00:59:00",
                                        "01:14:00",
                                        "01:29:00",
                                        "01:44:00",
                                        "01:59:00",
                                        "02:14:00",
                                        "02:29:00",
                                        "02:44:00",
                                        "02:59:00",
                                        "03:14:00",
                                        "03:29:00",
                                        "03:44:00",
                                        "03:59:00",
                                        "04:14:00",
                                        "04:29:00",
                                        "04:44:00",
                                        "04:59:00",
                                        "05:14:00",
                                        "05:29:00",
                                        "05:44:00",
                                        "05:59:00",
                                        "06:14:00",
                                        "06:29:00",
                                        "06:44:00",
                                        "06:59:00",
                                        "07:14:00",
                                        "07:29:00",
                                        "07:44:00",
                                        "07:59:00",
                                        "08:14:00",
                                        "08:29:00",
                                        "08:44:00",
                                        "08:59:00",
                                        "09:14:00",
                                        "09:29:00",
                                        "09:44:00",
                                        "09:59:00",
                                        "10:14:00",
                                        "10:29:00",
                                        "10:44:00",
                                        "10:59:00",
                                        "11:14:00",
                                        "11:29:00",
                                        "11:44:00",
                                        "11:59:00",
                                        "12:14:00",
                                        "12:29:00",
                                        "12:44:00",
                                        "12:59:00",
                                        "13:14:00",
                                        "13:29:00",
                                        "13:44:00",
                                        "13:59:00",
                                        "14:14:00",
                                        "14:29:00",
                                        "14:44:00",
                                        "14:59:00",
                                        "15:14:00",
                                        "15:29:00",
                                        "15:44:00",
                                        "15:59:00",
                                        "16:14:00",
                                        "16:29:00",
                                        "16:44:00",
                                        "16:59:00",
                                        "17:14:00",
                                        "17:29:00",
                                        "17:44:00",
                                        "17:59:00",
                                        "18:14:00",
                                        "18:29:00",
                                        "18:44:00",
                                        "18:59:00",
                                        "19:14:00",
                                        "19:29:00",
                                        "19:44:00",
                                        "19:59:00",
                                        "20:14:00",
                                        "20:29:00",
                                        "20:44:00",
                                        "20:59:00",
                                        "21:14:00",
                                        "21:29:00",
                                        "21:44:00",
                                        "21:59:00",
                                        "22:14:00",
                                        "22:29:00",
                                        "22:44:00",
                                        "22:59:00",
                                        "23:14:00",
                                        "23:29:00",
                                        "23:44:00",
                                        "23:59:00"];


                                    window.myBar = new Chart(ctx, {
                                        type: 'bar',
                                        data: barChartDataX,
                                        options: {
                                            responsive: true,
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Energy consumption ( typical day )'
                                            }
                                        }
                                    });



                                    var ctx2 = document.getElementById("myChart2").getContext("2d");
                                    window.myLine = new Chart(ctx2, config);

                                    $('select').material_select();
                                    $('input[name="daterange"]').daterangepicker(
                                            {
                                                dateLimit: {days: 60},
                                                startDate: '<?= date('m/d/Y') ?>',
                                                endDate: '<?= date('m/d/Y', strtotime('+1 day', strtotime(date('m/d/Y')))) ?>'
                                            },
                                            function (start, end) {
                                                console.log("Callback has been called!");
                                                //$('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
                                                console.log(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
                                                startDate = start;
                                                endDate = end;

                                            }

                                    );

                                });

                                $('.modal').modal();
<?php $this->view('extra/jslib'); ?>

                                $('body').on('click', '#search_box2', function () {


                                    var macD = $('#selectMeter').val();

                                    if (macD == null || macD === false) {

                                        Materialize.toast('You havent select Mac!', 4000, 'red rounded');
                                        return true;

                                    } else if (macD.length < 1) {

                                        Materialize.toast('You havent select Mac!', 4000, 'red rounded');
                                        return true;
                                    }



                                    var GraphType = "bar";

                                    if (startDate === undefined || startDate === null) {
                                        //alert("undeifend");
                                        startDate = '<?= date('d-m-Y') ?>';

                                        endDate = '<?= date('d-m-Y', strtotime('+1 day', strtotime(date('m/d/Y')))) ?>';

                                    } else {


                                        var res = String(startDate) + " ";

                                        var n = res.indexOf("-");

                                        if (n < 0) {


                                            startDate = startDate.format('DD-MM-YYYY');
                                            endDate = endDate.format('DD-MM-YYYY');

                                        }

                                    }

                                    $.ajax({
                                        type: "POST",
                                        url: "<? echo site_url('Loadb/consM'); ?>",
                                        dataType: 'json',
                                        cache: false,
                                        data: {
                                            searchDateFrom: startDate, // startDate.format('DD-MM-YYYY'),
                                            searchDateTo: endDate, //endDate.format('DD-MM-YYYY'), //D MMMM YYYY
                                            //  timeD: $.trim(timeD),
                                            macD: $.trim(macD),
                                            'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
                                        },
                                        beforeSend: function () {

                                            $("#loaderID").css("display", "block");
                                            //  $("#spiaj").css("display", "block");

                                        },
                                        complete: function () {
                                            // $("#spiaj").css("display", "none");

                                        },
                                        success: function (msg) { //probably this request will return anything, it'll be put in var "data"



                                            var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < msg.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = msg['kwh_' + iii] + '';//"1.21875,4.17188,14.25,0.289062,0.433594,3.75,0.0625,0.035156,0.019531,13.5,42,0.125,64,37,1.125,4.1875,14,0.304688,0.4375,3.3125";//msg.result;
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = msg['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));


                                                    valuesInsert += partsOfStr[i] + ",";


                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: 'kwh',
                                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                    borderColor: 'rgba(54, 162, 235, 1)',
                                                    hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                                    data: window["dataD" + iii]
                                                };



                                                configDatasets.push(ObjectSpec);

                                            }


                                            var chartdata = {
                                                labels: labelT,
                                                datasets: configDatasets

                                                ,
                                            };
                                            $("#loaderID").css("display", "none");

                                            // window.myBar.destroy();

                                            var ctx = $("#myChart");
                                            if (typeof barGraph === 'object') {

                                                barGraph.destroy();
                                            }

                                            barGraph = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata
                                            });



                                            window.myBar.destroy();
                                            // window.myBar.update();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown)
                                        {
                                            $("#loaderID").css("display", "none");
                                            $("#message_print_2").css("display", "block").delay(5000).fadeOut('slow');

                                        }
                                    });






                                });


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


                            </script>

                            </html>
