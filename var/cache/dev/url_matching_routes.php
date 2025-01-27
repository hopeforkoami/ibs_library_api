<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/auteur' => [[['_route' => 'app_auteur', '_controller' => 'App\\Controller\\AuteurController::index'], null, null, null, false, false, null]],
        '/categorie' => [[['_route' => 'app_categorie', '_controller' => 'App\\Controller\\CategorieController::index'], null, null, null, false, false, null]],
        '/livre' => [[['_route' => 'app_livre', '_controller' => 'App\\Controller\\LivreController::index'], null, null, null, false, false, null]],
        '/matiere/add' => [[['_route' => 'app_matiere', '_controller' => 'App\\Controller\\MatiereController::add'], null, null, null, false, false, null]],
        '/matiere/update' => [[['_route' => 'app_matiere_update', '_controller' => 'App\\Controller\\MatiereController::update'], null, null, null, false, false, null]],
        '/matiere/delete' => [[['_route' => 'app_matiere_delete', '_controller' => 'App\\Controller\\MatiereController::delete'], null, null, null, false, false, null]],
        '/matiere/listfull' => [[['_route' => 'app_matiere_listFull', '_controller' => 'App\\Controller\\MatiereController::listFull'], null, ['GET' => 0], null, false, false, null]],
        '/niveau/add' => [[['_route' => 'app_niveau', '_controller' => 'App\\Controller\\NiveauController::add'], null, null, null, false, false, null]],
        '/niveau/update' => [[['_route' => 'app_niveau_update', '_controller' => 'App\\Controller\\NiveauController::update'], null, null, null, false, false, null]],
        '/niveau/delete' => [[['_route' => 'app_niveau_delete', '_controller' => 'App\\Controller\\NiveauController::delete'], null, null, null, false, false, null]],
        '/niveau/listfull' => [[['_route' => 'app_niveau_listFull', '_controller' => 'App\\Controller\\NiveauController::listFull'], null, ['GET' => 0], null, false, false, null]],
        '/programme/add' => [[['_route' => 'app_programme', '_controller' => 'App\\Controller\\ProgrammeController::add'], null, null, null, false, false, null]],
        '/programme/update' => [[['_route' => 'app_programme_update', '_controller' => 'App\\Controller\\ProgrammeController::update'], null, null, null, false, false, null]],
        '/programme/delete' => [[['_route' => 'app_programme_delete', '_controller' => 'App\\Controller\\ProgrammeController::delete'], null, null, null, false, false, null]],
        '/programme/listfull' => [[['_route' => 'app_programme_listFull', '_controller' => 'App\\Controller\\ProgrammeController::listFull'], null, ['GET' => 0], null, false, false, null]],
        '/serie/add' => [[['_route' => 'app_serie', '_controller' => 'App\\Controller\\SerieController::add'], null, null, null, false, false, null]],
        '/serie/update' => [[['_route' => 'app_serie_update', '_controller' => 'App\\Controller\\SerieController::update'], null, null, null, false, false, null]],
        '/serie/delete' => [[['_route' => 'app_serie_delete', '_controller' => 'App\\Controller\\SerieController::delete'], null, null, null, false, false, null]],
        '/serie/listfull' => [[['_route' => 'app_serie_listFull', '_controller' => 'App\\Controller\\SerieController::listFull'], null, ['GET' => 0], null, false, false, null]],
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
