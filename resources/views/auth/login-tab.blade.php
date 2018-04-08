<div id="login">
    <form method="post" action="{{ route('login') }}">
        @csrf
        <div>
            @include('auth.phone-block')
            <button type="submit" class="button button-block">Войти</button>
        </div>
    </form>
</div>