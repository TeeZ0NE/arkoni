<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(__('breadcrumbs.home'), route('home'));
});

Breadcrumbs::register('catalog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('breadcrumbs.catalog'), route('catalog'));
});

Breadcrumbs::register('category', function ($breadcrumbs, $name) {
    $breadcrumbs->parent('catalog');
    $breadcrumbs->push($name);
});

Breadcrumbs::register('sub-category', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('catalog');
    $breadcrumbs->push($post['category_name'], $post['category_slug']);
    $breadcrumbs->push($post['sub-category']);
});

Breadcrumbs::register('product', function ($breadcrumbs, $name ) {
    $breadcrumbs->parent('catalog');
    $breadcrumbs->push($name);
});
//
//Breadcrumbs::register('sub-categories', function ($breadcrumbs) {
//    $breadcrumbs->parent('home');
//    $breadcrumbs->push(__('breadcrumbs.categories'), route('sub-categories'));
//});