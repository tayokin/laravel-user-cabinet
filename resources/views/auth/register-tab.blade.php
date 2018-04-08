<div id="register">
    <form method="post" action="{{ route('register') }}">
        @csrf
        <div>
            <div class="field-wrap">
                <label for="name">Ваше имя<span class="req">*</span></label>
                <input id="name" type="text" name="name" required />
            </div>
            @include('auth.phone-block')
            <div class="field-wrap">
                <label for="password">Пароль<span class="req">*</span></label>
                <input id="password" type="password" name="password" required />
            </div>
            <div class="field-wrap">
                <label for="phone_number">Подтверждение пароля<span class="req">*</span></label>
                <input id="password-confirm" type="password" name="password_confirmation" required />
            </div>
            <button type="submit" class="button button-block">Зарегистрироваться</button>
        </div>
    </form>
</div>