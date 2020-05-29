<li class="nav-item dropdown">
    <a
        aria-expanded="false"
        aria-haspopup="true"
        class="nav-link d-flex"
        data-toggle="dropdown"
        href="#"
        role="button"
        >
        <img class="img-avatar"
            src="{{ asset('images/avatar.png') }}"
            alt="{{ auth()->user()->username }}">
        <p class="mr-3 mb-0 text-left d-md-down-none">
            <span> {{ auth()->user()->name }} </span><br>
            <span class="text-muted">{{ auth()->user()->role->description }}</span>
        </p>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center">
            <strong>Account</strong>
        </div>
        <a class="dropdown-item" href="#" v-on:click.prevent="$refs.changepassword.open()">
            <i class="fa fa-key"></i> Change Password
        </a>
        <form method="POST" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <button type="submit" class="dropdown-item"> <i class="fa fa-lock"></i> Logout </button>
        </form>
    </div>
</li>