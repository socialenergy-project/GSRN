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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
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

            .containerGifts {
                position: relative;
                height: 250px;
                width:350px !important;
                margin-right:2px;
                margin-top:2px;
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


            .overlay {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }
            .overlay2 {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }
            .overlay3 {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }
            .overlay4 {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }

            .overlay5 {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }
            
            .overlay6 {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }
            
            .overlay7 {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }
            
            .overlay8 {
                z-index: 1;
                display: none;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -32px; /* -1 * image width / 2 */
                margin-top: -32px; /* -1 * image height / 2 */
            }
            
            
            .csst {
                position: relative;
                display: table;
                width: 100%;
                height: 100%;
            }
            .csst > div {
                display: table-cell;
                vertical-align: middle;
                text-align: center;
            }


            .zoomInAnimation {
                -webkit-animation: zoomIn 1.8s ease-out;
                animation: zoomIn 1.8s ease-out;
            }
            @-webkit-keyframes zoomIn {
                from {
                    -webkit-transform: scale3d(0.6,0.6,1);
                    transform: scale3d(0.6,0.6,1);
                }
            }
            @keyframes zoomIn {
                from {
                    -webkit-transform: scale3d(0.6,0.6,1);
                    transform: scale3d(0.6,0.6,1);
                }
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
                                        <h4 class="title">DASHBOARD!</h4>
                                    </div>
                                    <div class="content">

                                        <div class="container-fluid">
                                            <h1></h1>

                                            <div class="row">

                                                <div class="col s1 teal lighten-2 containerGifts zoomInAnimation" id="droppableGifts">
                                                    <div class="csst">
                                                        <div>
                                                            <div class="overlay">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG1">
                                                                <?= $boxx1 = isset($box_1) ? $box_1 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="col s1 teal lighten-2 containerGifts zoomInAnimation" id="droppableGifts_2">
                                                     <div class="csst">
                                                        <div>
                                                            <div class="overlay2">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG2">
                                                                <?= $boxx2 = isset($box_2) ? $box_2 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div> 

                                                </div>
                                                <div class="col s1 teal lighten-2 containerGifts zoomInAnimation" id="droppableGifts_3">

                                                    <div class="csst">
                                                        <div>
                                                            <div class="overlay3">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG3">
                                                                <?= $boxx3 = isset($box_3) ? $box_3 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div> 

                                                </div>
                                                <div class="col s1 teal lighten-2 containerGifts zoomInAnimation" id="droppableGifts_4">

                                                    <div class="csst">
                                                        <div>
                                                            <div class="overlay4">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG4">
                                                                <?= $boxx4 = isset($box_4) ? $box_4 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col s2 dropWidget zoomInAnimation" id="drag-wizzardGift_1">
                                                    <a class="waves-effect waves-light btn-large tooltipped" data-position="top" data-delay="50" data-tooltip="Draggable Energy widget, Drop it to container">Widget - Energy Profile</a>
                                                </div>

                                                <div class="col s2 dropWidget zoomInAnimation" id="drag-wizzardGift_2">
                                                    <a class="waves-effect waves-light btn-large tooltipped" data-position="top" data-delay="50" data-tooltip="Draggable Lcms widget Drop it to container">Widget - Lcms Profile</a>
                                                </div>

                                                <div class="col s2 dropWidget zoomInAnimation" id="drag-wizzardGift_3">
                                                    <a class="waves-effect waves-light btn-large tooltipped" data-position="top" data-delay="50" data-tooltip="Draggable Game widget Drop it to container">Widget - Game Profile</a>
                                                </div>

                                                <div class="col s2 dropWidget zoomInAnimation" id="drag-wizzardGift_4">
                                                    <a class="waves-effect waves-light btn-large tooltipped" data-position="top" data-delay="50" data-tooltip="Draggable Market widget Drop it to container">Widget -Market</a>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                
                                              <div class="col s1 blue-grey lighten-5 containerGifts zoomInAnimation" id="droppableGifts_5">

                                                    <div class="csst">
                                                        <div>
                                                            <div class="overlay5">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG5">
                                                                <canvas id='myChart1' width='330' height='250' style="margin-left:-7%;padding-bottom: 2%;"></canvas> 
                                                                <?= $boxx5 = isset($box_5) ? $box_5 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   
                                                
                                                
                                                  <div class="col s1 blue-grey lighten-5 containerGifts zoomInAnimation" id="droppableGifts_6">

                                                    <div class="csst">
                                                        <div>
                                                            <div class="overlay6">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG6">
                                                                 <canvas id='myChart2' width='330' height='250' style="margin-left:-7%;padding-bottom: 2%;"></canvas> 
                                                                <?= $boxx6 = isset($box_6) ? $box_6 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                
                                                
                                                  <div class="col s1 blue-grey lighten-5 containerGifts zoomInAnimation" id="droppableGifts_7">

                                                    <div class="csst">
                                                        <div>
                                                            <div class="overlay7">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG7">
                                                                <canvas id='myChart3' width='330' height='250' style="margin-left:-7%;padding-bottom: 2%;"></canvas> 
                                                                <?= $boxx7 = isset($box_7) ? $box_7 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                
                                                
                                                <div class="col s1 blue-grey lighten-5 containerGifts zoomInAnimation" id="droppableGifts_8">

                                                    <div class="csst">
                                                        <div>
                                                            <div class="overlay8">
                                                                <div class="preloader-wrapper big active">
                                                                    <div class="spinner-layer spinner-blue-only">
                                                                        <div class="circle-clipper left">
                                                                            <div class="circle"></div>
                                                                        </div><div class="gap-patch">
                                                                            <div class="circle"></div>
                                                                        </div><div class="circle-clipper right">
                                                                            <div class="circle"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="content" id="contentG8">
                                                                <canvas id='myChart4' width='330' height='250' style="margin-left:-7%;padding-bottom: 2%;"></canvas> 
                                                                <?= $boxx7 = isset($box_8) ? $box_8 : ""; ?>
                                                            </div>
                                                        </div>
                                                    </div>
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

                            <script type="text/javascript" src="<?= base_url() ?>public/assets/jsj/groupl.js"></script>



                            <link type="text/css" rel="stylesheet" href="<?= base_url() ?>public/assets/daterangepicker/daterangepicker.css"  />



                            <link type="text/css" rel="stylesheet" media="all" href="<?= base_url() ?>public/assets/css/chat.css" />
                            <link type="text/css" rel="stylesheet" media="all" href="<?= base_url() ?>public/assets/css/screen.css" />
                            <script type="text/javascript" src="<?= base_url() ?>public/assets/jsj/chat.js"></script>

                            <script type="text/javascript">

                                $(function () {

                                    $('.modal').modal();
                                    $('#modal1').modal();
                                    $(".dropWidget").draggable({revert: "valid"});
                                    
                                    
                                    var barGraph1;
                                    var barGraph2;
                                    var barGraph3;
                                    var barGraph4
                                    
                                    var barGraph1a;
                                    var barGraph2a;
                                    var barGraph3a;
                                    var barGraph4a;

<?php $this->view('extra/jslib'); 





?>
		
		
		
	
		
  var barChartDataX = {
                                    labels: [
                                        ""
                                    

                                    ],
                                    datasets: [{
                                            label: 'qq ',
                                            backgroundColor: [
                                                'rgba(54, 162, 235, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)'
                                            ],
                                            borderWidth: 1,
                                            data: [
                                                
                                             

                                            ]
                                        }]
                                };
 var GraphType = "bar";
 
  var ctx = document.getElementById("myChart2");

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
                                                text: 'ttt'
                                            }
                                        }
                                    });
 //$('.tap-target').tapTarget();
 //$('.tap-target').tapTarget('open');
 //console.log("Hello world!"); 

