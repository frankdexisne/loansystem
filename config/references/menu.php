<?php
return [

    // [
    //     'name'=>'Loans',
    //     'url'=>'#',
    //     'icon'=>'menu-icon fa fa-credit-card',
    //     'sub_menu'=>[
    //         [
    //             'name'=>'Clients',
    //             'route_name'=>'clients.index',
    //             'icon'=>'menu-icon fa fa-users',
    //             'permission_name'=>'clients.index',
    //         ],
    //         [
    //             'name'=>'Active clients',
    //             'route_name'=>'loans.index',
    //             'icon'=>'menu-icon fa fa-users',
    //             'permission_name'=>'loans.index',
    //         ],
    //         [
    //             'name'=>'Payments',
    //             'route_name'=>'payments.index',
    //             'icon'=>'menu-icon fa fa-money',
    //             'permission_name'=>'payments.index',
    //         ]
            

    //     ],
    //     'permissions_name'=>'clients.index|loans.index',
    // ],
    [
        'name'=>'Loans',
        'url'=>'#',
        'icon'=>'menu-icon fa fa-credit-card',
        'sub_menu'=>[
            [
                'name'=>'Search Client',
                'route_name'=>'loans.create',
                'icon'=>'menu-icon fa fa-plus',
                'permission_name'=>'loans.create',
            ],
            [
                'name'=>'For Approval',
                'route_name'=>'loans.view-for-approval',
                'icon'=>'menu-icon fa fa-users',
                'permission_name'=>'loans.view-for-approval',
            ],
            [
                'name'=>'Approved',
                'route_name'=>'loans.view-approved',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'loans.view-approved',
            ],
            [
                'name'=>'For releasing',
                'route_name'=>'loans.view-for-release',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'loans.view-for-release',
            ],
            [
                'name'=>'Released',
                'route_name'=>'loans.view-released',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'loans.view-released',
            ]
        ],
        'permissions_name'=>'clients.index|loans.index',
    ],
    [
        'name'=>'Payments & Remits',
        'route_name'=>'remittances.index',
        'icon'=>'menu-icon fa fa-money',
        'sub_menu'=>[],
        'permissions_name'=>'remittances.index',
    ],
    [
        'name'=>'Reports',
        'url'=>'#',
        'icon'=>'menu-icon fa  fa-bar-chart-o',
        'sub_menu'=>[
            [
                'name'=>'Note Collection Report (Daily)',
                'route_name'=>'reports.ncr',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'reports.index',
            ],
            // [
            //     'name'=>'Target Performance Report (Daily)',
            //     'route_name'=>'reports.tpr',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'reports.index',
            // ],
            [
                'name'=>'Collection Report (Weekly/Semi-Monthly/Monthly)',
                'route_name'=>'reports.cr',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'reports.index',
            ],
            [
                'name'=>'Sales Report (Weekly/Semi-Monthly/Monthly)',
                'route_name'=>'reports.sr',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'reports.index',
            ],
            [
                'name'=>'Loan Report (Weekly/Semi-Monthly/Monthly)',
                'route_name'=>'reports.lr',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'reports.index',
            ],
            [
                'name'=>'Withdrawal Report (Weekly/Semi-Monthly/Monthly)',
                'route_name'=>'reports.wr',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'reports.index',
            ],
            // [
            //     'name'=>'Expenses Report',
            //     'route_name'=>'reports.er',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'reports.index',
            // ],
        ],
        'permissions_name'=>'reports.index',
    ],

    // [
    //     'name'=>'References',
    //     'route_name'=>'references.index',
    //     'icon'=>'menu-icon fa fa-list-alt',
    //     'sub_menu'=>[],
    //     'permissions_name'=>'branches.index|areas.index|categories.index|terms.index|payment-modes.index|charges.index',
    // ],

    [
        'name'=>'System Libraries',
        'url'=>'#',
        'icon'=>'menu-icon fa  fa-list',
        'sub_menu'=>[
            [
                'name'=>'Branches',
                'route_name'=>'branches.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'branches.index',
            ],
            [
                'name'=>'Areas',
                'route_name'=>'areas.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'areas.index',
            ],
            [
                'name'=>'Categories',
                'route_name'=>'categories.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'categories.index',
            ],
            [
                'name'=>'Terms',
                'route_name'=>'terms.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'terms.index',
            ],
            [
                'name'=>'Payment Modes',
                'route_name'=>'payment-modes.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'payment-modes.index',
            ],
            [
                'name'=>'Charges',
                'route_name'=>'charges.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'charges.index',
            ],
            // [
            //     'name'=>'Expenses Report',
            //     'route_name'=>'reports.er',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'reports.index',
            // ],
        ],
        'permissions_name'=>'branches.index|areas.index|categories.index|terms.index|payment-modes.index|charges.index',
    ],

    [
        'name'=>'System Administration',
        'url'=>'#',
        'icon'=>'menu-icon fa  fa-list',
        'sub_menu'=>[
            [
                'name'=>'Employees',
                'route_name'=>'employees.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'employees.index',
            ],
            [
                'name'=>'Users',
                'route_name'=>'users.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'users.index',
            ]
        ],
        'permissions_name'=>'users.index|employees.index',
    ],
];
?>