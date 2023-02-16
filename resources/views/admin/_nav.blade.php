<ul class="nav nav-tabs my-3">
    <li class="nav-item"><a class="nav-link {{ ($route == 'home')?'active':'' }}" href="{{ route('admin.index') }}">Главная</a>
    </li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'topics')?'active':'' }}"
                            href="{{ route('admin.topics.index') }}">Темы</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'looks')?'active':'' }}"
                            href="{{ route('admin.looks.index') }}">Луки</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'wardrobe')?'active':'' }}"
                            href="{{ route('admin.wardrobe-items.index') }}">Гардероб</a></li>
    @can('admin')
        <li class="nav-item"><a class="nav-link {{ ($route == 'brands')?'active':'' }}"
                                href="{{ route('admin.brands.index') }}">Бренды</a></li>
        <li class="nav-item"><a class="nav-link {{ ($route == 'users')?'active':'' }}"
                                href="{{ route('admin.users.index') }}">Пользователи</a></li>
        <li class="nav-item"><a class="nav-link {{ ($route == 'staff')?'active':'' }}"
                                href="{{ route('admin.staff.index') }}">Стафф</a></li>
        <li class="nav-item"><a class="nav-link {{ ($route == 'settings')?'active':'' }}"
                                href="{{ route('admin.settings.index') }}">Настройки</a></li>
        <li class="nav-item"><a class="nav-link {{ ($route == 'notifications')?'active':'' }}"
                                href="{{ route('admin.notifications.index') }}">Уведомления</a></li>
    @endcan
    <li class="nav-item"><a class="nav-link {{ ($route == 'articles')?'active':'' }}"
                            href="{{ route('admin.articles.index') }}">Статьи</a></li>
    <li class="nav-item"><a class="nav-link {{ ($route == 'moderation-step-1')?'active':'' }}"
                            href="{{ route('admin.moderation-step-1.index') }}">Модерация 1</a></li>
</ul>
