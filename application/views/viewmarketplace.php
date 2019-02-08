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


			#preview{
                height:180px;
                width:180px;
                text-align:center;
                margin:20px;
                display:none
            }
            .pre{
                margin-right:20px;
                font-size:13px
            }
            #previewimg{
                height:140px;
                width:140px;
                float:left;
                padding:8px;
                border:1px solid #e4d3c3;
                margin-bottom:5px
            }

            #deleteimg{

                cursor: pointer; 

            }



			#preview2{
                height:180px;
                width:180px;
                text-align:center;
                margin:20px;
                display:none
            }

            #previewimg2{
                height:140px;
                width:140px;
                float:left;
                padding:8px;
                border:1px solid #e4d3c3;
                margin-bottom:5px
            }

            #deleteimg2{

                cursor: pointer; 

            }

			#preview3{
                height:180px;
                width:180px;
                text-align:center;
                margin:20px;
                display:none
            }

            #previewimg3{
                height:140px;
                width:140px;
                float:left;
                padding:8px;
                border:1px solid #e4d3c3;
                margin-bottom:5px
            }

            #deleteimg3{

                cursor: pointer; 

            }



        </style>



    </head>
    <body>

        <!-- modal start  -->
		<?php $this->view('extra/plugin'); ?>
        <!-- modal end  -->

        <div id="modalReviewRecord" class="modal modal-fixed-footer" style="z-index:1000;">
			<?php echo form_open_multipart('Marketplace/proupd'); ?>
            <div class="modal-content" >
                <h4>Review - Update Product</h4>
                <p id="modalContent">A bunch of text</p>
                <form id="formIDS">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Product Title</label>

                                <input type="text" class="form-control" placeholder="Username" value="" id="Product_Title" name="Product_Title">

                            </div>
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Short Desc</label>
                                <textarea rows="5" class="form-control" placeholder="Product Short Desc"  id="Product_Short_Desc" name="Product_Short_Desc"></textarea>

                            </div>
                        </div>                               
                    </div>  


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Main Description</label>
                                <textarea rows="5" class="form-control" placeholder="Product Main Desc"  id="Product_Main_Desc" name="Product_Main_Desc"></textarea>

                            </div>
                        </div>                       
                    </div>   

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" placeholder="Product Price" value="" id="Product_Price" name="Product_Price">

                            </div>
                        </div>
                    </div>    



                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Main Category</label>
                                <input type="text" class="form-control" placeholder="Home Address" value="" id="Main_Category" name="Main_Category">

                            </div>
                        </div>
                    </div>   

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Category</label> 
                                <input type="text" class="form-control" placeholder="" value="" id="Sub_Category" name="Sub_Category">

                            </div>
                        </div>
                    </div>    


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Category Level 3</label> 
                                <input type="text" class="form-control" placeholder="" value="" id="Sub_Category3" name="Sub_Category3">

                            </div>
                        </div>
                    </div>  



                    <div class="row">
                        <div class="col-md-4">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Upload Image (1</span> 

                                    <input type="file" name="uploadImage_id1" id="uploadImage_id1" data-id="1">

                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                    <strong style="color:red;"><?= $printError = isset($errorUploadImage) ? $errorUploadImage : "" ?></strong>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <div id="preview">
                                <img id="previewimg" src=""><i class="small material-icons" id="deleteimg" data-img="" data-on="" data-rid="">close</i> <!--<img id="deleteimg" src="assets/img/delete.png"> -->
                                <span class="pre">IMAGE PREVIEW</span>
                            </div>

                        </div> 

                    </div>   



                    <div class="row">
                        <div class="col-md-4">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Upload Image (2</span>
                                    <input type="file" name="uploadImage_id2" id="uploadImage_id2" data-id="2">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                    <strong style="color:red;"><?= $printError = isset($errorUploadImage2) ? $errorUploadImage2 : "" ?></strong>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div id="preview2">
                                <img id="previewimg2" src=""><i class="small material-icons" id="deleteimg2" data-img="" data-on="" data-rid="">close</i> <!--<img id="deleteimg" src="assets/img/delete.png"> -->
                                <span class="pre">IMAGE PREVIEW</span>
                            </div>

                        </div>   
					</div>    



                    <div class="row">
                        <div class="col-md-4">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Upload Image (3</span>
                                    <input type="file" name="uploadImage_id3" id="uploadImage_id3" data-id="3">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">

                                </div>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <div id="preview3">
                                <img id="previewimg3" src=""><i class="small material-icons" id="deleteimg3" data-img="" data-on="" data-rid="">close</i> <!--<img id="deleteimg" src="assets/img/delete.png"> -->
                                <span class="pre">IMAGE PREVIEW</span>
                            </div>

                        </div>   
                    </div>





                </form>
            </div>
            <div class="modal-footer">
                <!--<a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a> -->

                <button type='submit' class='btn btn-info btn-fill  red darken-2 updateform' id='updateformID' data-id='' style=' margin-left:-65px;'>Update</button>



            </div>
		</form>
	</div>
	<!-- modal start  -->

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



					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="header">
										<h4 class="title">Market Place! - List Products</h4>
										<p class="category"></p>
									</div>
									<div class="content table-responsive table-full-width">
										<table class="table table-hover table-striped">
											<thead>
											<th>ID</th>
											<th>Product Title</th>
											<th>Price </th>
											<th>Main_Category</th>
											<th>Timestamp_Created</th>
											<th>Status </th>
											<th>Views </th>
											<th> </th>
											<th> </th>
											<th> </th>
											</thead>
											<tbody>

												<?php
												$size = 0;

												$size = sizeof($Product_Title);
//$print = isset($LastTimeLogin[$i]) ? $LastTimeLogin[$i] : "--"
												$ia = 0;
												for ($i = 0; $i < $size; $i++) {

													$ia = $i + 1;

													echo "<tr id='remRow$ProductID[$i]'>";
													echo "<td> " . $ia . " </td>";
													echo "<td>$Product_Title[$i] </td>";
													echo "<td>$Price[$i]</td>";
													echo "<td>$Main_Category[$i] </td>";
													//echo "<td> " . date("d/m/Y h:i:s", $timestamp_user_logged_in[$i]) . " </td>";
													echo "<td>" . $time = isset($Timestamp_Created[$i]) ? date("d/m/Y h:i:s", $Timestamp_Created[$i]) : " - " . " </td>";
													// echo "<td>$Timestamp_Created[$i] </td>";
													echo "<td><strong id='Sub$ProductID[$i]'>$StatusPro[$i]</strong> </td>";
													echo "<td> --- </td>";
													$button = $StatusPro[$i] == "Pending" ? "<button type='submit' class='btn btn-info btn-fill Upload$ProductID[$i] uploadID'  data-title='$Product_Title[$i]' data-id='$ProductID[$i]' data-status='2' style=' margin-left:-65px;'>Upload</button>" : "<button type='submit' class='btn btn-info btn-fill Upload$ProductID[$i] uploadID orange'  data-title='$Product_Title[$i]' data-id='$ProductID[$i]' data-status='1' style=' margin-left:-65px;='>Off Line</button>";
													//$Product_Main_Description  echo "<td> <button type='submit' class='btn btn-info btn-fill Upload$ProductID[$i] uploadID'  data-title='$Product_Title[$i]' data-id='$ProductID[$i]' style=' margin-left:-65px;'>Upload</button> </td>";
													echo "<td> $button </td>";
													echo "<td> <button type='submit' class='btn btn-info btn-fill reviewRec' id='previewID' "
													. "data-id='$ProductID[$i]' "
													. "data-title='$Product_Title[$i]' "
													. "data-proMnDes='$Product_Main_Description[$i]' "
													. "data-proShDes='$Product_Short_Desc[$i]' "
													. "data-price='$Price[$i]' "
													. "data-mainCategory='$Main_Category[$i]' "
													. "data-subCategory='$Sub_Category[$i]' "
													. "data-subCategory3='$Sub_Category_Level_3[$i]' "
													. "data-uploadPic='$Upload_Pic[$i]' "
													. "data-uploadPic2='$Upload_Pic_2[$i]' "
													. "data-uploadPic3='$Upload_Pic_3[$i]' "
													. "style=' margin-left:-65px;'>Preview</button> </td>";

													$pic = isset($Upload_Pic[$i]) && $Upload_Pic[$i] ? $Upload_Pic[$i] : "";
													$pic2 = isset($Upload_Pic_2[$i]) && $Upload_Pic_2[$i] ? $Upload_Pic_2[$i] : "";
													$pic3 = isset($Upload_Pic_3[$i]) && $Upload_Pic_3[$i] ? $Upload_Pic_3[$i] : "";
													echo "<td> <button type='submit' class='btn btn-info btn-fill remove$ProductID[$i] removeID red darken-2' id='removeID' data-pic='$pic' data-pic2='$pic2' data-pic3='$pic3' data-id='$ProductID[$i]' style=' margin-left:-65px;'>Remove</button> </td>";

													echo "</tr>";
												}
												?>
												<!--
																									<tr>
												
																										<td> 2 </td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																									</tr>
																									<tr>
												
																										<td> 3 </td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																									</tr>
																									<tr>
												
																										<td> 4 </td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																									</tr>
																									<tr>
												
																										<td> 5 </td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																									</tr>
																									<tr>
												
																										<td> 6 </td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																									</tr>
																									<tr>
												
																										<td> 7 </td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																										<td>---</td>
																									</tr>
												-->

											</tbody>
										</table>

									</div>
								</div>
							</div>
						</div>
					</div>

					<!--
				   <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>Drop Me!</a>
				
				   Dropdown Structure 
				  <ul id='dropdown1' class='dropdown-content'>
					<li><a href="#!">one</a></li>
					<li><a href="#!">two</a></li>
					<li class="divider" tabindex="-1"></li>
					<li><a href="#!">three</a></li>
					<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
					<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
				  </ul>
					-->         

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



	$(function () {
		$(":file").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				if ($(this).attr("data-id") == 1) {

					reader.onload = imageIsLoaded;

				} else if ($(this).attr("data-id") == 2) {

					reader.onload = imageIsLoaded2;

				} else if ($(this).attr("data-id") == 3) {

					reader.onload = imageIsLoaded3;

				}

				reader.readAsDataURL(this.files[0]);
			}
		});
	});

	function imageIsLoaded(e) {
		//$('#message').css("display", "none");
		$('#preview').css("display", "block");
		$('#previewimg').attr('src', e.target.result);
		//$('#deleteimg').attr("data-img", "");
	}


	function imageIsLoaded2(e) {
		//$('#message').css("display", "none");
		$('#preview2').css("display", "block");
		$('#previewimg2').attr('src', e.target.result);
		//$('#deleteimg2').attr("data-img", "");
	}


	function imageIsLoaded3(e) {
		//$('#message').css("display", "none");
		$('#preview3').css("display", "block");
		$('#previewimg3').attr('src', e.target.result);
		//$('#deleteimg3').attr("data-img", "");
	}

	// Function for Deleting Preview Image.
	$("#deleteimg").click(function () {
		$('#preview').css("display", "none");

		var imgName = $('#deleteimg').attr("data-img");

		var imgFlag = $('#deleteimg').attr("data-on");

		var prodID = $('#deleteimg').attr("data-rid");

		$.ajax({
			type: "POST",
			url: "<? echo site_url('Marketplace/dproupd'); ?>",
			dataType: 'json',
			cache: false,
			data: {
				imgName: imgName,
				imgFlag: imgFlag,
				prodID: prodID,
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


		$('#file').val("");
		$('#deleteimg').attr("data-img", "");
	});

	$("#deleteimg2").click(function () {
		$('#preview2').css("display", "none");
		$('#uploadImage_id2').val("");
		
		var imgName = $('#deleteimg2').attr("data-img");

		var imgFlag = $('#deleteimg2').attr("data-on");

		var prodID = $('#deleteimg2').attr("data-rid");

		$.ajax({
			type: "POST",
			url: "<? echo site_url('Marketplace/dproupd'); ?>",
			dataType: 'json',
			cache: false,
			data: {
				imgName: imgName,
				imgFlag: imgFlag,
				prodID: prodID,
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

		
		$('#deleteimg2').attr("data-img", "");

	});

	$("#deleteimg3").click(function () {
		$('#preview3').css("display", "none");
		$('#uploadImage_id3').val("");
		$('#deleteimg3').attr("data-img", "");
		
		var imgName = $('#deleteimg2').attr("data-img");

		var imgFlag = $('#deleteimg2').attr("data-on");

		var prodID = $('#deleteimg2').attr("data-rid");
		
			$.ajax({
			type: "POST",
			url: "<? echo site_url('Marketplace/dproupd'); ?>",
			dataType: 'json',
			cache: false,
			data: {
				imgName: imgName,
				imgFlag: imgFlag,
				prodID: prodID,
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

	$(function () {

		$('select').material_select();
		//$('.dropdown-trigger').dropdown();

		$('.modal').modal();

		$('.dropdown-button').dropdown({
			inDuration: 300,
			outDuration: 225,
			constrain_width: true,
			hover: false,
			gutter: 0,
			belowOrigin: false
		}
		);

		$('.button-collapse').sideNav({
			menuWidth: 300, // Default is 300
			edge: 'left', // Choose the horizontal origin
			closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
			draggable: true // Choose whether you can drag to open on touch screens
		}
		);

<?php
if (isset($newProductIntoSystem)) {
	echo "Materialize.toast('New Product added successfully!', 5000, 'green rounded');";
}
?>


		$.ajax({
			type: "POST",
			url: "<? echo site_url('UserPosition/sposition'); ?>",
			dataType: 'json',
			cache: false,
			data: {
				type_of_action: "click",
				action: "View User",
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

//insert_emoticon


	$('#updateformID').click(function () {

//alert($("#formIDS").serialize());
		var proID = $(this).attr("data-id");
		if (($('#uploadImage_id1')[0].files.length > 0)) {
			var pic = $('#uploadImage_id1')[0].files[0]['name'];
			$('#deleteimg').attr("data-img", pic);
			$('#deleteimg').attr("data-on", pic);
			$('#deleteimg').attr("data-rid", proID);
		}

		if (($('#uploadImage_id2')[0].files.length > 0)) {
			var pic2 = $('#uploadImage_id2')[0].files[0]['name'];
			$('#deleteimg2').attr("data-img", pic2);
			$('#deleteimg2').attr("data-on", pic2);
			$('#deleteimg2').attr("data-rid", proID);
		}

		if (($('#uploadImage_id3')[0].files.length > 0)) {
			var pic3 = $('#uploadImage_id3')[0].files[0]['name'];
			$('#deleteimg3').attr("data-img", pic3);
			$('#deleteimg3').attr("data-on", pic3);
			$('#deleteimg3').attr("data-rid", proID);
		}

//var formData = new FormData();
//formData.append('image', $('input[type=file]')[0].files[0]); 

//var pic1 = $('#uploadImage_id1')[0].files[0];
//alert("Pic  " + pic + " Pic2 "  +pic2 + " pic3 "  + pic3 + " proID " + proID);
		//  var inputFile=$('#uploadImage_id1');
		//  var fileToUpload=inputFile[0].files[0];
		// var formdata=new FormData();
		//   var other_data = $("#formIDS").serialize();
		// formdata.append(fileToUpload);
		//  formdata.append(other_data);

		var formData = new FormData();
		formData.append('Product_Title', $("#Product_Title").val());
		formData.append('Product_Short_Desc', $("#Product_Short_Desc").val());
		formData.append('Product_Main_Desc', $("#Product_Main_Desc").val());

		formData.append('Product_Price', $("#Product_Price").val());
		formData.append('Main_Category', $("#Main_Category").val());
		formData.append('Sub_Category', $("#Sub_Category").val());

		formData.append('Sub_Category3', $("#Sub_Category3").val());
		formData.append('proID', proID);

		formData.append('uploadImage_id1', $('#uploadImage_id1')[0].files[0]);
		formData.append('uploadImage_id2', $('#uploadImage_id2')[0].files[0]);
		formData.append('uploadImage_id3', $('#uploadImage_id3')[0].files[0]);

		$.ajax({
			type: "POST",
			url: "<? echo site_url('Marketplace/proupd'); ?>",
			dataType: 'json',
			cache: false,
			data: formData,
			contentType: false,
			processData: false,
			/*
			 data: {
			 type_of_action: "click",
			 pic1: formdata,
			 pic: pic,
			 pic2: pic2,
			 pic3: pic3,
			 proID: proID,
			 formSerialize: $("#formIDS").serialize(),
			 Product_Title:$("#Product_Title").val(),
			 Product_Short_Desc:$("#Product_Short_Desc").val(),
			 Product_Main_Desc:$("#Product_Main_Desc").val(),
			 Product_Price:$("#Product_Price").val(),
			 Main_Category:$("#Main_Category").val(),
			 Sub_Category:$("#Sub_Category").val(),
			 Sub_Category3:$("#Sub_Category3").val(),
			 'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
			 },
			 */


			beforeSend: function () {

				$(".overlay2").show();

			},
			complete: function () {

				$(".overlay2").hide();
			},
			success: function (msg) {

				//   $('.modal').modal('close');
				//  Materialize.toast(' Your leadership skills will be tested soon!<i class="material-icons left">insert_emoticon</i> ', 4000, 'green rounded');

			},
			error: function (jqXHR, textStatus, errorThrown)
			{


			}
		});


	});


	$('.reviewRec').click(function () {

		$('#modalReviewRecord').modal('open');

		$('#Product_Title').val($(this).attr("data-title"));

		$("textarea#Product_Short_Desc").html($(this).attr("data-proShDes"));

		$("textarea#Product_Main_Desc").html($(this).attr("data-proMnDes"));

		$('#Product_Price').val($(this).attr("data-price"));

		$('#Main_Category').val($(this).attr("data-mainCategory"));

		$('#Sub_Category').val($(this).attr("data-subCategory"));

		$('#updateformID').val($(this).attr("data-subCategory3"));

		$('#updateformID').attr("data-id", $(this).attr("data-id"));

		$('#Sub_Category3').val($(this).attr("data-subCategory3"));


		if ($(this).attr("data-uploadPic").length > 3) {

			$('#preview').css("display", "block");

			$('#previewimg').attr('src', '../../thum/' + $(this).attr("data-uploadPic"));

			$('#deleteimg').attr("data-img", $(this).attr("data-uploadPic"));

			$('#deleteimg').attr("data-on", $(this).attr("data-uploadPic"));

			$('#deleteimg').attr("data-rid", $(this).attr("data-id"));

		}

		if ($(this).attr("data-uploadPic2").length > 3) {

			$('#preview2').css("display", "block");

			$('#previewimg2').attr('src', '../../thum/' + $(this).attr("data-uploadPic2"));

			$('#deleteimg2').attr("data-img", $(this).attr("data-uploadPic2"));

			$('#deleteimg2').attr("data-on", $(this).attr("data-uploadPic2"));

			$('#deleteimg2').attr("data-rid", $(this).attr("data-id"));

		}

		if ($(this).attr("data-uploadPic3").length > 3) {

			$('#preview3').css("display", "block");

			$('#previewimg3').attr('src', '../../thum/' + $(this).attr("data-uploadPic3"));

			$('#deleteimg3').attr("data-img", $(this).attr("data-uploadPic3"));

			$('#deleteimg3').attr("data-on", $(this).attr("data-uploadPic3"));

			$('#deleteimg3').attr("data-rid", $(this).attr("data-id"));

		}


	});



	$('#yprod').click(function () {

		$.ajax({
			type: "POST",
			url: "<? echo site_url('Cocialnetwork/reqleaces'); ?>",
			dataType: 'json',
			cache: false,
			data: {
				type_of_action: "click",
				action: "View User",
				proID: $(this).attr("data-id"),
				'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
			},
			beforeSend: function () {

				$(".overlay2").show();

			},
			complete: function () {

				$(".overlay2").hide();
			},
			success: function (msg) {

				$('.modal').modal('close');
				Materialize.toast(' Your leadership skills will be tested soon!<i class="material-icons left">insert_emoticon</i> ', 4000, 'green rounded');


			},
			error: function (jqXHR, textStatus, errorThrown)
			{


			}
		});


	});



	$('#tmrc').click(function () {

		$('.modal').modal('close');

		Materialize.toast(' You can always try later!<i class="material-icons left">insert_emoticon</i> ', 4000, 'blue rounded');

	});

	$('.removeID').click(function () {

		var thisC = $(this);

		$.ajax({
			type: "POST",
			url: "<? echo site_url('Marketplace/reprod'); ?>",
			dataType: 'json',
			cache: false,
			data: {
				type_of_action: "click",
				action: "View Marketplace",
				pic: $(this).attr("data-pic"),
				pic2: $(this).attr("data-pic2"),
				pic3: $(this).attr("data-pic3"),
				proID: $(this).attr("data-id"),
				'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
			},
			beforeSend: function () {

				$(".overlay2").show();

			},
			complete: function () {

				$(".overlay2").hide();
			},
			success: function (msg) {

				if (msg.post == 1) {
					// $('#Sub' + thisC.attr("data-id")).text("On AIR");
					// thisC.html('Off Line');
					// thisC.attr('data-status', '1');
					$('#remRow' + thisC.attr("data-id")).remove();

					Materialize.toast('Product (' + thisC.attr("data-title") + ') deleted succesfully!', 4000, 'green rounded');
				} else {
					//  $('#Sub' + thisC.attr("data-id")).text("Pending");
					//  thisC.html('Upload');
					//  thisC.attr('data-status', '2');
					Materialize.toast('Please try again later!', 4000, 'blue rounded');
				}

			},
			error: function (jqXHR, textStatus, errorThrown)
			{


			}
		});

	});

	$('.uploadID').click(function () {


		// $('input[type="text"]').attr('data-parentID', 'newvalue');
		var thisC = $(this);
		var dataStatus = $(this).attr("data-status");

		$.ajax({
			type: "POST",
			url: "<? echo site_url('Marketplace/upprod'); ?>",
			dataType: 'json',
			cache: false,
			data: {
				type_of_action: "click",
				action: "View User",
				proID: $(this).attr("data-id"),
				proSTA: dataStatus,
				'csrf_test_name': "<? echo $this->security->get_csrf_hash(); ?>"
			},
			beforeSend: function () {
				$(".overlay2").show();


			},
			complete: function () {

				$(".overlay2").hide();
			},
			success: function (msg) {

				if (dataStatus == 2) {
					$('#Sub' + thisC.attr("data-id")).text("On AIR");
					thisC.html('Off Line');
					thisC.attr('data-status', '1');
					Materialize.toast('Product (' + thisC.attr("data-title") + ') is on air!', 4000, 'green rounded');
				} else {
					$('#Sub' + thisC.attr("data-id")).text("Pending");
					thisC.html('Upload');
					thisC.attr('data-status', '2');
					Materialize.toast('Product (' + thisC.attr("data-title") + ') is off air!', 4000, 'green rounded');
				}

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
