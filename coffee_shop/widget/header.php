<div id="header">
    <div class="grid wide">
		<div class="row navbar">
			<div class="navbar-menu">
				<ul class="navbar-menu__list">
					<li class="navbar-menu__list-item">
						<a href="/coffee_shop/index.php" class="navbar-menu__list-link">TRANG CHỦ</a>
					</li>
					<li class="navbar-menu__list-item">
						<a href="/coffee_shop/index.php#about" class="navbar-menu__list-link">GIỚI THIỆU</a>
					</li>
					<li class="navbar-menu__list-item">
						<a href="/coffee_shop/widget/menu.php" class="navbar-menu__list-link">MENU</a>
					</li>
					<li class="navbar-menu__list-item">
						<a href="#contact" class="navbar-menu__list-link">LIÊN HỆ</a>
					</li>
				</ul>
			</div>
			<label class="sidebar">
				<i class="sidebar__icon fas fa-bars"></i>
			</label>
			<div class="overlay overlay-sidebar">
				<div class="sidebar-menu">
					<div class="sidebar-menu__title">Coffee shop</div>
					<ul class="sidebar-menu__list">
						<li class="sidebar-menu__item">
							<a href="/coffee_shop/index.php" class="sidebar-menu__link">
								<div class="sidebar-icon">
									<i class="sidebar-icon__link fas fa-home"></i>
								</div>
								TRANG CHỦ
							</a>
						</li>
						<li class="sidebar-menu__item">
							<a href="/coffee_shop/index.php#about" class="sidebar-menu__link">
								<div class="sidebar-icon">
									<i class="sidebar-icon__link fas fa-info"></i>
								</div>
								GIỚI THIỆU
							</a>
						</li>
						<li class="sidebar-menu__item">
							<a href="/coffee_shop/widget/menu.php" class="sidebar-menu__link">
								<div class="sidebar-icon">
									<i class="sidebar-icon__link fas fa-coffee"></i>
								</div>
								MENU
							</a>
						</li>
						<li class="sidebar-menu__item">
							<a href="#contact" class="sidebar-menu__link">
								<div class="sidebar-icon">
									<i class="sidebar-icon__link fas fa-phone"></i>
								</div>
								LIÊN HỆ
							</a>
						</li>
						<hr style="margin: 4px 20px; border: 1px solid #c3afaf;">
					</ul>
					<div class="account-action">
						<div class="sidebar-menu__item">
							<a href="/coffee_shop/widget/order/order.php" class="sidebar-menu__link">
								<div class="sidebar-icon">
									<i class="sidebar-icon__link fas fa-list"></i>
								</div>
								ĐƠN HÀNG
							</a>
						</div>
						<div class="sidebar-menu__item">
							<a href="/coffee_shop/widget/logout.php" class="sidebar-menu__link">
								<div class="sidebar-icon">
									<i class="sidebar-icon__link fas fa-sign-out"></i>
								</div>
								ĐĂNG XUẤT
							</a>
						</div>
						<hr style="margin: 4px 20px; border: 1px solid #c3afaf;">
					</div>
				</div>
			</div>
			<div class="navbar-login">
				<?php
					if((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
						echo '
							<div class="navbar-login__link">
								<i class="fas fa-user-circle"></i>
								<div class="user-menu">
									<ul class="user-menu__list">
										<li class="user-menu__item">
											<a href="/coffee_shop/widget/order/order.php" class="user-menu__link">Xem đơn hàng</a>
										</li>
										<li class="user-menu__item">
											<a href="/coffee_shop/widget/changePass.php" class="user-menu__link">Đổi mật khẩu</a>
										</li>
										<li class="user-menu__item">
											<a href="/coffee_shop/widget/logout.php" class="user-menu__link">Đăng xuất</a>
										</li>
										
									</ul>
								</div>
							</div>
							<a href="/coffee_shop/widget/cart/cart.php" class="navbar-login__cart">
								<i class="navbar-login__icon fas fa-shopping-cart"></i>
							</a>
						';
					} else {
						echo '
							<button class="navbar-login__btn">
								Đăng nhập
							</button>
							<a class="navbar-login__cart">
								<i class="navbar-login__icon fas fa-shopping-cart"></i>
							</a>
						';
					}
				?>
			</div>
		</div>
    </div>
</div>
<!-- Login Modal -->
<div class="overlay overlay-login">
	<div class="form-login">
		<div class="form-toggle"></div>
			<div class="form-panel">
				<label href="" class="form-close form-close--login">
					<i class="form-close__icon fas fa-times"></i>
				</label>
				<div class="form-header">
					<h1 class="form-header__title">Đăng Nhập Tài Khoản</h1>
				</div>
				<div class="form-content">
					<?php
						if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
							echo '
								<form method="post">
									<div class="form-group">
										<label for="username">Tên tài khoản</label>
										<input id="username" type="text" name="username" required="required" value="'.$_COOKIE['username'].'" 
										placeholder="Nhập email hoặc số điện thoại"/>
									</div>
									<div class="form-group">
										<label for="password">Mật khẩu</label>
										<input id="password" type="password" name="password" required="required" value="'.$_COOKIE['password'].'"
										placeholder="Nhập mật khẩu"/>
									</div>
									<div class="form-group">
										<label class="form-remember">
										<input type="checkbox" name="remember" checked/>Nhớ tài khoản & mật khẩu
									</div>
									<div class="form-group form-submit">
										<button class="form-submit__btn" type="submit">Đăng Nhập</button>
									</div>
									<div class="form-group">
										<label for="register">Chưa có tài khoản? <a class="form-recovery form-to-register" href="#">Đăng ký ngay</a></label>
									</div>
								</form>
							';
						} else {
							echo '
								<form method="post">
									<div class="form-group">
										<label for="username">Tên tài khoản</label>
										<input id="username" type="text" name="username" required="required" 
										placeholder="Nhập email hoặc số điện thoại"/>
									</div>
									<div class="form-group">
										<label for="password">Mật khẩu</label>
										<input id="password" type="password" name="password" required="required"
										placeholder="Nhập mật khẩu"/>
									</div>
									<div class="form-group">
										<label class="form-remember">
										<input type="checkbox" name="remember"/>Nhớ tài khoản & mật khẩu
									</div>
									<div class="form-group form-submit">
										<button class="form-submit__btn" type="submit">Đăng Nhập</button>
									</div>
									<div class="form-group">
										<label for="register">Chưa có tài khoản? <a class="form-recovery form-to-register" href="#">Đăng ký ngay</a></label>
									</div>
								</form>
							';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Register Modal -->
<div class="overlay overlay-register">
	<div class="form-register">
		<div class="form-panel">
			<label href="" class="form-close form-close--register">
				<i class="form-close__icon fas fa-times"></i>
			</label>
			<div class="form-header">
				<h1>Đăng Ký Tài Khoản</h1>
			</div>
			<div class="form-content">
				<form method="post">
					<div class="form-group">
						<label for="name">Tên người dùng</label>
						<input id="name" type="text" name="name" required="required" 
						placeholder="Nhập họ tên"/>
					</div>
					<div class="form-group">
						<label for="reg-usernname">Tên tài khoản</label>
						<input id="reg-usernname" type="text" name="reg-username" required="required" 
						placeholder="Nhập tên tài khoản"/>
					</div>
					<div class="form-group">
						<label for="reg-password">Mật khẩu</label>
						<input id="reg-password" type="password" name="reg-password" required="required"
						placeholder="Nhập mật khẩu"/>
					</div>
					<div class="form-group">
						<label for="re-password">Nhập lại mật khẩu</label>
						<input id="re-password" type="password" name="re-password" required="required"
						placeholder="Nhập lại mật khẩu"/>
					</div>
					<div class="form-group">
						<label for="phone-number">Nhập số điện thoại</label>
						<input id="phone-number" type="tel" name="phone-number" required="required"
						placeholder="Nhập số điện thoại"/>
					</div>
					<div class="form-group form-submit">
						<button class="form-submit__btn" type="submit">Đăng Ký</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


