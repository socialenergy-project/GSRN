


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <!-- <a class="navbar-brand" href="#">Table List</a> -->
            <p class="navbar-brand" href="#">Tips: </p>  <span id="js-rotating" class="navbar-brand"><?= implode(",", $ActiveTips); ?></span>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>

<!-- <a href="#" class="tooltipped" data-tooltip="Click to see products of your basket"> <i class="small material-icons">shopping_cart</i></a> -->

					<?php echo anchor('basketitems/index', '<i class="small material-icons cart">shopping_cart</i>', array('class' => 'tooltipped', 'data-tooltip' => 'Click to see products of your basket')) ?>

                </li>

                <!--
                <li>
                    <a href="#">
                        <i class="ti-settings"></i>
                        <p id="setID">Settings</p>
						
                    </a>
					
                </li>
                -->
				<?php if ($usrlevel !== 3) { ?>
					
	                <li><a class='dropdown-button ti-settings' href='#' data-activates='dropdown1'> Settings</a></li>

				<?php } ?>    

                <li>

					<?php echo anchor('login/logout', '
                                    <p>Log out</p>', 'class="link-class"') ?>  

                </li>


            </ul>

			<?php if ($usrlevel !== 3) {
				?>

	            <ul id='dropdown1' class='dropdown-content'>
	                <li><a class="modal-trigger" href="#modal2">Create Group</a></li>
	                <li class="divider"></li>
	                <li><a class="modal-trigger" href="#modal1">Friends</a></li>
	                <li class="divider"></li>
	                <li><a href="#!">Groups</a></li>
	            </ul>

<?php } ?>  


        </div>
    </div>
</nav>
