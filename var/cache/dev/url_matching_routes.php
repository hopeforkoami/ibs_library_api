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
        '/emprunt/add' => [[['_route' => 'app_emprunt_add', '_controller' => 'App\\Controller\\EmpruntController::addReservation'], null, ['POST' => 0], null, false, false, null]],
        '/emprunt/changestatus' => [[['_route' => 'app_emprunt_status_update', '_controller' => 'App\\Controller\\EmpruntController::changeStatusReservation'], null, ['UPDATE' => 0], null, false, false, null]],
        '/exemplaire/add' => [[['_route' => 'app_exemplaire_add', '_controller' => 'App\\Controller\\ExemplaireController::add'], null, ['POST' => 0, 'OPTIONS' => 1], null, false, false, null]],
        '/exemplaire/delete' => [[['_route' => 'app_exemplaire_delete', '_controller' => 'App\\Controller\\ExemplaireController::deleteExemplaire'], null, ['DELETE' => 0], null, false, false, null]],
        '/exemplaire/update' => [[['_route' => 'app_exemplaire_update', '_controller' => 'App\\Controller\\ExemplaireController::update'], null, ['PUT' => 0], null, false, false, null]],
        '/exemplaire/checkfree' => [[['_route' => 'app_exemplaire_checkfree', '_controller' => 'App\\Controller\\ExemplaireController::exemplaireCheckFree'], null, ['GET' => 0], null, false, false, null]],
        '/exemplaire/getofbook' => [[['_route' => 'app_exemplaire_filter_book', '_controller' => 'App\\Controller\\ExemplaireController::bookExemplaires'], null, ['GET' => 0], null, false, false, null]],
        '/livre/add' => [[['_route' => 'app_livre_add', '_controller' => 'App\\Controller\\LivreController::addLivre'], null, ['POST' => 0], null, false, false, null]],
        '/livre/update' => [[['_route' => 'app_livre_update', '_controller' => 'App\\Controller\\LivreController::updateLivre'], null, ['PUT' => 0], null, false, false, null]],
        '/livre/listfull' => [[['_route' => 'app_livre_listFull', '_controller' => 'App\\Controller\\LivreController::listFull'], null, ['GET' => 0], null, false, false, null]],
        '/livre/details' => [[['_route' => 'app_livre_details', '_controller' => 'App\\Controller\\LivreController::details'], null, ['GET' => 0], null, false, false, null]],
        '/livre/listcategoryfilter' => [[['_route' => 'app_livre_list_categoryFilter', '_controller' => 'App\\Controller\\LivreController::listFilterCategory'], null, ['GET' => 0], null, false, false, null]],
        '/livre/update2' => [[['_route' => 'app_livre_update2', '_controller' => 'App\\Controller\\LivreController::update'], null, null, null, false, false, null]],
        '/livre/delete' => [[['_route' => 'app_livre_delete', '_controller' => 'App\\Controller\\LivreController::deleteLivre'], null, ['DELETE' => 0], null, false, false, null]],
        '/userLogin' => [[['_route' => 'app_membre_login', '_controller' => 'App\\Controller\\MembreController::login'], null, null, null, false, false, null]],
        '/user/delete' => [[['_route' => 'app_user_delete', '_controller' => 'App\\Controller\\MembreController::deleteMembre'], null, ['DELETE' => 0], null, false, false, null]],
        '/user/details' => [[['_route' => 'app_user_details', '_controller' => 'App\\Controller\\MembreController::details'], null, ['GET' => 0], null, false, false, null]],
        '/user/listfull' => [[['_route' => 'app_user_list_full', '_controller' => 'App\\Controller\\MembreController::listAll'], null, ['GET' => 0], null, false, false, null]],
        '/user/add' => [[['_route' => 'user', '_controller' => 'App\\Controller\\MembreController::addUser'], null, ['POST' => 0], null, false, false, null]],
        '/user/update' => [[['_route' => 'app_user_update', '_controller' => 'App\\Controller\\MembreController::update'], null, ['PUT' => 0], null, false, false, null]],
        '/position/add' => [[['_route' => 'app_position_add', '_controller' => 'App\\Controller\\PositionController::addIfNotExist'], null, ['POST' => 0, 'OPTIONS' => 1], null, false, false, null]],
        '/colonnes/list' => [[['_route' => 'app_colonne_list', '_controller' => 'App\\Controller\\PositionController::listColonne'], null, ['GET' => 0], null, false, false, null]],
        '/rangers/list' => [[['_route' => 'app_ranger_list', '_controller' => 'App\\Controller\\PositionController::listRanger'], null, ['GET' => 0], null, false, false, null]],
        '/reservation/add' => [[['_route' => 'app_reservation_add', '_controller' => 'App\\Controller\\ReservationController::addReservation'], null, ['POST' => 0], null, false, false, null]],
        '/reservation/changestatus' => [[['_route' => 'app_reservation_status_update', '_controller' => 'App\\Controller\\ReservationController::changeStatusReservation'], null, ['UPDATE' => 0], null, false, false, null]],
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