var graph1 = <?=  isset($box_1gr)?json_encode($box_1gr):2;  ?>;
//var myJsonString = JSON.stringify(graph1);


if (typeof graph1 !== 'undefined' && (graph1 !==null || graph1 !== 2  )){
//console.log(document.body );
//console.log("kkkkkkkkkkkk"+ graph1 );





                                            var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < graph1.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = graph1['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = graph1['label_date_' + iii] + '';
												//alert("LabelDate  "  + labels_diagram2);
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));


                                                    valuesInsert += partsOfStr[i] + ",";

//window["x"].push("04/01/2014");
                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: graph1.label,
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


           
                                                
                                                 var ctx = $("#myChart1");
                                                
                                                   if (typeof barGraph1a === 'object') {

                                                barGraph1a.destroy();
                                            }







                                            barGraph1a = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, 
												options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                },
			
				
            }],
		
		
		
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
    });
											
											
									
											
										
											
											
                                                
              


}


var graph2 = <?=  isset($box_2gr)?json_encode($box_2gr):2;  ?>;


if (typeof graph2 !== 'undefined' &&  (graph2 !==null || graph2 !== 2  )){
    
    
    
                                            var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < graph2.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = graph2['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = graph2['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));
                                                    valuesInsert += partsOfStr[i] + ",";
                                                     window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: graph2.label,
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
                                     
                                                 var ctx = $("#myChart2");
                                                
                                                   if (typeof barGraph2a === 'object') {

                                                barGraph2a.destroy();
                                            }

                                            barGraph2a = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata,
                                                 options: {
       scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
    
    
   
    
}


