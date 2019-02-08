<!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
-->

<div class="sidebar-wrapper">
    <div class="logo">
        <a href="#" class="simple-text">
            Social Energy
        </a>
    </div>

    <ul class="nav">

        <!--
         <li>
             <a href="dashboard.html">
                 <i class="ti-panel"></i>
                 <p>Dashboard</p>
             </a>
         </li>
        -->




		<?php
		//echo '<li><a  href="#modalnrec2C" id="modalnrec2C"><i class="ti-bell"></i><p class="notification"></p>Notifications</a></li>';

		//echo "----".$usrlevel;
		
		if ($usrlevel < 3) {

			echo "<li>";
			echo '<a href="#" data-activates="mobile-demo" class="button-collapse show-on-large tooltipped" data-position="bottom" data-tooltip="Click to Chat"><i class="material-icons">chat</i></a>';
			echo "</li>";
		}



		if ($usrlevel <3) {
			if (isset($Dashboard2)) {
				echo " <li class='active'>";
			} else {
				echo " <li>";
			}
			?>

			<?php
			echo anchor('dasboard/index', '<i class="ti-panel"></i>
                                <p>Dashboard</p>', 'class="link-class"');
		}
		?>
        </li>


<?php
if ($usrlevel <3) {
	if ($usrlevel != 1) {
		if (isset($EnergyCom) && ($EnergyCom === "Enable")) {

			if (isset($EnergyProfile)) {
				echo " <li class='active'>";
			} else {
				echo " <li>";
			}
			?>

					<?php echo anchor('options/index/id/0', '<i class="material-icons left">graphic_eq</i></i>
                                <p>My energy profile</p>', 'class="link-class"') ?>
					</li>

			<?php
		}
	} elseif ($usrlevel == 1) {


		if (isset($EnergyProfile)) {
			echo " <li class='active'>";
		} else {
			echo " <li>";
		}
		?>

				<?php echo anchor('options/index/id/0', '<i class="material-icons left">graphic_eq</i></i>
                                <p>My energy profile</p>', 'class="link-class"') ?>
				</li>

		<?php
	}
}
if ($usrlevel <3) {
	if ($usrlevel != 1) {


		if (isset($Analytics) && ($Analytics === "Enable")) {

			if (isset($Analyticsp)) {
				echo " <li class='active'>";
			} else {
				echo " <li>";
			}
			?>

					<?php echo anchor('analytics/index', '<i class="material-icons left">reorder</i>
                                <p>Analytics</p>', 'class="link-class"') ?>
			        </li>


					<?php
				}
			} elseif ($usrlevel == 1) {

				if (isset($Analytics)) {
					echo " <li class='active'>";
				} else {
					echo " <li>";
				}
				?>

				<?php echo anchor('analytics/index', '<i class="material-icons left">reorder</i>
                                <p>Analytics</p>', 'class="link-class"') ?>
		        </li>


				<?php
			}
		}


		if (isset($AddUser)) {
			echo " <li class='active'>";
		} else {
			echo " <li>";
		}
		?>

		<?php
		if ($usrlevel == 1) {


			echo anchor('adduser/index', '<i class="material-icons left">add</i>
                                <p>Add User</p>', 'class="link-class"')
			?>
			</li>


			<?php
			if (isset($ViewUser)) {
				echo " <li class='active'>";
			} else {
				echo " <li>";
			}
			?>
			<?php echo anchor('viewusers/index', '<i class="material-icons left">view_week</i>
                                <p>View User</p>', 'class="link-class"') ?>

			</li>

	<?php
}
?>


		<?php
		if ($usrlevel <3) {
			if ($usrlevel != 1) {

				if (isset($LcmsCom) && ($LcmsCom === "Enable")) {

					if (isset($LcmsProfile)) {
						echo " <li class='active'>";
					} else {
						echo " <li>";
					}
					?>
			<?php echo anchor('Lcmsprofile/index', '<i class="material-icons left">view_module</i>
                                <p>LCMS PROFILE</p>', 'class="link-class"') ?>
					</li>


					<?php
				}
			} elseif ($usrlevel == 1) {


				if (isset($LcmsProfile)) {
					echo " <li class='active'>";
				} else {
					echo " <li>";
				}
				?>
		<?php echo anchor('Lcmsprofile/index', '<i class="material-icons left">view_module</i>
                                <p>LCMS PROFILE</p>', 'class="link-class"') ?>
				</li>


				<?php
			}
		}

		if ($usrlevel <3) {
			if ($usrlevel != 1) {

				if (isset($GameCom) && ($GameCom === "Enable")) {

					if (isset($GameProfile)) {
						echo " <li class='active'>";
					} else {
						echo " <li>";
					}
					?>
					<?php echo anchor('options/index/id/2', '<i class="material-icons left">view_module</i>
                                <p>GAME PROFILE</p>', 'class="link-class"') ?>
					</li>


					<?php
				}
			} elseif ($usrlevel == 1) {


				if (isset($GameProfile)) {
					echo " <li class='active'>";
				} else {
					echo " <li>";
				}
				?>
				<?php echo anchor('options/index/id/2', '<i class="material-icons left">view_module</i>
                                <p>GAME PROFILE</p>', 'class="link-class"') ?>
				</li>


		<?php
	}
}

if ($usrlevel == 1) {


	if (isset($Recommendations)) {
		echo " <li class='active'>";
	} else {
		echo " <li>";
	}
	?>
			<?php echo anchor('Recommendations/index', '<i class="material-icons left">add</i>
                                <p>Notifications</p>', 'class="link-class"') ?>
			</li>

	<?php
	if (isset($RecommendationsList)) {
		echo " <li class='active'>";
	} else {
		echo " <li>";
	}
	?>
			<?php echo anchor('Recommendationslist/index', '<i class="material-icons left">view_list</i>
                                <p>Notifications list</p>', 'class="link-class"') ?>
			</li>


			<?php
		}


		if ($usrlevel == 1 || $usrlevel == 3 ) {

			if (isset($AddProductMyMarketPlce)) {
				echo " <li class='active'>";
			} else {
				echo " <li>";
			}
			?>
			<?php echo anchor('addpromymarketp/index', '<i class="material-icons left">add</i>
                                <p>Add product</p>', 'class="link-class"') ?>

			</li>



	<?php
	if (isset($ViewMarketplace)) {
		echo " <li class='active'>";
	} else {
		echo " <li>";
	}
	
	
	if(isset($userIdSession)){
		
		echo anchor('marketplace/index/'.$userIdSession.'', '<i class="material-icons left">view_module</i>
                                <p>Marketplace</p>', 'class="link-class"');
		
		
		
	}else{
		
		echo anchor('marketplace/index', '<i class="material-icons left">view_module</i>
                                <p>Marketplace</p>', 'class="link-class"');
		
	}
	
	
	
	?>
			

			</li>


			<?php
		}
	
			if ($usrlevel != 1) {

				if (isset($MarketPlaCom) && ($MarketPlaCom === "Enable")) {
					if (isset($ViewMarketplaceStore)) {
						echo " <li class='active'>";
					} else {
						echo " <li>";
					}
					if(isset($userIdSession)){
						
						
						 echo anchor('marketplacestore/index/'.$userIdSession.'', '<i class="material-icons left">view_compact</i>
                                <p>Marketplace Store</p>', 'class="link-class"');
						
					}else{
						
						echo anchor('marketplacestore/index/', '<i class="material-icons left">view_compact</i>
                                <p>Marketplace Store</p>', 'class="link-class"');
						
					}
					
					
					
					?>
					

					</li>

					<?php
				}
			} elseif ($usrlevel == 1) {

				if (isset($MarketPlaCom) && ($MarketPlaCom === "Enable")) {
					if (isset($ViewMarketplaceStore)) {
						echo " <li class='active'>";
					} else {
						echo " <li>";
					}
					?>
					<?php echo anchor('marketplacestore/index', '<i class="material-icons left">view_compact</i>
                                <p>Marketplace Store</p>', 'class="link-class"') ?>

					</li>

					<?php
				}
			}
		
		//if ($usrlevel !== 3) {
			
			
			if ($usrlevel == 1) {


				if (isset($OrderStatusStoreA)) {
					echo " <li class='active'>";
				} else {
					echo " <li>";
				}

				echo anchor('marketplaceorderstatus2/index', '<i class="material-icons left">view_module</i>
                                <p>Order Status</p>', 'class="link-class"');

				echo "</li>";






				if (isset($Componets)) {
					echo " <li class='active'>";
				} else {
					echo " <li>";
				}

				echo anchor('modulesAvailability/index', '<i class="material-icons left">view_module</i>
                                <p>Modules</p>', 'class="link-class"');

				echo "</li>";
			} else {


if (isset($MarketPlaCom) && ($MarketPlaCom === "Enable")) {
				if (isset($OrderStatusStore)) {
					echo " <li class='active'>";
				} else {
					echo " <li>";
				}
				?>
				<?php echo anchor('marketplaceorderstatus/index', '<i class="material-icons left">view_module</i>
                                <p>Order Status</p>', 'class="link-class"') ?>

				</li>

				<?php
			}
			}
		//}
		?>


		<?php
		if ($usrlevel == 1) {


			if (isset($AdminGroups)) {
				echo " <li class='active'>";
			} else {
				echo " <li>";
			}
			?>

			<?php echo anchor('adminusergroups/index', '<i class="material-icons left">view_list</i>
                                <p>Admin Groups</p>', 'class="link-class"') ?>

			</li>


	<?php
}

?>

	
			
			
        <!--
  
          <li>
              <a href="typography.html">
                  <i class="ti-text"></i>
                  <p>Typography</p>
              </a>
          </li>
          <li>
              <a href="icons.html">
                  <i class="ti-pencil-alt2"></i>
                  <p>Icons</p>
              </a>
          </li>
          <li>
              <a href="maps.html">
                  <i class="ti-map"></i>
                  <p>Maps</p>
              </a>
          </li>
          <li>
              <a href="notifications.html">
                  <i class="ti-bell"></i>
                  <p>Notifications</p>
              </a>
          </li>
  
		  
        -->

        <!--
        <li class="active-pro">
            <a href="upgrade.html">
                <i class="ti-export"></i>
                <p>Upgrade to PRO</p>
            </a>
        </li>
        -->


    </ul>
</div>



