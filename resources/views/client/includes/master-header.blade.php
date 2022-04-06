<header class="app-bar toolbar">
    <div class="toolbar__content d-flex justify-content-between align-items-center">
		<div class="toolbar__content-left d-flex align-items-center">
			<div class="company-logo">
				<div class="company-logo__image" style="background-image: url('{{ get_file_version('/assets/img/common/logo_icon.png') }}')"></div>
			</div>
			<div class="app-bar-text">
				Hi<span class="username">Pham Dinh Hung</span>
			</div>
		</div>
		<div class="toolbar__content-right d-flex align-items-center">
			<button type="button" class="btn btn-light">
				<span>Thông báo</span>
				<span class="badge badge-light">4</span>
			</button>
			<div class="app-bar-account">
				<button id="profileDropdown" type="button" class="toolbar-profile__u-dropdown btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t39.30808-1/275509573_1126211248194778_1971760159101307750_n.jpg?stp=dst-jpg_p200x200&_nc_cat=102&ccb=1-5&_nc_sid=7206a8&_nc_ohc=fJJX7FtDbeoAX_i3USz&_nc_ht=scontent.fsgn8-1.fna&oh=00_AT8w8t-xAOgF34PdclrrkuxLSJ8JLQlVrRNTvF_H8JGOHQ&oe=625063EB" alt="user avatar" class="toolbar-profile__u-avt">
				</button>
				<div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="toolbar-profile__u-basicInfo d-flex justify-content-between align-items-center">
                        <div class="sheet d-flex justify-content-between align-items-center">
                            <img src="https://scontent.fsgn8-1.fna.fbcdn.net/v/t39.30808-1/275509573_1126211248194778_1971760159101307750_n.jpg?stp=dst-jpg_p200x200&_nc_cat=102&ccb=1-5&_nc_sid=7206a8&_nc_ohc=fJJX7FtDbeoAX_i3USz&_nc_ht=scontent.fsgn8-1.fna&oh=00_AT8w8t-xAOgF34PdclrrkuxLSJ8JLQlVrRNTvF_H8JGOHQ&oe=625063EB" alt="user avatar" class="u-avt__sector">
                            <div class="u-content__sector">
                                <h3 class="username">Pham Dinh Hung</h3>
                                <span class="joined">Đã tham gia 03/04/2022</span>
                            </div>
                        </div>
                        <div class="u-email__verify-stt"></div>
                    </div>
                    <div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route('client.user.profile.detail', ['user' => '123']) }}">Tài khoản</a>
					<a class="dropdown-item" href="#">Đăng xuất</a>
				</div>
			</div>
		</div>
    </div>
</header>
