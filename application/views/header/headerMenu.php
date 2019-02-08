


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
            <p class="navbar-brand" href="#">Tips: </p>  <span id="js-rotating" class="navbar-brand" style="word-wrap:break-word;max-width:1000px;height:50px;overflow-wrap:break-word;font-size:16px;"><?= implode(",", $ActiveTips); ?></span>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">

                <!--
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ti-panel"></i>
                        <p>Stats</p>
                    </a>
                </li>
                -->
				<li><a href="#"><i class="material-icons">view_agenda</i>Points:<?= isset($usrPlatfromCredits)?$usrPlatfromCredits:0;  ?></a></li>
				<li><a  href="#modalnrec2C" id="modalnrec2C"><i class="ti-bell"></i>
                <p class="notification"></p>Notifications</a></li>
				
				
				
				<!--
				 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#modalnrec2x">
                        <i class="ti-bell"></i>
                        <p class="notification">5</p>
                        <p>Notifications</p>
                    </a>
                 </li>
				-->

				<?php if ($usrlevel < 3) { ?>
	                <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                       <!-- <i class="ti-bell"></i> 
	                        <p class="notification">5</p>-->
	                        <p>Components</p>
	                        <b class="caret"></b>
	                    </a>
	                    <ul class="dropdown-menu">

	                        <li><a href="https://rat.socialenergy-project.eu/" target="_blank">RAT</a></li>
	                        <li><a href="https://socialenergy.it.fmi.uni-sofia.bg/" target="_blank">LCMS</a></li>
	                        <!--<li><a href="http://resources.nurogames.com/socialenergy/live" target="_blank">GAME</a></li> -->
							<!-- <li><a href="http://demo.nurogames.com/socialenergy/GameplayPrototype2018-08-20/" target="_blank">GAME</a></li> -->
							
							
							<li><a href="http://demo.nurogames.com/socialenergy/current/" target="_blank">GAME</a></li>
							
							<!--<li><a href="http://demo.nurogames.com/socialenergy/GameplayPrototype2018-09-13/" target="_blank">GAME</a></li> -->

	                        <li><a href="#">Another notification</a></li>
	                    </ul>
	                </li>
				<?php } ?> 
                <!--
                <li>
                    <a href="#">
                        <i class="ti-settings"></i>
                        <p id="setID">Settings</p>
						
                    </a>
					
                </li>
                -->
				<?php if ($usrlevel < 3) { ?>
	                <li><a class='dropdown-button ti-settings' href='#' data-activates='dropdown1'> Settings</a></li>
				<?php } ?>  
                <li>
					<?php
					$priUsr = isset($username) ? $username : '';

					echo anchor('login/logout', '
                                    <p>Log out ' . $priUsr . '</p>', 'class="link-class"')
					?>  

                </li>


            </ul>
			<?php if ($usrlevel < 3) { ?>
	            <ul id='dropdown1' class='dropdown-content'>
	                <li><a class="modal-trigger" href="#modal2">Create Group</a></li>
	                <li class="divider"></li>
	                <!-- <li><a class="modal-trigger" href="#modal1">Friends</a></li> -->

	                <li>
						<?php echo anchor('friends/index', '<i class="material-icons left">people</i>
                                <p>Friends</p>', 'class="link-class"') ?>
	                </li>


	                <li>
						<?php echo anchor('ffriends/index', '<i class="material-icons left">search</i>
                                <p>Locate Friends</p>', 'class="link-class"') ?>
	                </li> 


	                <li class="divider"></li>

	                <!--<li><a href="#!">Groups</a></li> --> 
	                <li>
						<?php echo anchor('groups/index', '<i class="material-icons left">view_comfy</i>
                                <p>Groups</p>', 'class="link-class"') ?>
	                </li>

	            </ul>
			<?php } ?>  


        </div>
    </div>
</nav>
