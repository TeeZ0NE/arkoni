<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(__('breadcrumbs.home'), route('home'));
});
//
//Breadcrumbs::register('categories', function ($breadcrumbs) {
//    $breadcrumbs->parent('home');
//    $breadcrumbs->push(__('breadcrumbs.categories'), route('categories'));
//});
//
//Breadcrumbs::register('sub-categories', function ($breadcrumbs) {
//    $breadcrumbs->parent('home');
//    $breadcrumbs->push(__('breadcrumbs.categories'), route('sub-categories'));
//});