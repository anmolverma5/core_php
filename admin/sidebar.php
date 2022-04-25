   <div uk-sticky class="uk-navbar-container tm-navbar-container uk-active">
       <div class="uk-container uk-container-expand">
           <nav uk-navbar>
               <div class="uk-navbar-left">
                   <a id="sidebar_toggle" class="uk-navbar-toggle" uk-navbar-toggle-icon></a>
                   <a href="#" class="uk-navbar-item uk-logo">
                       BPS SECURITY
                   </a>
               </div>
               <?php include('navmenu.php'); ?>
           </nav>
       </div>
   </div>

   <div id="sidebar" class="tm-sidebar-left uk-background-default">
       <center>
           <div class="user">
               <img id="avatar" width="100" class="uk-border-circle" src="assets/images/avatar.jpg" />
               <div class="uk-margin-top"></div>
               <div id="name" class="uk-text-truncate">Admin</div>
               <!--                     <div id="email" class="uk-text-truncate">ConsoleTVs@gmail.com</div> -->
               <!--                     <span id="status" data-enabled="true" data-online-text="Online" data-away-text="Away" data-interval="10000" class="uk-margin-top uk-label uk-label-success"></span> -->
           </div>
           <br />
       </center>
       <ul class="uk-nav uk-nav-default">

           <li class="uk-nav-header">
               Sections
           </li>
           <li><a href="index.php">Dashboard</a></li>
           <li><a href="images.php">IMAGES</a></li>
           <i><a href="add-article.php">Upcoming Activity</a></i><br>
           </li><i><a href="feature_post.php">Upcoming Activity Edit</a></i></li>






       </ul>
   </div>