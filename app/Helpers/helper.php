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
                'role' => [
                    'label' => 'role',
                    'route' => route('role.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'role-list',
                            'permission_label' => 'User Group List',
                            'guard_name' => 'web',
                            'group' => 'role',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 11,
                        ],

                        [
                            'name' => 'role-edit',
                            'permission_label' => 'User Group Edit',
                            'guard_name' => 'web',
                            'group' => 'role',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 12,
                        ],

                        [
                            'name' => 'role-create',
                            'permission_label' => 'User Group Create',
                            'guard_name' => 'web',
                            'group' => 'role',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 13,
                        ],
                        [
                            'name' => 'role-delete',
                            'permission_label' => 'User Group Delete',
                            'guard_name' => 'web',
                            'group' => 'role',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Products',
            'icon' => 'fa-user',
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
                            'permission_label' => 'category List',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 11,
                        ],

                        [
                            'name' => 'category-edit',
                            'permission_label' => 'category Edit',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 12,
                        ],

                        [
                            'name' => 'category-create',
                            'permission_label' => 'category Create',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 13,
                        ],
                        [
                            'name' => 'category-delete',
                            'permission_label' => 'category Delete',
                            'guard_name' => 'web',
                            'group' => 'category',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
                'product' => [
                    'label' => 'product',
                    'route' => route('product.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'product-list',
                            'permission_label' => 'Product List',
                            'guard_name' => 'web',
                            'group' => 'product',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 11,
                        ],

                        [
                            'name' => 'product-edit',
                            'permission_label' => 'Product Edit',
                            'guard_name' => 'web',
                            'group' => 'product',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 12,
                        ],

                        [
                            'name' => 'product-create',
                            'permission_label' => 'Product Create',
                            'guard_name' => 'web',
                            'group' => 'product',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 13,
                        ],
                        [
                            'name' => 'product-delete',
                            'permission_label' => 'Product Delete',
                            'guard_name' => 'web',
                            'group' => 'product',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
                'dealer' => [
                    'label' => 'dealer',
                    'route' => route('dealer.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'dealer-list',
                            'permission_label' => 'dealer List',
                            'guard_name' => 'web',
                            'group' => 'dealer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 11,
                        ],

                        [
                            'name' => 'dealer-edit',
                            'permission_label' => 'dealer Edit',
                            'guard_name' => 'web',
                            'group' => 'dealer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 12,
                        ],

                        [
                            'name' => 'dealer-create',
                            'permission_label' => 'dealer Create',
                            'guard_name' => 'web',
                            'group' => 'dealer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 13,
                        ],
                        [
                            'name' => 'dealer-delete',
                            'permission_label' => 'dealer Delete',
                            'guard_name' => 'web',
                            'group' => 'dealer',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Manage Order',
            'icon' => 'fa-user',
            'order' => 1,
            'status' => 1,
            'permissions' => [
                'order' => [
                    'label' => 'order',
                    'route' => route('order.index'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'order-list',
                            'permission_label' => 'Orders List',
                            'guard_name' => 'web',
                            'group' => 'order',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 11,
                        ],

                        [
                            'name' => 'order-edit',
                            'permission_label' => 'Orders Edit',
                            'guard_name' => 'web',
                            'group' => 'order',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 12,
                        ],

                        [
                            'name' => 'order-create',
                            'permission_label' => 'Orders Create',
                            'guard_name' => 'web',
                            'group' => 'order',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 13,
                        ],
                        [
                            'name' => 'order-delete',
                            'permission_label' => 'Orders Delete',
                            'guard_name' => 'web',
                            'group' => 'order',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 4,
                        ],
                    ],
                ],
                'today-order' => [
                    'label' => 'today-order',
                    'route' => route('order.today'),
                    'status' => 1,
                    'permissions_list' => [
                        [

                            'name' => 'today-order-list',
                            'permission_label' => 'Today Orders List',
                            'guard_name' => 'web',
                            'group' => 'order',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 11,
                        ],

                        [
                            'name' => 'today-order-edit',
                            'permission_label' => 'Today Orders Edit',
                            'guard_name' => 'web',
                            'group' => 'order',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 12,
                        ],

                        [
                            'name' => 'today-order-create',
                            'permission_label' => 'Today Orders Create',
                            'guard_name' => 'web',
                            'group' => 'order',
                            'sub_group' => 0,
                            'main_order' => 1,
                            'sub_order' => 13,
                        ],
                        [
                            'name' => 'today-order-delete',
                            'permission_label' => 'Today Orders Delete',
                            'guard_name' => 'web',
                            'group' => 'order',
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
