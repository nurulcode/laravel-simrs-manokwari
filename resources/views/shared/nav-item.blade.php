@if ($menu->type == 'header')
    <li class="nav-title">{{ $menu->title }}</li>
@else
    <li class="nav-item {{ $menu->liClass }}">
        <a class="nav-link {{ $menu->class }}" href="{{ url($menu->link) }}">
            <i class="nav-icon {{ $menu->icon }}"></i> {{ $menu->title }}
        </a>
        @if ($menu->isDropdown())
            <ul class="nav-dropdown-items">
                @each('shared.nav-item', $menu->childs, 'menu')
            </ul>
        @endif
    </li>
@endif
