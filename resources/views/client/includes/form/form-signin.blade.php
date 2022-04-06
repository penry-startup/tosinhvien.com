<form action="" class="form-wrapper">
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control shadow-none" id="email" aria-describedby="email" placeholder="Nhập địa chỉ email của bạn">
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="password" class="form-control shadow-none" id="password" aria-describedby="password" placeholder="Nhập mật khẩu đăng nhập">
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remmember_me">
            <label class="form-check-label" for="remmember_me">Nhớ đăng nhập</label>
        </div>
        <a href="{{ route('client.auth.showForm.forgotPassword') }}">Quyên mật khẩu?</a>
    </div>
    <button type="submit" class="btn btn-primary btn-block shadow-none btn-submit">Đăng nhập</button>
</form>
