<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/auteur/listfull' => [[['_route' => 'app_auteur', '_controller' => 'App\\Controller\\AuteurController::listFull'], null, null, null, false, false, null]],
        '/categorie/add' => [[['_route' => 'app_categorie', '_controller' => 'App\\Controller\\CategorieController::addCategorie'], null, null, null, false, false, null]],
        '/categorie/listfull' => [[['_route' => 'app_categorie_listFull', '_controller' => 'App\\Controller\\CategorieController::listFull'], null, ['GET' => 0], null, false, false, null]],
        '/livre/add' => [[['_route' => 'app_livre_add', '_controller' => 'App\\Controller\\LivreController::addLivre'], null, ['POST' => 0], null, false, false, null]],
        '/livre/update' => [[['_route' => 'app_livre_update', '_controller' => 'App\\Controller\\LivreController::updateLivre'], null, ['PUT' => 0], null, false, false, null]],
        '/livre/listfull' => [[['_route' => 'app_livre_listFull', '_controller' => 'App\\Controller\\LivreController::listFull'], null, ['GET' => 0], null, false, false, null]],
        '/livre/details' => [[['_route' => 'app_livre_details', '_controller' => 'App\\Controller\\LivreController::details'], null, ['GET' => 0], null, false, false, null]],
        '/livre/listcategoryfilter' => [[['_route' => 'app_livre_list_categoryFilter', '_controller' => 'App\\Controller\\LivreController::listFilterCategory'], null, ['GET' => 0], null, false, false, null]],
        '/livre/update2' => [[['_route' => 'app_livre_update2', '_controller' => 'App\\Controller\\LivreController::update'], null, null, null, false, false, null]],
        '/userLogin' => [[['_route' => 'app_membre_login', '_controller' => 'App\\Controller\\MembreController::login'], null, null, null, false, false, null]],
        '/user/delete' => [[['_route' => 'app_user_delete', '_controller' => 'App\\Controller\\MembreController::deleteMembre'], null, ['DELETE' => 0], null, false, false, null]],
        '/user/details' => [[['_route' => 'app_user_details', '_controller' => 'App\\Controller\\MembreController::details'], null, ['GET' => 0], null, false, false, null]],
        '/user/listfull' => [[['_route' => 'app_user_list_full', '_controller' => 'App\\Controller\\MembreController::listAll'], null, ['GET' => 0], null, false, false, null]],
        '/user/add' => [[['_route' => 'user', '_controller' => 'App\\Controller\\MembreController::addUser'], null, ['POST' => 0], null, false, false, null]],
        '/user/update' => [[['_route' => 'app_user_update', '_controller' => 'App\\Controller\\MembreController::update'], null, ['PUT' => 0], null, false, false, null]],
        '/login' => [[['_route' => 'app_system', '_controller' => 'App\\Controller\\SystemController::login'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
