<?php 
    session_start();
    if(isset($_SESSION['user']))
    {
?>
<header class="header-content">
    <h2>
       <label for="">
              <span class="menu-btn las la-tasks"></span>
       </label>
    </h2>
    
    <div class="cards-single">
         <span>Coffee Shop</span>
    </div>
    
    <div class="user-wrapper">
        <div class="user-img">
            <img src="/admincoffee/assets/img/user.png" class="user-img__src" alt="">
            <div class="user-menu">
				<ul class="user-menu__list">
					<li class="user-menu__item">
						<a href="/admincoffee/loginadmin/loginadmin.php" class="user-menu__link">Đăng xuất</a>
					</li>
				</ul>
			</div>
        </div>
        <div class="user-info">
            <h4><?php echo $_SESSION['user']; ?></h4>
            <small><?php echo $_SESSION['level']; ?></small>
        </div>
    </div>
 </header>
 <?php
    }
    else
        header('Location: /admincoffee/loginadmin/loginadmin.php');
 ?>