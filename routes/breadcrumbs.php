<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\AppUser;
use App\Models\Category;
use App\Models\Look;
use App\Models\Topic;
use App\Models\User;
use App\Models\WardrobeCategory;
use App\Models\WardrobeItem;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


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
