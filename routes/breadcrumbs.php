<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\AppUser;
use App\Models\Article;
use App\Models\Category;
use App\Models\Look;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\User;
use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.


Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('admin.index'));
});

//////////////
/// STAFF
Breadcrumbs::for('admin.staff.index', function (BreadcrumbTrail $trail) {
    $trail->push('Стафф', route('admin.staff.index'));
});
Breadcrumbs::for('admin.staff.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.staff.index');
    $trail->push('Создать', route('admin.staff.create'));
});
Breadcrumbs::for('admin.staff.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.staff.index');
    $trail->push($user->name, route('admin.staff.show', $user));
});
Breadcrumbs::for('admin.staff.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.staff.show', ['user' => $user]);
    $trail->push('Редактировать', route('admin.staff.edit', $user));
});


//////////////
/// USERS
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->push('Пользователи', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Создать', route('admin.staff.create'));
});
Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, AppUser $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});

//////////////
/// LOOKS
Breadcrumbs::for('admin.looks.index', function (BreadcrumbTrail $trail) {
    $trail->push('Луки', route('admin.looks.index'));
});
Breadcrumbs::for('admin.looks.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.looks.index');
    $trail->push('Создать', route('admin.looks.create'));
});
Breadcrumbs::for('admin.looks.show', function (BreadcrumbTrail $trail, Look $look) {
    $trail->parent('admin.looks.index');
    $trail->push($look->name, route('admin.looks.show', $look));
});
Breadcrumbs::for('admin.looks.edit', function (BreadcrumbTrail $trail, Look $look) {
    $trail->parent('admin.looks.show', $look);
    $trail->push('Редактировать', route('admin.looks.edit', $look));
});
Breadcrumbs::for('admin.looks.items-add', function (BreadcrumbTrail $trail, Look $look) {
    $trail->parent('admin.looks.show', $look);
    $trail->push('Добавить айтем', route('admin.looks.items-add', $look));
});
Breadcrumbs::for('admin.looks.categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.looks.index');
    $trail->push('Категории', route('admin.looks.categories.index'));
});
Breadcrumbs::for('admin.looks.categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.looks.categories.index');
    $trail->push('Создать', route('admin.looks.categories.create'));
});
Breadcrumbs::for('admin.looks.categories.show', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('admin.looks.categories.index');
    $trail->push($category->name, route('admin.looks.categories.show', $category));
});
Breadcrumbs::for('admin.looks.categories.edit', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('admin.looks.categories.show', $category);
    $trail->push('Редактировать', route('admin.looks.categories.edit', $category));
});

//////////////
/// TOPICS
Breadcrumbs::for('admin.topics.index', function (BreadcrumbTrail $trail) {
    $trail->push('Темы', route('admin.topics.index'));
});
Breadcrumbs::for('admin.topics.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.topics.index');
    $trail->push('Создать', route('admin.topics.create'));
});
Breadcrumbs::for('admin.topics.show', function (BreadcrumbTrail $trail, Topic $topic) {
    $trail->parent('admin.topics.index');
    $trail->push($topic->name, route('admin.topics.show', $topic));
});
Breadcrumbs::for('admin.topics.edit', function (BreadcrumbTrail $trail, Topic $topic) {
    $trail->parent('admin.topics.show', $topic);
    $trail->push('Редактировать', route('admin.topics.edit', $topic));
});
Breadcrumbs::for('admin.topics.add-look', function (BreadcrumbTrail $trail, Topic $topic) {
    $trail->parent('admin.topics.show', $topic);
    $trail->push('Добавить образ', route('admin.topics.add-look', $topic));
});


//////////////
/// WARDROBE
Breadcrumbs::for('admin.wardrobe-items.index', function (BreadcrumbTrail $trail) {
    $trail->push('Гардероб', route('admin.wardrobe-items.index'));
});
Breadcrumbs::for('admin.wardrobe-items.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.wardrobe-items.index');
    $trail->push('Добавить', route('admin.wardrobe-items.create'));
});
Breadcrumbs::for('admin.wardrobe-items.show', function (BreadcrumbTrail $trail, WardrobeItem $item) {
    $trail->parent('admin.wardrobe-items.index');
    $trail->push($item->name, route('admin.wardrobe-items.show', $item));
});
Breadcrumbs::for('admin.wardrobe-items.edit', function (BreadcrumbTrail $trail, WardrobeItem $item) {
    $trail->parent('admin.wardrobe-items.show', $item);
    $trail->push('Редактировать', route('admin.wardrobe-items.edit', $item));
});
Breadcrumbs::for('admin.wardrobe-items.add-url', function (BreadcrumbTrail $trail, WardrobeItem $item) {
    $trail->parent('admin.wardrobe-items.show', $item);
    $trail->push('Добавить ссылку', route('admin.wardrobe-items.urls.add', $item));
});
Breadcrumbs::for('admin.wardrobe-categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.wardrobe-items.index');
    $trail->push('Категории', route('admin.wardrobe-categories.index'));
});
Breadcrumbs::for('admin.wardrobe-categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.wardrobe-categories.index');
    $trail->push('Создать', route('admin.wardrobe-categories.create'));
});
Breadcrumbs::for('admin.wardrobe-categories.show', function (BreadcrumbTrail $trail, WardrobeCategory $category) {
    $trail->parent('admin.wardrobe-categories.index');
    $trail->push($category->name, route('admin.wardrobe-categories.show', $category));
});
Breadcrumbs::for('admin.wardrobe-categories.edit', function (BreadcrumbTrail $trail, WardrobeCategory $category) {
    $trail->parent('admin.wardrobe-categories.show', $category);
    $trail->push('Редактировать', route('admin.wardrobe-categories.edit', $category));
});


Breadcrumbs::for('admin.settings.index', function (BreadcrumbTrail $trail) {
    $trail->push('Настройки', route('admin.settings.index'));
});
Breadcrumbs::for('admin.settings.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.settings.index');
    $trail->push('Создать', route('admin.settings.create'));
});
Breadcrumbs::for('admin.settings.edit', function (BreadcrumbTrail $trail, Setting $setting) {
    $trail->parent('admin.settings.index');
    $trail->push('Редактировать ' . $setting->key, route('admin.settings.edit', $setting));
});


Breadcrumbs::for('admin.push.index', function (BreadcrumbTrail $trail) {
    $trail->push('Настройки', route('admin.push.index'));
});
Breadcrumbs::for('admin.push.broadcast', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.push.index');
    $trail->push('Рассылка', route('admin.push.broadcast'));
});
Breadcrumbs::for('admin.push.send', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.push.index');
    $trail->push('Сообщение', route('admin.push.send'));
});

Breadcrumbs::for('admin.articles.index', function (BreadcrumbTrail $trail) {
    $trail->push('Статьи', route('admin.articles.index'));
});
Breadcrumbs::for('admin.articles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.articles.index');
    $trail->push('Создать', route('admin.articles.create'));
});
Breadcrumbs::for('admin.articles.show', function (BreadcrumbTrail $trail, Article $article) {
    $trail->parent('admin.articles.index');
    $trail->push($article->title, route('admin.articles.show', $article));
});
Breadcrumbs::for('admin.articles.edit', function (BreadcrumbTrail $trail, Article $article) {
    $trail->parent('admin.articles.show', $article);
    $trail->push('Редактировать', route('admin.articles.edit', $article));
});
