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
            ],
            [
                'name'=>'Reports',
                'route_name'=>'reports.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'reports.index',
            ]
            

        ],
        'permissions_name'=>'clients.index|loans.index',
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