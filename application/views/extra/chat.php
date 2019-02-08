   <ul class="side-nav white darken-2" id="mobile-demo" >
         <li class="sidenav-header blue">
          <div class="row">
            <div class="col s4">Username:
               <!-- <img src="https://gravatar.com/avatar/961997eb7fd5c22b3e12fb3c8ca14e11?s=80&d=https://codepen.io/assets/avatars/user-avatar-80x80-bdcd44a3bfb9a5fd01eb8b86f9e033fa1a9897c3a15b33adfc2649a002dab1b6.png" width="48px" height="48px" alt="" class="circle responsive-img valign profile-image"> -->
            </div>
            <div class="col s8">
                <a class="btn-flat dropdown-button waves-effect waves-light white-text" href="#" data-activates="profile-dropdown"> <?= $username ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                <ul id="profile-dropdown" class="dropdown-content">
                    <li><a href="#"><i class="material-icons">person</i>Profile</a></li>
                    <li><a href="#"><i class="material-icons">settings</i>Setting</a></li>
                    <li><a href="#"><i class="material-icons">help</i>Help</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="material-icons">lock</i>Lock</a></li>
                    <li><a href="#"><i class="material-icons">exit_to_app</i>Logout</a></li>
                </ul>
            </div>
          </div>
        </li>
        
        <li class="blue">
          <ul class="collapsible collapsible-accordion">
              <li>
                <a class="collapsible-header white-text waves-effect waves-blue "><i class="material-icons white-text ">chat</i>Chat with.. <i class="material-icons right white-text" style="margin-right:0;">arrow_drop_down</i></a>
                <div class="collapsible-body z-depth-3">
                  <ul>
                      
                      <?php
                      
                      $max = 0;
                      $max = sizeof($AdminNameX);
                      $rowData = [];
                      $rowData2 = [];
                      if($max>0){
                     $rowData= array_unique(array_merge($AdminNameX,$UserNameX));
                     // var_dump($UserNameX);
                     }
                      
                  
                      
                          
                       foreach ($rowData as $value){
                           
                           
                           if(isset($value)){
                               
                            $rowData2[] =  $value;  
                               
                           } 
                       }
                      
                        $max = sizeof($rowData2);
                       
                      for($i=0;$i<$max;$i++){
                          if($username !=$rowData2[$i] && $rowData2[$i]){
                          echo "<li><a class='waves-effect waves-blue' href=\"javascript:void(0)\" onclick=\"javascript:chatWith('$rowData2[$i]')\">Chat With $rowData2[$i] </a></li>";
                      }elseif($username ==$rowData2[$i] && $max == 1){
                          
                         echo "<li>No People to chat with.</li>";  
                          
                      }
                      }
                      
                      if($max < 1){
                          
                       echo "<li>No People to chat with.</li>";   
                          
                      }
                      
                      ?>
                     
                      
                                      
                    
                    <li><div class="divider"></div></li>
                  </ul>
                </div>
              </li>
          </ul>
        </li>
        
        
     
        
        
        <li class="sidenav-footer grey darken-2">
          <div class="row">  
              <!--
            <div class="social-icons">
              <div class="col s2">
                <a href="#"><i class="fa fa-lg fa-linkedin-square"></a></i>
              </div>
              <div class="col s2">
                <a href="#"><i class="fa fa-lg fa-facebook-official"></a></i>
              </div>
              <div class="col s2">
                <a href="#"><i class="fa fa-lg fa-twitter"></a></i>
              </div>
              <div class="col s2">
                <a href="#"><i class="fa fa-lg fa-google-plus"></a></i>
              </div>
              <div class="col s2">
                <a href="#"><i class="fa fa-lg fa-pinterest"></a></i>
              </div>
              <div class="col s2">
                <a href="#"><i class="fa fa-lg fa-youtube"></a></i>
              </div>
            </div>
              -->
              
          </div>
        </li>
      </ul>