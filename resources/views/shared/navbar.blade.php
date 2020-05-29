<ul class="nav navbar-nav ml-auto">
    @includeWhen(Auth::check(), 'shared.userdropdown')
</ul>

@includeWhen(Auth::check(), 'shared.changepassmodal')