var graph3 = <?=  isset($box_3gr)?json_encode($box_3gr):2;  ?>;


if (typeof graph3 !== 'undefined' && (graph3 !==null || graph3 !== 2  )){
    
    
    
                                            var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < graph3.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = graph3['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = graph3['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));
                                                    valuesInsert += partsOfStr[i] + ",";
                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: graph3.label,
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
                                                
                                                 var ctx = $("#myChart3");
                                                
                                                   if (typeof barGraph3a === 'object') {

                                                barGraph3a.destroy();
                                            }

                                            barGraph3a = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
       scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
    
  
  
  
    
}


var graph4 = <?=  isset($box_4gr)?json_encode($box_4gr):2;  ?>;


if (typeof graph4 !== 'undefined' && (graph4 !==null || graph4 !== 2  )){
    
    
                                            var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < graph4.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = graph4['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = graph4['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));
                                                    valuesInsert += partsOfStr[i] + ",";
                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: graph4.label,
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


                      
                                                
                                                 var ctx = $("#myChart4");
                                                
                                                   if (typeof barGraph4a === 'object') {

                                                barGraph4a.destroy();
                                            }

                                            barGraph4a = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
   
}





                                    $("#droppableGifts").droppable({
                                        classes: {
                                            "ui-droppable-active": "ui-state-active",
                                            "ui-droppable-hover": "ui-state-hover"
                                        },
                                        drop: function (event, ui) {


                                            var draggable = ui.draggable;
                                            var id = draggable.attr("id");

                                            $(this)
                                                    .addClass("ui-state-highlight")
                                                    .find("p")
                                                    .html("Dropped!");

                                            var ids = $(event.target).attr('id');

                                            $.ajax({
                                                type: "POST",
                                                url: "<? echo site_url('Dasboard/position'); ?>",
                                                dataType: 'json',
                                                cache: false,
                                                data: {
                                                    droppableID: id,
                                                    baseID: $(event.target).attr('id'),
                                                    'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
                                                },
                                                beforeSend: function () {
                                                    $(".overlay").show();
                                                    // $("#loaderID").css("display", "block");
                                                    //  $("#spiaj").css("display", "block");

                                                },
                                                complete: function () {
                                                    // $("#spiaj").css("display", "none");
                                                    $(".overlay").hide();
                                                },
                                                success: function (msg) {

                                                    Materialize.toast('Widget has being saved!', 4000, 'green rounded');
                                                
                                                   //  $("div#contentG1").remove();
                                                    $('#' + ids + ' .content #cont').remove("#cont");
                                                    //  $('#' + ids + ' .content').remove("#cont");
                                                    // $('#' + ids + ' .content').append(msg.content);
                                                    $('#' + ids + ' .content').html("");
                                                    $('#' + ids + ' .content').html(msg.content);
                                                    
                                                    ////////////////////////////
                                                    ////////////////////////////
                                                    
                                            var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < msg.graph.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = msg.graph['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = msg.graph['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));
                                                    valuesInsert += partsOfStr[i] + ",";
                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: msg.graph.label,
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

                                             if(ids =="droppableGifts_2"){
                                               
			//	document.getElementById("contentG6").innerHTML = '';
//document.getElementById("contentG6").innerHTML = '<canvas id="myChart2" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'
								   
											   
                                                var ctx = $("#myChart2");
                                                
                                                 
                                            if (typeof barGraph1 === 'object') {
                                               barGraph1.destroy();
                                                barGraph2a.destroy();
												
												
												
												
                                            }

                                            barGraph1 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
         scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });

                                                
                                                
                                            }else if(ids =="droppableGifts"){
                                                
												
					//		document.getElementById("contentG5").innerHTML = '';
//document.getElementById("contentG5").innerHTML = '<canvas id="myChart1" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'				
                                                 var ctx = $("#myChart1");
 											
											
                                                   if (typeof barGraph2 === 'object') {

                                                barGraph2.destroy();
                                                barGraph1a.destroy();
												 
												
												 
                                            }

                                            barGraph2 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                            }else if(ids =="droppableGifts_3"){
                                                
												
										//	document.getElementById("contentG7").innerHTML = '';
//document.getElementById("contentG7").innerHTML = '<canvas id="myChart3" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'
	
                                                 var ctx = $("#myChart3");
                                                
                                                 if (typeof barGraph3 === 'object') {

                                                barGraph3.destroy();
                                                  barGraph3a.destroy();
                                            }

                                            barGraph3 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                                
                                            }else if(ids =="droppableGifts_4"){
                                               
											   
				//		document.getElementById("contentG8").innerHTML = '';
//document.getElementById("contentG8").innerHTML = '<canvas id="myChart4" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'
					   
											   
                                                 var ctx = $("#myChart4");
                                                 
                                                   if (typeof barGraph4 === 'object') {

                                                barGraph4.destroy();
                                                barGraph4a.destroy();
                                            }

                                            barGraph4 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
       scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                 
                                                 
                                                
                                            }



                                           // window.myBar.destroy();
                                           
                                                    
                                                   /////////////////////////////
                                                   ///////////////////////////// 
                                                    

                                                },
                                                error: function (jqXHR, textStatus, errorThrown)
                                                {


                                                }
                                            });

                                        }
                                    });


                                    $("#droppableGifts_2").droppable({
                                        classes: {
                                            "ui-droppable-active": "ui-state-active",
                                            "ui-droppable-hover": "ui-state-hover"
                                        },
                                        drop: function (event, ui) {
                                            $(".overlay2").show();

                                            var draggable = ui.draggable;
                                            var id = draggable.attr("id");
                         
		                                            $(this)
                                                    .addClass("ui-state-highlight")
                                                    .find("p")
                                                    .html("Dropped!");

                                            var ids = $(event.target).attr('id');

                                            $.ajax({
                                                type: "POST",
                                                url: "<? echo site_url('Dasboard/position'); ?>",
                                                dataType: 'json',
                                                cache: false,
                                                data: {
                                                    droppableID: id,
                                                    baseID: $(event.target).attr('id'),
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


                                                    Materialize.toast('Widget has being saved!!!', 4000, 'green rounded');
                                                    $('#' + ids + ' .content #cont').remove("#cont");
                                                   // $('#' + ids + ' .content').append(msg.content);
                                                    $('#' + ids + ' .content').html("");
                                                    $('#' + ids + ' .content').html(msg.content);
                                                     
                                                      
                                                    // alert(" Here "+msg.graph.max);
                                                    ////////////////////////////////////////////////////////////////////
                                                    ////////////////////////////////////////////////////////////////////
                                                    
                                                    
                                            var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < msg.graph.max; iii++) {
                                                
                                                window["dataD" + iii] = [];

                                                var values2 = msg.graph['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = msg.graph['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));
                                                    valuesInsert += partsOfStr[i] + ",";
                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: msg.graph.label,
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



                                            if(ids =="droppableGifts_2"){
                                                
										//		document.getElementById("contentG6").innerHTML = '&nbsp;';
//document.getElementById("contentG6").innerHTML = '<canvas id="myChart2" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'

												
                                                  var ctx = $("#myChart2");
                                                
                                                 
                                            if (typeof barGraph1 === 'object') {

                                                barGraph1.destroy();
                                                 barGraph2a.destroy();
                                            }

                                            barGraph1 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });

                                                
                                                
                                            }else if(ids =="droppableGifts"){
                                             
//document.getElementById("contentG5").innerHTML = '&nbsp;';
//document.getElementById("contentG5").innerHTML = '<canvas id="myChart1" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'
 
											 
                                                 var ctx = $("#myChart1");
                                                
                                                   if (typeof barGraph2 === 'object') {

                                                barGraph2.destroy();
                                                 barGraph1a.destroy();
                                            }

                                            barGraph2 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
       scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                            }else if(ids =="droppableGifts_3"){
                                                
										//	document.getElementById("contentG7").innerHTML = '&nbsp;';
//document.getElementById("contentG7").innerHTML = '<canvas id="myChart3" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'
	
												
                                                 var ctx = $("#myChart3");
                                                
                                                 if (typeof barGraph3 === 'object') {

                                                barGraph3.destroy();
                                                 barGraph3a.destroy();
                                            }

                                            barGraph3 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                                
                                            }else if(ids =="droppableGifts_4"){
                                                
										//	document.getElementById("contentG8").innerHTML = '&nbsp;';
//document.getElementById("contentG8").innerHTML = '<canvas id="myChart4" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'
	
												
												
                                                 var ctx = $("#myChart4");
                                                 
                                                   if (typeof barGraph4 === 'object') {

                                                barGraph4.destroy();
                                                 barGraph4a.destroy();
                                            }

                                            barGraph4 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
         scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                 
                                                 
                                                
                                            }
                                          
                                          
                                           // window.myBar.destroy();
                                                    
                                                     ////////////////////////////////////////////////////////////////////
                                                     ////////////////////////////////////////////////////////////////////
   
                                                },
                                                error: function (jqXHR, textStatus, errorThrown)
                                                {


                                                }
                                            });

                                        }
                                    });


                                    $("#droppableGifts_3").droppable({
                                        classes: {
                                            "ui-droppable-active": "ui-state-active",
                                            "ui-droppable-hover": "ui-state-hover"
                                        },
                                        drop: function (event, ui) {

                                            var draggable = ui.draggable;
                                            var id = draggable.attr("id");
                                            $(this)
                                                    .addClass("ui-state-highlight")
                                                    .find("p")
                                                    .html("Dropped!");

                                            var ids = $(event.target).attr('id');

                                            $.ajax({
                                                type: "POST",
                                                url: "<? echo site_url('Dasboard/position'); ?>",
                                                dataType: 'json',
                                                cache: false,
                                                data: {
                                                    droppableID: id,
                                                    baseID: $(event.target).attr('id'),
                                                    'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
                                                },
                                                beforeSend: function () {
                                                    $(".overlay3").show();
                                                    // $("#loaderID").css("display", "block");
                                                    //  $("#spiaj").css("display", "block");

                                                },
                                                complete: function () {
                                                    // $("#spiaj").css("display", "none");
                                                    $(".overlay3").hide();
                                                },
                                                success: function (msg) {


                                                    Materialize.toast('Widget has being saved!', 4000, 'green rounded');
                                                    $('#' + ids + ' .content #cont').remove("#cont");
                                                    //$('#' + ids + ' .content').append(msg.content);     
                                                    $('#' + ids + ' .content').html("");
                                                    $('#' + ids + ' .content').html(msg.content);
                                                    
                                                    
                                                    ////////////////////////////
                                                    ////////////////////////////
                                                    
                                                     var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < msg.graph.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = msg.graph['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = msg.graph['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));


                                                    valuesInsert += partsOfStr[i] + ",";


                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: msg.graph.label,
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

document.getElementById("contentG7").innerHTML = '&nbsp;';
document.getElementById("contentG7").innerHTML = '<canvas id="myChart3" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'



                                            if(ids =="droppableGifts_2"){
                                                
                                                  var ctx = $("#myChart2");
                                                
                                                 
                                            if (typeof barGraph1 === 'object') {

                                                barGraph1.destroy();
                                                 barGraph2a.destroy();
                                            }

                                            barGraph1 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });

                                                
                                                
                                            }else if(ids =="droppableGifts"){
                                                
                                                 var ctx = $("#myChart1");
                                                
                                                   if (typeof barGraph2 === 'object') {

                                                barGraph2.destroy();
                                                 barGraph1a.destroy();
                                            }

                                            barGraph2 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
      scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                            }else if(ids =="droppableGifts_3"){
                                                
                                                 var ctx = $("#myChart3");
                                                
                                                 if (typeof barGraph3 === 'object') {

                                                barGraph3.destroy();
                                                 barGraph3a.destroy();
                                            }

                                            barGraph3 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                                
                                            }else if(ids =="droppableGifts_4"){
                                                
                                                 var ctx = $("#myChart4");
                                                 
                                                   if (typeof barGraph4 === 'object') {

                                                barGraph4.destroy();
                                                 barGraph4a.destroy();
                                            }

                                            barGraph4 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
         scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                 
                                                 
                                                
                                            }



                                          //  window.myBar.destroy();

                                                    
                                                    
                                                    
                                                    
                                                    ////////////////////////////
                                                    ////////////////////////////
                                                    

                                                },
                                                error: function (jqXHR, textStatus, errorThrown)
                                                {


                                                }
                                            });




                                        }
                                    });



                                    $("#droppableGifts_4").droppable({
                                        classes: {
                                            "ui-droppable-active": "ui-state-active",
                                            "ui-droppable-hover": "ui-state-hover"
                                        },
                                        drop: function (event, ui) {


                                            var draggable = ui.draggable;
                                            var id = draggable.attr("id");
                                            $(this)
                                                    .addClass("ui-state-highlight")
                                                    .find("p")
                                                    .html("Dropped!");
                                            var ids = $(event.target).attr('id');
                                            $.ajax({
                                                type: "POST",
                                                url: "<? echo site_url('Dasboard/position'); ?>",
                                                dataType: 'json',
                                                cache: false,
                                                data: {
                                                    droppableID: id,
                                                    baseID: $(event.target).attr('id'),
                                                    'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
                                                },
                                                beforeSend: function () {
                                                    $(".overlay4").show();
                                                    // $("#loaderID").css("display", "block");
                                                    //  $("#spiaj").css("display", "block");

                                                },
                                                complete: function () {
                                                    // $("#spiaj").css("display", "none");
                                                    $(".overlay4").hide();
                                                },
                                                success: function (msg) {


                                                    Materialize.toast('Widget has being saved!', 4000, 'green rounded');


                                                      $('#' + ids + ' .content #cont').remove("#cont");
                                                   // $('#' + ids + ' .content').append(msg.content);
                                                      $('#' + ids + ' .content').html("");
                                                      $('#' + ids + ' .content').html(msg.content);
                                                      
                                                      //////////////////////////
                                                      //////////////////////////
                                                      
                                                       var labelT = [];
                                            var configDatasets = [];
                                            for (var iii = 0; iii < msg.graph.max; iii++) {
                                                window["dataD" + iii] = [];


                                                var values2 = msg.graph['kwh_' + iii] + '';
                                                var partsOfStr = values2.split(",");
                                                var labels_diagram2 = msg.graph['label_date_' + iii] + '';
                                                var partsOfStrLabels = labels_diagram2.split(",");

                                                var valuesInsert = "";

                                                for (var i = 0; i < partsOfStr.length; i++) {

                                                    labelT.push(partsOfStrLabels[i].replace("T", " "));


                                                    valuesInsert += partsOfStr[i] + ",";


                                                    window["dataD" + iii].push(partsOfStr[i]);
                                                }


                                                var ObjectSpec = {
                                                    label: msg.graph.label,
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


document.getElementById("contentG8").innerHTML = '&nbsp;';
document.getElementById("contentG8").innerHTML = '<canvas id="myChart4" width="330" height="250" style="margin-left:-7%;padding-bottom: 2%;"></canvas>'


                                          if(ids =="droppableGifts_2"){
                                                
                                                var ctx = $("#myChart2");
                                                
                                            if (typeof barGraph1 === 'object') {

                                                barGraph1.destroy();
                                                 barGraph2a.destroy();
                                            }

                                            barGraph1 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
         scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });

                                                
                                                
                                            }else if(ids =="droppableGifts"){
                                                
                                                var ctx = $("#myChart1");
                                                
                                            if (typeof barGraph2 === 'object') {

                                                barGraph2.destroy();
                                                barGraph1a.destroy();
                                            }

                                            barGraph2 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                            }else if(ids =="droppableGifts_3"){
                                                
                                                 var ctx = $("#myChart3");
                                                
                                                 if (typeof barGraph3 === 'object') {

                                                barGraph3.destroy();
                                                barGraph3a.destroy();
                                            }

                                            barGraph3 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
        scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                
                                                
                                                
                                            }else if(ids =="droppableGifts_4"){
                                                
                                                 var ctx = $("#myChart4");
                                                 
                                                   if (typeof barGraph4 === 'object') {

                                                barGraph4.destroy();
                                                barGraph4a.destroy();
                                            }

                                            barGraph4 = new Chart(ctx, {
                                                type: GraphType, //'bar', //line
                                                data: chartdata, options: {
      scales: {
            xAxes: [{
                     gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }],
         yAxes: [{
                  gridLines: {
                    display:false
                },
                ticks: {
                    display: false
                }
            }]
        }
    }
                                            });
                                                 
                                                 
                                                
                                            }


                                          //  window.myBar.destroy();
                                                    //////////////////////////
                                                      //////////////////////////


                                                },
                                                error: function (jqXHR, textStatus, errorThrown)
                                                {


                                                }
                                            });

                                        }
                                    });


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
                            
                            
                      
