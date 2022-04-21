<ul class="nav nav-tabs my-3">
    <li class="nav-item"><a class="nav-link {{ ($route == 'home')?'active':'' }}" href="{{ route('admin.index') }}">Главная</a>
    </li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'topics')?'active':'' }}"
                            href="{{ route('admin.topics.index') }}">Темы</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'looks')?'active':'' }}"
                            href="{{ route('admin.looks.index') }}">Луки</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'wardrobe')?'active':'' }}"
                            href="{{ route('admin.wardrobe-items.index') }}">Гардероб</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'brands')?'active':'' }}"
                            href="{{ route('admin.brands.index') }}">Бренды</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'users')?'active':'' }}"
                            href="{{ route('admin.users.index') }}">Пользователи</a></li>
</ul>
