<?php
return [

    [
        'name'=>'Loans',
        'url'=>'#',
        'icon'=>'menu-icon fa fa-credit-card',
        'sub_menu'=>[
            [
                'name'=>'Clients',
                'route_name'=>'clients.index',
                'icon'=>'menu-icon fa fa-users',
                'permission_name'=>'clients.index',
            ],
            [
                'name'=>'Active clients',
                'route_name'=>'loans.index',
                'icon'=>'menu-icon fa fa-users',
                'permission_name'=>'loans.index',
            ],
            [
                'name'=>'Payments',
                'route_name'=>'payments.index',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'payments.index',
            ]
            

        ],
        'permissions_name'=>'clients.index|loans.index',
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

    [
        'name'=>'References',
        'route_name'=>'references.index',
        'icon'=>'menu-icon fa fa-list-alt',
        'sub_menu'=>[],
        'permissions_name'=>'branches.index|areas.index|categories.index|terms.index|payment-modes.index|charges.index',
    ],
];
?>