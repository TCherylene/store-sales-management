<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Gate;

class MenuHelper
{
    public static function getUserMenuList()
    {
        //$items = [
        //    [
        //        'text' => 'Ganti Password',
        //        'icon' => 'key',
        //        'path' => route('profile.change-password'),
        //    ],
        //];
        $items = [];
        return $items;
    }

    public static function getDashboardItems()
    {
        return [
            [
                'icon' => 'line-chart',
                'name' => "Dashboard",
                'path' => 'dashboard',
                'ability' => 'dashboard',
            ]
        ];
    }


    public static function getMenuGroups()
    {
        return [
            [
                'title' => 'Dashboard',
                'items' => self::getDashboardItems(),
            ],
        ];
    }

    public static function getMenuFiltered()
    {
        $all_menu = self::getMenuGroups();
        $filtered = [];
        foreach ($all_menu as $key => $group) {
            $filtered_menu = [];
            foreach ($group['items'] as $k => $menu) {
                // for no child
                if (empty($menu['subItems']) && Gate::allows($menu['ability'] ?? "")) {
                    $filtered_menu[] = $menu;
                }

                // has child
                $filtered_sub_menu = [];
                if (!empty($menu['subItems'])) {
                    foreach ($menu['subItems'] as $j => $sub_item) {
                        if (Gate::allows($sub_item['ability'] ?? "")) {
                            $filtered_sub_menu[] = $sub_item;
                        }
                    }
                }

                if (!empty($filtered_sub_menu)) {
                    $filtered_menu[$k] = $menu;
                    $filtered_menu[$k]["subItems"] = $filtered_sub_menu;
                }
            }

            $filtered[] = [
                'title' => $group['title'],
                'items' => $filtered_menu,
            ];
        }

        // remove if empty items in the group
        foreach ($filtered as $key => $group) {
            if (empty($group['items'])) {
                unset($filtered[$key]);
            }
        }

        return $filtered;
    }
}
