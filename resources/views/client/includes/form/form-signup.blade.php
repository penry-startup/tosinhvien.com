<form method="POST" action="{{ route('client.auth.submit.signup') }}" data-form="signup" class="form-wrapper">
    @csrf
    <div class="form-group">
        <label for="name-signup">Tên của bạn</label>
        <input type="text" class="form-control shadow-none" id="name-signup" name="data[name]" placeholder="Nhập tên của bạn">
    </div>
    <div class="form-group">
        <label for="email-signup">E-mail</label>
        <input type="text" class="form-control shadow-none" id="email-signup" name="data[email]" placeholder="Nhập đia chỉ email">
    </div>
    <div class="form-group">
        <label for="sex-signup">Giới tính</label>
        <select id="sex-signup" class="form-control shadow-none" name="data[sex]">
            <option value="1" selected>Nam</option>
            <option value="2">Nữ</option>
            <option value="3">LGBT</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password-signup">Mật khẩu</label>
        <input type="password" class="form-control shadow-none" id="password-signup" name="data[password]" placeholder="Nhập mật khẩu">
    </div>
    <div class="form-group">
        <label for="password_confirmation-signup">Nhập lại mật khẩu</label>
        <input type="password" class="form-control shadow-none" id="password_confirmation-signup" name="data[password_confirmation]" placeholder="Nhập mật khẩu">
    </div>
    <button type="submit" class="btn btn-primary btn-block shadow-none btn-submit">Đăng ký</button>
</form>
