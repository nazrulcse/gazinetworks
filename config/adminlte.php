<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Gazinetworks',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Gazi</b>Networks',

    'logo_mini' => '<b>G</b>N',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'dashboard',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        [
          'text' => 'Dashboard',
          'icon' => 'dashboard',
          'url' => '/dashboard' ,
          'role' => ['admin', 'agent']
        ],
        'MENU',
        [
            'text'        => 'Agents',
            'icon'        => 'user',
            'role'   => 'admin',
            'submenu' => [
                [

                    'text'  => 'Agent List',
                    'url'   => '/users?agents',
                    'icon'  => 'list-ol',

                ],
                [

                    'text'  => 'Create Agent',
                    'url'   => 'users/create?is_agent',
                    'icon'  => 'address-card',

                ],
                [
                    'text'  => 'Agent Report',
                    'url'   => 'agents/report',
                    'icon'  => 'line-chart',
                ],
            ]
        ],
        [
            'text'        => 'Customers',
            'icon'        => 'address-book-o',
            'role'        => ['admin', 'agent'],
            'submenu' => [

                [
                    'text'  => 'Customer List',
                    'url'   => '/users?customers',
                    'icon'  => 'list'
                ],
                [
                    'text'  => 'Create Customer',
                    'url'   => 'users/create?is_customer',
                    'icon'  => 'address-card-o',
                    'role'   => ['admin', 'agent'],
                ],
                [
                    'text'  => 'Customer Report',
                    'url'   => 'customers/report',
                    'icon'  => 'line-chart',
                ],
            ]
        ],

        [
            'text'        => 'Invoices',
            'icon'        => 'folder-open-o',
            'role'  => ['admin', 'agent'],
            'submenu' => [

                [
                    'text'  => 'Invoice List',
                    'url'   => '/invoices',
                    'icon'  => 'file'
                ],
                [
                    'text'  => 'Paid Invoices',
                    'url'   => '/invoices?paid',
                    'icon'  => 'file-text-o'
                ],
                [
                    'text'  => 'Due Invoices',
                    'url'   => '/invoices?due',
                    'icon'  => 'file-zip-o'
                ],
                [
                    'text'  => 'Create Invoice',
                    'url'   => '/invoices/create',
                    'icon'  => 'pencil'
                ],
                [
                    'text'  => 'Other Income Invoices List',
                    'url'   => '/other_income_invoices',
                    'icon'  => 'asterisk'
                ],
                [
                    'text'  => 'Create Other Income Invoice',
                    'url'   => '/invoices/create?other',
                    'icon'  => 'plus'
                ],
                [
                    'text'  => 'Invoice Report',
                    'url'   => 'invoice_reports',
                    'icon'  => 'line-chart',
                ],

            ]
        ],

        [
            'text'        => 'Payments',
            'icon'        => 'money',
            'role'  => ['admin', 'agent'],
            'submenu' => [

                [
                    'text'  => 'Payment List',
                    'url'   => '/payments',
                    'icon'  => 'list'
                ],

                [
                    'text'  => 'Other Income Payment List',
                    'url'   => '/other_income_payments',
                    'icon'  => 'asterisk'
                ],

            ]
        ],
        [
            'text'        => 'Expenses Category',
            'icon'        => 'usd',
            'role'  => ['admin', 'agent'],
            'submenu' => [

                [
                    'text'  => 'Expense Category',
                    'url'   => '/expense_categories',
                    'icon'  => 'align-justify'
                ],
                [
                    'text'  => 'New Expense Category',
                    'url'   => '/expense_categories',
                    'icon'  => 'plus-square-o'
                ],
            ]
        ],
        [
            'text'        => 'Expenses',
            'icon'        => 'usd',
            'role'  => ['admin', 'agent'],
            'submenu' => [

                [
                    'text'  => 'Expense List',
                    'url'   => '/expenses',
                    'icon'  => 'align-justify'
                ],
                [
                    'text'  => 'New Expense',
                    'url'   => '/expenses/create',
                    'icon'  => 'plus-square-o'
                ],
            ]
        ],
        [
          'text' => 'Reporting',
          'icon' => 'line-chart',
          'role' => ['admin', 'agent'],
          'submenu' => [
            [
              'text' => 'Income',
              'url' => '/report/income',
              'icon' => 'usd'
            ],
            [
              'text' => 'Expense',
              'url' => '/report/expense',
              'icon' => 'money'
            ]
          ]
        ],
        [
          'text' => 'Announcement',
          'icon' => 'bullhorn',
          'role' => ['admin', 'agent'],
          'submenu' => [
            [
              'text' => 'Announcements',
              'url' => '/announcements',
              'icon' => 'align-justify'
            ],
            [
              'text' => 'New Announcement',
              'url' => '/announcements/create',
              'icon' => 'plus-square-o'
            ]
          ]
        ],

        'Feedbacks',

            [

                'text'  => 'Customer Enquiry',
                'url'   => '/contacts',
                'icon'  => 'phone-square',
                'role'  => ['admin', 'agent'],
            ],
            [

                'text'  => 'Customer Complains',
                'url'   => '/complains',
                'icon'  => 'exclamation-circle',
                'role'  => ['admin', 'agent'],
            ],
        ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        //JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        App\MyMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
    ],
];
