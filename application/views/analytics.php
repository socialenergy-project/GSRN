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
                                        <h4 class="title">Analytics</h4>
                                    </div>
                                    <div class="content">
										<?php
										echo form_open('Analytics/drawData');
										?>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select multiple name="Consumer_ids" id="Consumer_ids">
                                                        <option value="" disabled selected>Choose your option</option>

														<?php
														if (isset($prosumersDataID) && is_array($prosumersDataID) === TRUE) {
															$max = sizeof($prosumersDataID);

															for ($i = 0; $i < $max; $i++) {

																echo "<option value='$prosumersDataID[$i]'>$prosumersDataTitle[$i]</option>";
											
															}
														}
														?>


														<!--
                                                        <option value="1">HEDNO Commercial MV 5001</option>
                                                        <option value="2">HEDNO Commercial MV 5002</option>
                                                        <option value="3">HEDNO Commercial MV 5003</option>
														-->

                                                    </select>
                                                    <label id="Consumeridsz">IDs</label>       
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Starttime</label>
                                                    <input type="text" name="Starttime" id="Starttime" class="form-control" placeholder="Starttime"
<?= $value = isset($Starttime) ? "value='" . $Starttime . "'" : "value=''"; ?>>
<?= form_error('email_1'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select  name="Interval" id="Interval">
                                                        <option value="" disabled selected>Choose your option</option>
                                                        <option value="1">15 minutes</option>
                                                        <option value="2">50 minutes</option>
                                                        <option value="3">Daily</option>
                                                    </select>
                                                    <label id="intervalid">Interval 2</label>       
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select  name="Ecc_type" id="Ecc_type">
                                                        <option value="" disabled selected>Choose your option</option>
                                                        <option value="1">Mon-Fri</option>
                                                        <option value="2">Night hours</option>
                                                        <option value="3">Peak hours</option>
                                                        <option value="4">Weekend</option>
                                                    </select>
                                                    <label id="eccTypeid">Ecc type</label>       
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">        
                                                    <label>Energy cost parameter</label>     
                                                    <input type="text" id="EnergyCosPar" name="EnergyCosPar"  class="gdrmsSelec" />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">        
                                                    <label>Profit margin parameter</label>     
                                                    <input type="text" id="ProfitMarginParameter" name="ProfitMarginParameter"  class="gdrmsSelec" />

                                                </div>
                                            </div>         
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select  name="Flexibility_factor" id="Flexibility_factor">
                                                        <option value="" disabled selected>Choose your option</option>
                                                        <option value="1">Custom</option>
                                                        <option value="2">Low</option>
                                                        <option value="3">Medium</option>
                                                        <option value="4">High</option>
                                                    </select>
                                                    <label id="Flexibilityfactiorid">Flexibility factor</label>          
                                                </div>
                                            </div>  


                                            <div class="col-md-6">
                                                <div class="form-group">        
                                                    <label ID="number_of_clustersL">Number of clusters</label>     
                                                    <input type="text" id="number_of_clusters" name="number_of_clusters"  class="gdrmsSelec" />

                                                </div>
                                            </div>         



                                        </div>  


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select  multiple name="EnergyProgrmasIds" id="EnergyProgrmasIds">
                                                        <option value="" disabled selected>Choose your option</option>
                                                        <option value="1">RTP (no DR)</option>
                                                        <option value="2">Community Real-time pricing( Time of Usage )</option>
                                                        <option value="3">Real-time pricing</option>
                                                        <option value="4">Personal Real-time pricing</option>
                                                        <option value="5">Community Real-time pricing</option>
                                                    </select>
                                                    <label id="EnergyProgrmasIdss">Energy programs ids</label>          
                                                </div>
                                            </div>  


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gamma parameter</label>     
                                                    <input type="text" id="GammaParameter" name="GammaParameter"  class="gdrmsSelec" />
                                                </div>
                                            </div>
                                        </div>


                                        <!-- <button type="submit" class="btn btn-info btn-fill pull-right">Add User</button> -->
                                        <div class="clearfix"></div>
                                        </form>


                                        <div class="row">
                                            <div class="col-md-6" >
                                                <div class="grid-stack grid-stack-6" id="grid1" >
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
                                                    <canvas id='myChart' width='550' height='400'></canvas> 
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="grid-stack grid-stack-6" id="grid2">
                                                </div>
                                            </div>


                                            <div class="col-md-6" >
                                                <div class="grid-stack grid-stack-6" id="grid1" >

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
                                                    <canvas id='myChart2' width='550' height='400'></canvas> 
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
                                                    <canvas id='myChart3' width='550' height='400'></canvas> 

                                                </div>
                                            </div>

                                            <div class="col-md-6" >
                                                <div class="grid-stack grid-stack-6" id="grid1" >
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
                                                    <canvas id='myChart4' width='550' height='400'></canvas> 

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
                                                    <canvas id='myChart5' width='550' height='400'></canvas> 

                                                </div>
                                            </div> 

											<div class="col-md-6" >
                                                <div class="grid-stack grid-stack-6" id="grid1" >
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
                                                    <canvas id='myChart6' width='550' height='400'></canvas> 

                                                </div>
                                            </div> 



                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="grid-stack grid-stack-6" id="grid2">
                                                </div> 
                                            </div>


                                            <div class="col-md-6">
                                                <div class="grid-stack grid-stack-6" id="grid2">

                                                    <button type="submit" class="btn btn-info btn-fill pull-right" id='loadGraph'>Run algorithm</button>

                                                </div>
                                            </div>
                                        </div>      


                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="grid-stack grid-stack-6" id="grid2">
                                                </div>
                                            </div>
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

    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>public/assets/daterangepicker/daterangepicker.css"  />

    <link type="text/css" rel="stylesheet" media="all" href="<?= base_url() ?>public/assets/css/chat.css" />
    <link type="text/css" rel="stylesheet" media="all" href="<?= base_url() ?>public/assets/css/screen.css" />
    <script type="text/javascript" src="<?= base_url() ?>public/assets/jsj/chat.js"></script>

    <script type="text/javascript">

		var ctx = document.getElementById("myChart");

		var ctx2 = document.getElementById("myChart2");

		var ctx3 = document.getElementById("myChart3");

		var ctx4 = document.getElementById("myChart4");

		var ctx5 = document.getElementById("myChart5");

		var ctx6 = document.getElementById("myChart6");

		var startDate;

		var endDate;

		window.chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)'
		};

		(function (global) {
			var Months = [
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December'
			];

			var COLORS = [
				'#4dc9f6',
				'#f67019',
				'#f53794',
				'#537bc4',
				'#acc236',
				'#166a8f',
				'#00a950',
				'#58595b',
				'#8549ba'
			];

			var Samples = global.Samples || (global.Samples = {});
			var Color = global.Color;

			Samples.utils = {
				// Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
				srand: function (seed) {
					this._seed = seed;
				},
				rand: function (min, max) {
					var seed = this._seed;
					min = min === undefined ? 0 : min;
					max = max === undefined ? 1 : max;
					this._seed = (seed * 9301 + 49297) % 233280;
					return min + (this._seed / 233280) * (max - min);
				},
				numbers: function (config) {
					var cfg = config || {};
					var min = cfg.min || 0;
					var max = cfg.max || 1;
					var from = cfg.from || [];
					var count = cfg.count || 8;
					var decimals = cfg.decimals || 8;
					var continuity = cfg.continuity || 1;
					var dfactor = Math.pow(10, decimals) || 0;
					var data = [];
					var i, value;

					for (i = 0; i < count; ++i) {
						value = (from[i] || 0) + this.rand(min, max);
						if (this.rand() <= continuity) {
							data.push(Math.round(dfactor * value) / dfactor);
						} else {
							data.push(null);
						}
					}

					return data;
				},
				labels: function (config) {
					var cfg = config || {};
					var min = cfg.min || 0;
					var max = cfg.max || 100;
					var count = cfg.count || 8;
					var step = (max - min) / count;
					var decimals = cfg.decimals || 8;
					var dfactor = Math.pow(10, decimals) || 0;
					var prefix = cfg.prefix || '';
					var values = [];
					var i;

					for (i = min; i < max; i += step) {
						values.push(prefix + Math.round(dfactor * i) / dfactor);
					}

					return values;
				},
				months: function (config) {
					var cfg = config || {};
					var count = cfg.count || 12;
					var section = cfg.section;
					var values = [];
					var i, value;

					for (i = 0; i < count; ++i) {
						value = Months[Math.ceil(i) % 12];
						values.push(value.substring(0, section));
					}

					return values;
				},
				color: function (index) {
					return COLORS[index % COLORS.length];
				},
				transparentize: function (color, opacity) {
					var alpha = opacity === undefined ? 0.5 : 1 - opacity;
					return Color(color).alpha(alpha).rgbString();
				}
			};

			// DEPRECATED
			window.randomScalingFactor = function () {
				return Math.round(Samples.utils.rand(-100, 100));
			};

			// INITIALIZATION

			Samples.utils.srand(Date.now());



		}(this));


		var lineChartData = {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [{
					label: "My First dataset",
					borderColor: window.chartColors.red,
					backgroundColor: window.chartColors.red,
					fill: false,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
					yAxisID: "y-axis-1",
				}, {
					label: "My Second dataset",
					borderColor: window.chartColors.blue,
					backgroundColor: window.chartColors.blue,
					fill: false,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
					yAxisID: "y-axis-2"
				}]
		};

		window.onload = function () {


		};


		$(function () {

			$('.modal').modal();

<?php $this->view('extra/jslib'); ?>


			$('input[name="Starttime"]').daterangepicker(
					{
						dateLimit: {days: 60},
						startDate: '<?= date('m/d/Y') ?>',
						endDate: '<?= date('m/d/Y', strtotime('+1 day', strtotime(date('m/d/Y')))) ?>'
					},
					function (start, end) {
						//console.log("Callback has been called!");
						//$('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
						//console.log(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
						startDate = start;
						endDate = end;

					}

			);

			$('select').material_select();


			$('body').on('click', '#loadGraph', function () {


				// var startDate = "";
				var searchDateTo = "";
				var macD = "";
				// var endDate = "";
				var Ecc_type = "";
				var EnergyCosPar = "";
				var ProfitMarginParameter = "";
				var Flexibility_factor = "";
				var GammaParameter = "";
				var EnergyProgrmasIds = "";
				var number_of_clusters = "";

           
                  

				if (($('select#Consumer_ids').val() == null || $('select#Consumer_ids').val() === false || $('select#Consumer_ids').val() == "")) {

					Materialize.toast('You havent select Prosumers ID', 4000, 'red rounded');
					$('#Consumeridsz').css("color", "red");
					return true;
				} else {

					$('#Consumeridsz').css("color", "gray");

				}



				if (($('select#Interval').val() == null || $('select#Interval').val() === false)) {

					Materialize.toast('You havent select Interval', 4000, 'red rounded');
					$('#intervalid').css("color", "red");
					return true;

				} else {
					$('#intervalid').css("color", "gray");
				}


				if (($('select#Ecc_type').val() == null || $('select#Ecc_type').val() === false)) {

					Materialize.toast('You havent select Ecc Type', 4000, 'red rounded');
					$('#eccTypeid').css("color", "red");
					return true;
				} else {

					$('#eccTypeid').css("color", "gray");

				}



				if (($('select#Flexibility_factor').val() == null || $('select#Flexibility_factor').val() === false)) {

					Materialize.toast('You havent select Flexibility Factor', 4000, 'red rounded');
					$('#Flexibilityfactiorid').css("color", "red");
					return true;
				} else {

					$('#Flexibilityfactiorid').css("color", "gray");

				}




				if (($('select#EnergyProgrmasIds').val() == null || $('select#EnergyProgrmasIds').val() === false || $('select#EnergyProgrmasIds').val() == "")) {

					Materialize.toast('You havent select Energy Program', 4000, 'red rounded');
					$('#EnergyProgrmasIdss').css("color", "red");
					return true;
				} else {

					$('#EnergyProgrmasIdss').css("color", "gray");

				}





				//alert("Interval -- "+$('select#Interval').val());

				var interval = 1;
				if ($('select#Interval').val() == 1) {
					interval = 1;
					//alert("11");

				} else if ($('select#Interval').val() == 2) {
					interval = 2;
					// alert("22");

				} else if ($('select#Interval').val() == 3) {
					interval = 3;
					//  alert("33");

				} else {

					interval = 1;

				}

				// alert(" energyProgramsIDS " + $('#EnergyProgrmasIds').val());



				EnergyProgrmasIds = $('#EnergyProgrmasIds').val();



				if ($('#Flexibility_factor').val() > 0 && $('#Flexibility_factor').val() < 5) {

					Flexibility_factor = $('#Flexibility_factor').val();

				} else {

					Flexibility_factor = 1;

				}
				//Flexibility_factor


				if ($('select#Ecc_type').val() > 0 && $('select#Ecc_type').val() < 5) {

					Ecc_type = $('select#Ecc_type').val();

				} else {

					Ecc_type = 1;

				}


				if (($('#GammaParameter').val() >= 0.0 && $('#GammaParameter').val() <= 2.0) && $('#GammaParameter').val().length > 0) {

					GammaParameter = $('#GammaParameter').val();

				} else {

					GammaParameter = 0.00;

				}


				if ($('#EnergyCosPar').val() >= 0.01 && $('#EnergyCosPar').val() <= 0.1) {

					EnergyCosPar = $('#EnergyCosPar').val();

				} else {

					EnergyCosPar = 0.01;

				}




				if (($('#ProfitMarginParameter').val() >= 0 && $('#ProfitMarginParameter').val() <= 1.5) && $('#ProfitMarginParameter').val().length > 0) {



					ProfitMarginParameter = $('#ProfitMarginParameter').val();

				} else {


					ProfitMarginParameter = 0.1;

				}




				if (($('#number_of_clusters').val() >= 2 && $('#number_of_clusters').val() <= 10) && $('#number_of_clusters').val().length > 0) {



					number_of_clusters = $('#number_of_clusters').val();

				} else {


					number_of_clusters = 2;

				}


				// alert($('select#Interval').val());

				if (typeof startDate == 'undefined') {

					Materialize.toast('You havent select Date!', 4000, 'red rounded');
					return true;

				}

				if (typeof endDate == 'undefined') {

					Materialize.toast('You havent select end Date!', 4000, 'red rounded');
					return true;

				}



				$.ajax({
					type: "POST",
					url: "<? echo site_url('Analytics/loadData'); ?>",
					dataType: 'json',
					cache: false,
					data: {
						prosID:$("#Consumer_ids").val(),
						interval: interval,
						searchDateFrom: startDate.format('YYYY-MM-DD'), // startDate.format('DD-MM-YYYY'),
						searchDateTo: endDate.format('YYYY-MM-DD'), //endDate.format('DD-MM-YYYY'), //D MMMM YYYY
						macD: $.trim(macD),
						energyCosPar: $.trim(EnergyCosPar),
						profitMarginParameter: $.trim(ProfitMarginParameter),
						eccType: Ecc_type,
						flexibility_factor: Flexibility_factor,
						gammaParameter: GammaParameter,
						number_of_clusters: number_of_clusters,
						energyProgrmasIds: $('#EnergyProgrmasIds').val(),
						'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
					},
					beforeSend: function () {

						$(".overlay, .overlay2, .overlay3, .overlay4 .overlay5 .overlay6").show();

					},
					complete: function () {

						$(".overlay, .overlay2, .overlay3, .overlay4 .overlay5 .overlay6").hide();

					},
					success: function (msg) { //probably this request will return anything, it'll be put in var "data"

						var datasetDates_1 = msg.energy_cost_RTPNODRt;

						var datasetDates_1_RTPt = msg.energy_cost_RTPt;//Real-time pricing

						var datasetDates_1_PRTPt = msg.energy_cost_PRTPt; //Personal Real-time pricing

						var datasetDates_1_PRTPt_TiOfU = msg.energy_cost_RTPt_TiOfU;

						var datasetDates_1_RTPt_RTIPR = msg.energy_cost_RTPt_RTIPR;

						// alert(" energy_cost_RTPNODRt-- " + msg.energy_cost_RTPNODRt + " --energy_cost_RTPt-- " + msg.energy_cost_RTPt + " --energy_cost_PRTPt-- " + msg.energy_cost_PRTPt)


						if (typeof msg.energy_cost_RTPNODRt !== 'undefined') {

							datasetDates_1 = msg.energy_cost_RTPNODRt;
						} else if (typeof msg.energy_cost_RTPt !== 'undefined') {

							datasetDates_1 = msg.energy_cost_RTPt;//Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt !== 'undefined') {

							datasetDates_1 = msg.energy_cost_PRTPt;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_RTPt_TiOfU !== 'undefined') {

							datasetDates_1 = msg.energy_cost_RTPt_TiOfU;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_RTPt_RTIPR !== 'undefined') {

							datasetDates_1 = msg.energy_cost_RTPt_RTIPR;//Personal Real-time pricing

						}


						// alert("--datasetDates_1--" + datasetDates_1);



						var dataset_0 = msg.energy_cost_RTPNODRv;

						var dataset_1 = msg.energy_cost_RTPv;

						var dataset_2 = msg.energy_cost_PRTPv;

						var dataset_3 = msg.energy_cost_RTPv_TiOfU;

						var dataset_4 = msg.energy_cost_RTPv_RTIPR;


						var dataset_0Con;

						if (typeof dataset_0 == 'undefined') {

							dataset_0Con = {
								label: "",
								//borderColor: window.chartColors.red,
								// backgroundColor: window.chartColors.red,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-1",
							}


						} else {

							dataset_0Con = {
								label: "RTP (no DR)", //"Com Real-time pricing",//Com Real-time pricing --"RTP (no DR)"
								borderColor: window.chartColors.red,
								backgroundColor: window.chartColors.red,
								fill: false,
								data: dataset_0,
								yAxisID: "y-axis-1",
							}

						}


						var dataset_1Con;

						if (typeof dataset_1 == 'undefined') {

							dataset_1Con = {
								label: "",
								// borderColor: window.chartColors.green,
								// backgroundColor: window.chartColors.green,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}



						} else {


							dataset_1Con = {
								label: "Real-time pricing", ///RTP (no DR) -- "Real-time pricing"
								borderColor: window.chartColors.green,
								backgroundColor: window.chartColors.green,
								fill: false,
								data: dataset_1,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_2Con;

						if (typeof dataset_2 == 'undefined') {


							dataset_2Con = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_2Con = {
								label: "Per Real-time pricing", //"RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_2
								,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_3Con;

						if (typeof dataset_3 == 'undefined') {


							dataset_3Con = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_3Con = {
								label: "Time of Usage", //"RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_3
								,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_4Con;

						if (typeof dataset_4 == 'undefined') {


							dataset_4Con = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_4Con = {
								label: "Community Real-time pricing", //"RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_4
								,
								yAxisID: "y-axis-2"
							}

						}


						var datasetDates_1_wr = msg.energy_cost_RTPNODRt_wr; ///date user welfare


						if (typeof msg.energy_cost_RTPNODRt_wr !== 'undefined') {

							datasetDates_1_wr = msg.energy_cost_RTPNODRt_wr;
						} else if (typeof msg.energy_cost_RTPt_wr !== 'undefined') {

							datasetDates_1_wr = msg.energy_cost_RTPt_wr;//Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_wr !== 'undefined') {

							datasetDates_1_wr = msg.energy_cost_PRTPt_wr;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_TiOfU_wr !== 'undefined') {

							datasetDates_1_wr = msg.energy_cost_PRTPt_TiOfU_wr;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_RTIPR_wr !== 'undefined') {

							datasetDates_1_wr = msg.energy_cost_PRTPt_RTIPR_wr;//Personal Real-time pricing

						}


						var dataset_0_wr = msg.energy_cost_RTPNODRv_wr;

						var dataset_1_wr = msg.energy_cost_RTPv_wr;

						var dataset_2_wr = msg.energy_cost_PRTPv_wr;

						var dataset_3_wr = msg.energy_cost_PRTPv_TiOfU_wr;

						var dataset_4_wr = msg.energy_cost_PRTPv_RTIPR_wr;



						var datasetDates_1_rp = msg.energy_cost_RTPNODRt_rp;


						if (typeof msg.energy_cost_RTPNODRt_rp !== 'undefined') {

							datasetDates_1_rp = msg.energy_cost_RTPNODRt_rp;
						} else if (typeof msg.energy_cost_RTPt_rp !== 'undefined') {

							datasetDates_1_rp = msg.energy_cost_RTPt_rp;//Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_rp !== 'undefined') {

							datasetDates_1_rp = msg.energy_cost_PRTPt_rp;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_TiOfU_rp !== 'undefined') {

							datasetDates_1_rp = msg.energy_cost_PRTPt_TiOfU_rp;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_RTIPR_rp !== 'undefined') {

							datasetDates_1_rp = msg.energy_cost_PRTPt_RTIPR_rp;//Personal Real-time pricing

						}


						var dataset_0_rp = msg.energy_cost_RTPNODRv_rp;

						var dataset_1_rp = msg.energy_cost_RTPv_rp;

						var dataset_2_rp = msg.energy_cost_PRTPv_rp;

						var dataset_3_rp = msg.energy_cost_PRTPv_TiOfU_rp;

						var dataset_4_rp = msg.energy_cost_PRTPv_RTIPR_rp;



						var datasetDates_1_tw = msg.energy_cost_RTPNODRt_tw;

						if (typeof msg.energy_cost_RTPNODRt_tw !== 'undefined') {

							datasetDates_1_tw = msg.energy_cost_RTPNODRt_tw;
						} else if (typeof msg.energy_cost_RTPt_tw !== 'undefined') {

							datasetDates_1_tw = msg.energy_cost_RTPt_tw;//Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_tw !== 'undefined') {

							datasetDates_1_tw = msg.energy_cost_PRTPt_tw;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_TiOfU_tw !== 'undefined') {

							datasetDates_1_tw = msg.energy_cost_PRTPt_TiOfU_tw;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_RTIPR_tw !== 'undefined') {

							datasetDates_1_tw = msg.energy_cost_PRTPt_RTIPR_tw;//Personal Real-time pricing

						}



						var dataset_0_tw = msg.energy_cost_RTPNODRv_tw;

						var dataset_1_tw = msg.energy_cost_RTPv_tw;

						var dataset_2_tw = msg.energy_cost_PRTPv_tw;

						var dataset_3_tw = msg.energy_cost_PRTPv_TiOfU_tw;

						var dataset_4_tw = msg.energy_cost_PRTPv_RTIPR_tw;



////////////////////////////////////

						var datasetDates_1_tbill = msg.energy_cost_RTPNODRt_tbill;

						if (typeof msg.energy_cost_RTPNODRt_tbill !== 'undefined') {

							datasetDates_1_tbill = msg.energy_cost_RTPNODRt_tbill;
						} else if (typeof msg.energy_cost_RTPt_tbill !== 'undefined') {

							datasetDates_1_tbill = msg.energy_cost_RTPt_tbill;//Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_tbill !== 'undefined') {

							datasetDates_1_tbill = msg.energy_cost_PRTPt_tbill;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_TiOfU_tbill !== 'undefined') {

							datasetDates_1_tbill = msg.energy_cost_PRTPt_TiOfU_tbill;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_RTIPR_tbill !== 'undefined') {

							datasetDates_1_tbill = msg.energy_cost_PRTPt_RTIPR_tbill;//Personal Real-time pricing

						}



						var dataset_0_tbill = msg.energy_cost_RTPNODRv_tbill;

						var dataset_1_tbill = msg.energy_cost_RTPv_tbill;

						var dataset_2_tbill = msg.energy_cost_PRTPv_tbill;

						var dataset_3_tbill = msg.energy_cost_PRTPv_TiOfU_tbill;

						var dataset_4_tbill = msg.energy_cost_PRTPv_RTIPR_tbill;





						var datasetDates_1_tConsm = msg.energy_cost_RTPNODRt_tConsm;

						if (typeof msg.energy_cost_RTPNODRt_tConsm !== 'undefined') {

							datasetDates_1_tConsm = msg.energy_cost_RTPNODRt_tConsm;
						} else if (typeof msg.energy_cost_RTPt_tConsm !== 'undefined') {

							datasetDates_1_tConsm = msg.energy_cost_RTPt_tConsm;//Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_tConsm !== 'undefined') {

							datasetDates_1_tConsm = msg.energy_cost_PRTPt_tConsm;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_TiOfU_tConsm !== 'undefined') {

							datasetDates_1_tConsm = msg.energy_cost_PRTPt_TiOfU_tConsm;//Personal Real-time pricing

						} else if (typeof msg.energy_cost_PRTPt_RTIPR_tConsm !== 'undefined') {

							datasetDates_1_tConsm = msg.energy_cost_PRTPt_RTIPR_tConsm;//Personal Real-time pricing

						}



						var dataset_0_tConsm = msg.energy_cost_RTPNODRv_tConsm;

						var dataset_1_tConsm = msg.energy_cost_RTPv_tConsm;

						var dataset_2_tConsm = msg.energy_cost_PRTPv_tConsm;

						var dataset_3_tConsm = msg.energy_cost_PRTPv_TiOfU_tConsm;

						var dataset_4_tConsm = msg.energy_cost_PRTPv_RTIPR_tConsm;








						var lineChartData = {
							labels: datasetDates_1,
							datasets: [
								/*
								 {
								 label: "RTP (no DR)",
								 borderColor: window.chartColors.red,
								 backgroundColor: window.chartColors.red,
								 fill: false,
								 data:dataset_0,
								 yAxisID: "y-axis-1",
								 } */

								dataset_0Con

										,
								dataset_1Con
										/*
										 {
										 label: "Real-time pricing",
										 borderColor: window.chartColors.green,
										 backgroundColor: window.chartColors.green,
										 fill: false,
										 data: dataset_1
										 ,
										 yAxisID: "y-axis-2"
										 }
										 */

										,
								dataset_2Con
										/*
										 {
										 label: "Personal Real-time pricing",
										 borderColor: window.chartColors.blue,
										 backgroundColor: window.chartColors.blue,
										 fill: false,
										 data: dataset_2
										 ,
										 yAxisID: "y-axis-2"
										 }
										 */
										,
								dataset_3Con
										,
								dataset_4Con

							]
						};


						if (typeof window.myLine === 'object') {

							window.myLine.destroy();
						}

						window.myLine = Chart.Line(ctx, {
							data: lineChartData,
							options: {
								responsive: true,
								hoverMode: 'index',
								stacked: false,
								title: {
									display: true,
									text: 'Energy cost'
								},
								scales: {
									yAxes: [{
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "left",
											id: "y-axis-1",
										}, {
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "right",
											id: "y-axis-2",
											// grid line settings
											gridLines: {
												drawOnChartArea: false, // only want the grid lines for one axis to show up
											},
										}],
								}
							}
						});



						var dataset_0Con_wr;

						if (typeof dataset_0 == 'undefined') {

							dataset_0Con_wr = {
								label: "",
								//borderColor: window.chartColors.red,
								// backgroundColor: window.chartColors.red,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-1",
							}


						} else {

							dataset_0Con_wr = {
								label: "RTP (no DR)", //"Com Real-time pricing",//Com Real-time pricing --"RTP (no DR)"
								borderColor: window.chartColors.red,
								backgroundColor: window.chartColors.red,
								fill: false,
								data: dataset_0_wr,
								yAxisID: "y-axis-1",
							}

						}


						var dataset_1Con_wr;

						if (typeof dataset_1 == 'undefined') {

							dataset_1Con_wr = {
								label: "",
								// borderColor: window.chartColors.green,
								// backgroundColor: window.chartColors.green,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}



						} else {


							dataset_1Con_wr = {
								label: "Real-time pricing", ///RTP (no DR) -- "Real-time pricing"
								borderColor: window.chartColors.green,
								backgroundColor: window.chartColors.green,
								fill: false,
								data: dataset_1_wr,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_2Con_wr;

						if (typeof dataset_2 == 'undefined') {


							dataset_2Con_wr = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_2Con_wr = {
								label: "Per Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_2_wr
								,
								yAxisID: "y-axis-2"
							}


						}


						var dataset_3Con_wr;

						if (typeof dataset_3 == 'undefined') {


							dataset_3Con_wr = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_3Con_wr = {
								label: "Time of Usage", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_3_wr
								,
								yAxisID: "y-axis-2"
							}


						}


						var dataset_4Con_wr;

						if (typeof dataset_4 == 'undefined') {


							dataset_4Con_wr = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_4Con_wr = {
								label: "Community Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_4_wr
								,
								yAxisID: "y-axis-2"
							}


						}




						var lineChartData_1 = {
							labels: datasetDates_1_wr,
							datasets: [
								/*{
								 label: "RTP (no DR)",
								 borderColor: window.chartColors.red,
								 backgroundColor: window.chartColors.red,
								 fill: false,
								 data:
								 dataset_0_wr
								 ,
								 yAxisID: "y-axis-1",
								 }*/
								dataset_0Con_wr

										,
								/*{
								 label: "Real-time pricing",
								 borderColor: window.chartColors.green,
								 backgroundColor: window.chartColors.green,
								 fill: false,
								 data: dataset_1_wr
								 ,
								 yAxisID: "y-axis-2"
								 }*/
								dataset_1Con_wr
										,
								dataset_2Con_wr,
								dataset_3Con_wr,
								dataset_4Con_wr
										/*{
										 label: "Personal Real-time pricing",
										 borderColor: window.chartColors.blue,
										 backgroundColor: window.chartColors.blue,
										 fill: false,
										 data: dataset_2_wr
										 ,
										 yAxisID: "y-axis-2"
										 }*/



							]
						};


						if (typeof window.myLine2 === 'object') {

							window.myLine2.destroy();
						}

						window.myLine2 = Chart.Line(ctx2, {
							data: lineChartData_1,
							options: {
								responsive: true,
								hoverMode: 'index',
								stacked: false,
								title: {
									display: true,
									text: 'User Welfare'
								},
								scales: {
									yAxes: [{
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "left",
											id: "y-axis-1",
										}, {
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "right",
											id: "y-axis-2",
											// grid line settings
											gridLines: {
												drawOnChartArea: false, // only want the grid lines for one axis to show up
											},
										}],
								}
							}
						});



						var dataset_0Con_rp;

						if (typeof dataset_0 == 'undefined') {

							dataset_0Con_rp = {
								label: "",
								//borderColor: window.chartColors.red,
								// backgroundColor: window.chartColors.red,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-1",
							}


						} else {

							dataset_0Con_rp = {
								label: "RTP (no DR)", //"Com Real-time pricing",//Com Real-time pricing --"RTP (no DR)"
								borderColor: window.chartColors.red,
								backgroundColor: window.chartColors.red,
								fill: false,
								data: dataset_0_rp,
								yAxisID: "y-axis-1",
							}

						}


						var dataset_1Con_rp;

						if (typeof dataset_1 == 'undefined') {

							dataset_1Con_rp = {
								label: "",
								// borderColor: window.chartColors.green,
								// backgroundColor: window.chartColors.green,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}



						} else {


							dataset_1Con_rp = {
								label: "Real-time pricing", ///RTP (no DR) -- "Real-time pricing"
								borderColor: window.chartColors.green,
								backgroundColor: window.chartColors.green,
								fill: false,
								data: dataset_1_rp,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_2Con_rp;

						if (typeof dataset_2 == 'undefined') {


							dataset_2Con_rp = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_2Con_rp = {
								label: "Per Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_2_rp
								,
								yAxisID: "y-axis-2"
							}

						}


						var dataset_3Con_rp;

						if (typeof dataset_3 == 'undefined') {


							dataset_3Con_rp = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_3Con_rp = {
								label: "Time of Usage", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_3_rp
								,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_4Con_rp;

						if (typeof dataset_4 == 'undefined') {


							dataset_4Con_rp = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_4Con_rp = {
								label: "Community Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_4_rp
								,
								yAxisID: "y-axis-2"
							}

						}




						var lineChartData_2 = {
							labels: datasetDates_1_rp,
							datasets: [
								/* {
								 label: "RTP (no DR)",
								 borderColor: window.chartColors.red,
								 backgroundColor: window.chartColors.red,
								 fill: false,
								 data:
								 dataset_0_rp
								 ,
								 yAxisID: "y-axis-1",
								 }*/
								dataset_0Con_rp
										,
								/*{
								 label: "Real-time pricing",
								 borderColor: window.chartColors.green,
								 backgroundColor: window.chartColors.green,
								 fill: false,
								 data: dataset_1_rp
								 ,
								 yAxisID: "y-axis-2"
								 }*/
								dataset_1Con_rp
										,
								/* {
								 label: "Personal Real-time pricing",
								 borderColor: window.chartColors.blue,
								 backgroundColor: window.chartColors.blue,
								 fill: false,
								 data: dataset_2_rp
								 ,
								 yAxisID: "y-axis-2"
								 }*/
								dataset_2Con_rp,
								dataset_3Con_rp,
								dataset_4Con_rp


							]
						};


						if (typeof window.myLine3 === 'object') {

							window.myLine3.destroy();
						}


						window.myLine3 = Chart.Line(ctx3, {
							data: lineChartData_2,
							options: {
								responsive: true,
								hoverMode: 'index',
								stacked: false,
								title: {
									display: true,
									text: 'Retailer Profit'
								},
								scales: {
									yAxes: [{
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "left",
											id: "y-axis-1",
										}, {
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "right",
											id: "y-axis-2",
											// grid line settings
											gridLines: {
												drawOnChartArea: false, // only want the grid lines for one axis to show up
											},
										}],
								}
							}
						});



////from here tw
						var dataset_0Con_tw;

						if (typeof dataset_0 == 'undefined') {

							dataset_0Con_tw = {
								label: "",
								//borderColor: window.chartColors.red,
								// backgroundColor: window.chartColors.red,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-1",
							}


						} else {

							dataset_0Con_tw = {
								label: "RTP (no DR)", //"Com Real-time pricing",//Com Real-time pricing --"RTP (no DR)"
								borderColor: window.chartColors.red,
								backgroundColor: window.chartColors.red,
								fill: false,
								data: dataset_0_tw,
								yAxisID: "y-axis-1",
							}

						}


						var dataset_1Con_tw;

						if (typeof dataset_1 == 'undefined') {

							dataset_1Con_tw = {
								label: "",
								// borderColor: window.chartColors.green,
								// backgroundColor: window.chartColors.green,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}



						} else {


							dataset_1Con_tw = {
								label: "Real-time pricing", ///RTP (no DR) -- "Real-time pricing"
								borderColor: window.chartColors.green,
								backgroundColor: window.chartColors.green,
								fill: false,
								data: dataset_1_tw,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_2Con_tw;

						if (typeof dataset_2 == 'undefined') {


							dataset_2Con_tw = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_2Con_tw = {
								label: "Per Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_2_tw
								,
								yAxisID: "y-axis-2"
							}

						}


						var dataset_3Con_tw;

						if (typeof dataset_3 == 'undefined') {


							dataset_3Con_tw = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_3Con_tw = {
								label: "Time of Usage", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_3_tw
								,
								yAxisID: "y-axis-2"
							}

						}


						var dataset_4Con_tw;

						if (typeof dataset_4 == 'undefined') {


							dataset_4Con_tw = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_4Con_tw = {
								label: "Community Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_4_tw
								,
								yAxisID: "y-axis-2"
							}

						}




						var lineChartData_3 = {
							labels: datasetDates_1_tw,
							datasets: [
								/* {
								 label: "RTP (no DR)",
								 borderColor: window.chartColors.red,
								 backgroundColor: window.chartColors.red,
								 fill: false,
								 data:
								 dataset_0_tw
								 ,
								 yAxisID: "y-axis-1",
								 }*/
								dataset_0Con_tw
										, /*{
										 label: "Real-time pricing",
										 borderColor: window.chartColors.green,
										 backgroundColor: window.chartColors.green,
										 fill: false,
										 data: dataset_1_tw
										 ,
										 yAxisID: "y-axis-2"
										 }*/
								dataset_1Con_tw
										,
								dataset_2Con_tw,
								dataset_3Con_tw,
								dataset_4Con_tw

							]
						};

						if (typeof window.myLine4 === 'object') {

							window.myLine4.destroy();
						}

						window.myLine4 = Chart.Line(ctx4, {
							data: lineChartData_3,
							options: {
								responsive: true,
								hoverMode: 'index',
								stacked: false,
								title: {
									display: true,
									text: 'Total Welfare'
								},
								scales: {
									yAxes: [{
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "left",
											id: "y-axis-1",
										}, {
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "right",
											id: "y-axis-2",
											// grid line settings
											gridLines: {
												drawOnChartArea: false, // only want the grid lines for one axis to show up
											},
										}],
								}
							}
						});

///////////////////////apo edo -------------------
///////////////////////////////////////////////////

						var dataset_0Con_tbill;

						if (typeof dataset_0 == 'undefined') {

							dataset_0Con_tbill = {
								label: "",
								//borderColor: window.chartColors.red,
								// backgroundColor: window.chartColors.red,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-1",
							}


						} else {

							dataset_0Con_tbill = {
								label: "RTP (no DR)", //"Com Real-time pricing",//Com Real-time pricing --"RTP (no DR)"
								borderColor: window.chartColors.red,
								backgroundColor: window.chartColors.red,
								fill: false,
								data: dataset_0_tbill,
								yAxisID: "y-axis-1",
							}

						}


						var dataset_1Con_tbill;

						if (typeof dataset_1 == 'undefined') {

							dataset_1Con_tbill = {
								label: "",
								// borderColor: window.chartColors.green,
								// backgroundColor: window.chartColors.green,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}



						} else {


							dataset_1Con_tbill = {
								label: "Real-time pricing", ///RTP (no DR) -- "Real-time pricing"
								borderColor: window.chartColors.green,
								backgroundColor: window.chartColors.green,
								fill: false,
								data: dataset_1_tbill,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_2Con_tbill;

						if (typeof dataset_2 == 'undefined') {


							dataset_2Con_tbill = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_2Con_tbill = {
								label: "Per Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_2_tbill
								,
								yAxisID: "y-axis-2"
							}

						}


						var dataset_3Con_tbill;

						if (typeof dataset_3 == 'undefined') {


							dataset_3Con_tbill = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_3Con_tbill = {
								label: "Time of Usage", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_3_tbill
								,
								yAxisID: "y-axis-2"
							}

						}


						var dataset_4Con_tbill;

						if (typeof dataset_4 == 'undefined') {


							dataset_4Con_tbill = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_4Con_tbill = {
								label: "Community Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_4_tbill
								,
								yAxisID: "y-axis-2"
							}

						}




						var lineChartData_4 = {
							labels: datasetDates_1_tbill,
							datasets: [
								/* {
								 label: "RTP (no DR)",
								 borderColor: window.chartColors.red,
								 backgroundColor: window.chartColors.red,
								 fill: false,
								 data:
								 dataset_0_tw
								 ,
								 yAxisID: "y-axis-1",
								 }*/
								dataset_0Con_tbill
										, /*{
										 label: "Real-time pricing",
										 borderColor: window.chartColors.green,
										 backgroundColor: window.chartColors.green,
										 fill: false,
										 data: dataset_1_tw
										 ,
										 yAxisID: "y-axis-2"
										 }*/
								dataset_1Con_tbill
										,
								dataset_2Con_tbill,
								dataset_3Con_tbill,
								dataset_4Con_tbill

							]
						};

						if (typeof window.myLine5 === 'object') {

							window.myLine5.destroy();
						}

						window.myLine5 = Chart.Line(ctx5, {
							data: lineChartData_4,
							options: {
								responsive: true,
								hoverMode: 'index',
								stacked: false,
								title: {
									display: true,
									text: 'Total Bill'
								},
								scales: {
									yAxes: [{
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "left",
											id: "y-axis-1",
										}, {
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "right",
											id: "y-axis-2",
											// grid line settings
											gridLines: {
												drawOnChartArea: false, // only want the grid lines for one axis to show up
											},
										}],
								}
							}
						});

////////////totalco/////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

						var dataset_0Con_tConsm;

						if (typeof dataset_0 == 'undefined') {

							dataset_0Con_tConsm = {
								label: "",
								//borderColor: window.chartColors.red,
								// backgroundColor: window.chartColors.red,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-1",
							}


						} else {

							dataset_0Con_tConsm = {
								label: "RTP (no DR)", //"Com Real-time pricing",//Com Real-time pricing --"RTP (no DR)"
								borderColor: window.chartColors.red,
								backgroundColor: window.chartColors.red,
								fill: false,
								data: dataset_0_tConsm,
								yAxisID: "y-axis-1",
							}

						}


						var dataset_1Con_tConsm;

						if (typeof dataset_1 == 'undefined') {

							dataset_1Con_tConsm = {
								label: "",
								// borderColor: window.chartColors.green,
								// backgroundColor: window.chartColors.green,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}



						} else {


							dataset_1Con_tConsm = {
								label: "Real-time pricing", ///RTP (no DR) -- "Real-time pricing"
								borderColor: window.chartColors.green,
								backgroundColor: window.chartColors.green,
								fill: false,
								data: dataset_1_tConsm,
								yAxisID: "y-axis-2"
							}

						}



						var dataset_2Con_tConsm;

						if (typeof dataset_2 == 'undefined') {


							dataset_2Con_tConsm = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_2Con_tConsm = {
								label: "Per Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_2_tConsm
								,
								yAxisID: "y-axis-2"
							}

						}


						var dataset_3Con_tConsm;

						if (typeof dataset_3 == 'undefined') {


							dataset_3Con_tConsm = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_3Con_tConsm = {
								label: "Time of Usage", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_3_tConsm
								,
								yAxisID: "y-axis-2"
							}

						}


						var dataset_4Con_tConsm;

						if (typeof dataset_4 == 'undefined') {


							dataset_4Con_tConsm = {
								label: "",
								// borderColor: window.chartColors.blue,
								// backgroundColor: window.chartColors.blue,
								fill: false,
								data: '',
								hidden: true,
								yAxisID: "y-axis-2"
							}


						} else {

							dataset_4Con_tConsm = {
								label: "Community Real-time pricing", //"RTP (no DR)","RTP (no DR)",
								borderColor: window.chartColors.blue,
								backgroundColor: window.chartColors.blue,
								fill: false,
								data: dataset_4_tConsm
								,
								yAxisID: "y-axis-2"
							}

						}




						var lineChartData_5 = {
							labels: datasetDates_1_tConsm,
							datasets: [
								/* {
								 label: "RTP (no DR)",
								 borderColor: window.chartColors.red,
								 backgroundColor: window.chartColors.red,
								 fill: false,
								 data:
								 dataset_0_tw
								 ,
								 yAxisID: "y-axis-1",
								 }*/
								dataset_0Con_tConsm
										, /*{
										 label: "Real-time pricing",
										 borderColor: window.chartColors.green,
										 backgroundColor: window.chartColors.green,
										 fill: false,
										 data: dataset_1_tw
										 ,
										 yAxisID: "y-axis-2"
										 }*/
								dataset_1Con_tConsm
										,
								dataset_2Con_tConsm,
								dataset_3Con_tConsm,
								dataset_4Con_tConsm

							]
						};

						if (typeof window.myLine6 === 'object') {

							window.myLine6.destroy();
						}

						window.myLine6 = Chart.Line(ctx6, {
							data: lineChartData_5,
							options: {
								responsive: true,
								hoverMode: 'index',
								stacked: false,
								title: {
									display: true,
									text: 'Total Consumption'
								},
								scales: {
									yAxes: [{
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "left",
											id: "y-axis-1",
										}, {
											type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
											display: true,
											position: "right",
											id: "y-axis-2",
											// grid line settings
											gridLines: {
												drawOnChartArea: false, // only want the grid lines for one axis to show up
											},
										}],
								}
							}
						});





//////////////////////////////////////////////////////////////
//////////totalco/////////////////////////////////////////////





					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						$("#loaderID").css("display", "none");
						$("#message_print_2").css("display", "block").delay(5000).fadeOut('slow');

					}
				});


			});




			$.ajax({
				type: "POST",
				url: "<? echo site_url('UserPosition/sposition'); ?>",
				dataType: 'json',
				cache: false,
				data: {
					type_of_action: "click",
					action: "Analytics",
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
