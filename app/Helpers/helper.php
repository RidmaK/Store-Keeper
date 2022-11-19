<?php

function getAcl()
{
    return [
        [
            'name' => 'Dashboards',
            'icon' => 'fa-tachometer',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'dashboard' => [
                    'label' => 'dashboard',
                    'route' => route('home'),
                    'status' => 1,
                    'permissions_list' => [
                        [
                            'name' => 'dashboard-list',
                            'permission_label' => 'Dashboard View',
                            'guard_name' => 'web',
                            'group' => 'dashboard',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 1,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Setting',
            'icon' => 'fa-tachometer',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'setting' => [
                    'label' => 'setting',
                    'route' => route('home'),
                    'status' => 1,
                    'permissions_list' => [
                        [
                            'name' => 'setting-list',
                            'permission_label' => 'Setting View',
                            'guard_name' => 'web',
                            'group' => 'setting',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 1,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Product Category',
            'icon' => 'fa-users',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'category' => [
                    'label' => 'category',
                    'route' => route('category.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'category-list',
                            'permission_label' => 'Category List',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 2,
                        ],

                        [
                            'name' => 'category-edit',
                            'permission_label' => 'Category Edit',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 3,
                        ],

                        [
                            'name' => 'category-create',
                            'permission_label' => 'Category Create',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],

                        [
                            'name' => 'category-delete',
                            'permission_label' => 'Category Delete',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Company',
            'icon' => 'fa-users',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'company' => [
                    'label' => 'company',
                    'route' => route('company.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'company-list',
                            'permission_label' => 'Company List',
                            'guard_name' => 'web',
                            'group' => 'company',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 2,
                        ],

                        [
                            'name' => 'company-edit',
                            'permission_label' => 'Company Edit',
                            'guard_name' => 'web',
                            'group' => 'company',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 3,
                        ],

                        [
                            'name' => 'company-create',
                            'permission_label' => 'Company Create',
                            'guard_name' => 'web',
                            'group' => 'company',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],

                        [
                            'name' => 'company-delete',
                            'permission_label' => 'Company Delete',
                            'guard_name' => 'web',
                            'group' => 'company',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Buying',
            'icon' => 'fa-users',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'customer' => [
                    'label' => 'buying',
                    'route' => route('customer.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'customer-list',
                            'permission_label' => 'Customer List',
                            'guard_name' => 'web',
                            'group' => 'customer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 2,
                        ],

                        [
                            'name' => 'customer-edit',
                            'permission_label' => 'Customer Edit',
                            'guard_name' => 'web',
                            'group' => 'customer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 3,
                        ],

                        [
                            'name' => 'customer-create',
                            'permission_label' => 'Customer Create',
                            'guard_name' => 'web',
                            'group' => 'customer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],

                        [
                            'name' => 'customer-delete',
                            'permission_label' => 'Customer Delete',
                            'guard_name' => 'web',
                            'group' => 'customer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Selling',
            'icon' => 'fa-users',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'selling' => [
                    'label' => 'selling',
                    'route' => route('selling.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'selling-list',
                            'permission_label' => 'Selling List',
                            'guard_name' => 'web',
                            'group' => 'selling',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 2,
                        ],

                        [
                            'name' => 'selling-edit',
                            'permission_label' => 'Selling Edit',
                            'guard_name' => 'web',
                            'group' => 'selling',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 3,
                        ],

                        [
                            'name' => 'selling-create',
                            'permission_label' => 'Selling Create',
                            'guard_name' => 'web',
                            'group' => 'selling',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],

                        [
                            'name' => 'selling-delete',
                            'permission_label' => 'Selling Delete',
                            'guard_name' => 'web',
                            'group' => 'selling',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Inventory',
            'icon' => 'fa-boxes',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'inventory' => [
                    'label' => 'inventory',
                    'route' => route('product.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'inventory-list',
                            'permission_label' => 'Inventory List',
                            'guard_name' => 'web',
                            'group' => 'inventory',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 5,
                        ],

                        [
                            'name' => 'inventory-edit',
                            'permission_label' => 'Inventory Edit',
                            'guard_name' => 'web',
                            'group' => 'inventory',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 6,
                        ],

                        [
                            'name' => 'inventory-create',
                            'permission_label' => 'Inventory Create',
                            'guard_name' => 'web',
                            'group' => 'inventory',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 7,
                        ],
                        [
                            'name' => 'inventory-delete',
                            'permission_label' => 'Inventory Delete',
                            'guard_name' => 'web',
                            'group' => 'inventory',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Users',
            'icon' => 'fa-user',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'user' => [
                    'label' => 'user',
                    'route' => route('user.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'user-list',
                            'permission_label' => 'User List',
                            'guard_name' => 'web',
                            'group' => 'user',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 8,
                        ],

                        [
                            'name' => 'user-edit',
                            'permission_label' => 'User Edit',
                            'guard_name' => 'web',
                            'group' => 'user',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 9,
                        ],

                        [
                            'name' => 'user-create',
                            'permission_label' => 'User Create',
                            'guard_name' => 'web',
                            'group' => 'user',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 10,
                        ],
                        [
                            'name' => 'user-delete',
                            'permission_label' => 'User Delete',
                            'guard_name' => 'web',
                            'group' => 'user',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'User Groups',
            'icon' => 'fa-user',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'user-group' => [
                    'label' => 'user-group',
                    'route' => route('user-group.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'user-group-list',
                            'permission_label' => 'User Group List',
                            'guard_name' => 'web',
                            'group' => 'user-group',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 11,
                        ],

                        [
                            'name' => 'user-group-edit',
                            'permission_label' => 'User Group Edit',
                            'guard_name' => 'web',
                            'group' => 'user-group',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 12,
                        ],

                        [
                            'name' => 'user-group-create',
                            'permission_label' => 'User Group Create',
                            'guard_name' => 'web',
                            'group' => 'user-group',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 13,
                        ],
                        [
                            'name' => 'user-group-delete',
                            'permission_label' => 'User Group Delete',
                            'guard_name' => 'web',
                            'group' => 'user-group',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
    ];
}



function strLimit($value, $limit = 50)
{
    $result = '';
    $truncated = Str::limit($value, $limit, '...');
    $result = $truncated;

    return $result;
}


function checkPermission($array, $value)
{
    foreach ($array as $index => $el) {
        if ($el['key'] == $value) {
            return true;
        }
    }

    return false;
}