// Materialize.toast('You have a new invitation to join group, go to settings / friends!', 7000, 'blue rounded');//,completeCallback: function(){alert('Your toast was dismissed')}
<?php
if (isset($newQuestIntoSystem))
{

    echo "Materialize.toast('New questionnaire has being created succesfully!', 5000, 'green rounded');";
}
?>



                                    $.ajax({
                                        type: "POST",
                                        url: "<? echo site_url('UserPosition/sposition'); ?>",
                                        dataType: 'json',
                                        cache: false,
                                        data: {
                                            type_of_action: "click",
                                            action: "Dashboard",
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


                                    $('body').on('click', '.posti', function () {


                                        var contentRemoved = "";
                                        var giftPosted = "";
                                        var giftOverlay = "";

                                        contentRemoved = $(this).parent().parent().parent().parent().parent().parent().attr('id');

                                        if (contentRemoved == "contentG1") {
                                            giftOverlay = "overlay";
                                            
                                            if(barGraph2 === "undefined" || barGraph2 == null){
                                           
                                        }else{ barGraph2.destroy();}
                                        
                                        
                                          if(barGraph1a === "undefined" || barGraph1a == null){
                                           
                                        }else{ barGraph1a.destroy();}
                                        
                                        
                                        
                                        
                                        
                                            
                                        } else if (contentRemoved == "contentG2") {
                                            giftOverlay = "overlay2";
                                            
                                            
                                             if(barGraph1 === "undefined" || barGraph1 == null){
                                           
                                        }else{
                                            barGraph1.destroy(); 
                                            
                                        }
                                        
                                        
                                        
                                        
                                          if(barGraph2a === "undefined" || barGraph2a == null){
                                           
                                        }else{
                                            barGraph2a.destroy(); 
                                            
                                        }
                                        
                                        
                                            
                                        } else if (contentRemoved == "contentG3") {
                                            giftOverlay = "overlay3";
                                            
                                              if(barGraph3 === "undefined" || barGraph3 == null){
                                            
                                        }else{
                                            barGraph3.destroy();
                                            
                                        }
                                        
                                        
                                        
                                        if(barGraph3a === "undefined" || barGraph3a == null){
                                            
                                        }else{
                                            barGraph3a.destroy();
                                            
                                        }
                                        
                                        
                                        
                                        
                                        } else if (contentRemoved == "contentG4") {
                                            giftOverlay = "overlay4";
                                            
                                              if(barGraph4 === "undefined" || barGraph4 == null){
                                           
                                        }else{
                                            
                                             barGraph4.destroy();
                                        }
                                        
                                        
                                         if(barGraph4a === "undefined" || barGraph4a == null){
                                            
                                        }else{
                                            barGraph4a.destroy();
                                            
                                        }
                                        
                                        
                                        
                                            
                                        }



                                        if ($(this).attr("data-id") == "pos_1") {
                                           
                                            giftPosted = "droppableGifts_1";

                                        } else if ($(this).attr("data-id") == "pos_2") {
                                           
                                            giftPosted = "droppableGifts_2";
       
                                        } else if ($(this).attr("data-id") == "pos_3") {
                                            
                                            giftPosted = "droppableGifts_3";

                                        } else if ($(this).attr("data-id") == "pos_4") {
                                            
                                            giftPosted = "droppableGifts_4";

                                        }


                                        $.ajax({
                                            type: "POST",
                                            url: "<? echo site_url('Dasboard/positionR'); ?>",
                                            dataType: 'json',
                                            cache: false,
                                            data: {
                                                droppableID: giftPosted,
                                                whereto: contentRemoved,
                                                'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
                                            },
                                            beforeSend: function () {
                                                $("." + giftOverlay).show();
                                                // $("#loaderID").css("display", "block");
                                                //  $("#spiaj").css("display", "block");

                                            },
                                            complete: function () {
                                                // $("#spiaj").css("display", "none");
                                                $("." + giftOverlay).hide();
                                            },
                                            success: function (msg) {


                                                if (msg.result == 200) {

                                                    Materialize.toast('Widget has being removed!', 4000, 'green rounded');
                                                    $("#" + contentRemoved).empty();


                                                } else {
                                                    Materialize.toast('try againa later!', 4000, 'blue rounded');

                                                }

                                                //  $('#' + ids + ' .content #cont').remove("#cont");

                                                // $('#' + ids + ' .content').append(msg.content);

                                            },
                                            error: function (jqXHR, textStatus, errorThrown)
                                            {


                                            }
                                        });




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
