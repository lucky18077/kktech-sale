<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::42RarEMU1yrBf4MP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/coordinator/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'coordinator.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/vp/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'vp.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/leads' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'leads.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'leads.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/leads/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'leads.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/coordinator' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.coordinator',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/v-p' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.vp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/sales-executive-manager' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.sales-executive-manager',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/designation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.designation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/office-team' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.office-team',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/inventory/products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.inventory.products',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/inventory/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.inventory.categories',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/inventory/stock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.inventory.stock',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/sales/customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.sales.customers',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/sales/quotations' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.sales.quotations',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/sales/sales-orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.sales.sales-orders',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/sales/invoices' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.sales.invoices',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/sales/suppliers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.sales.suppliers',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/reports/sales-report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.reports.sales-report',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/reports/analytics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.reports.analytics',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/admin/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.admin.users',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/admin/roles-permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.admin.roles-permissions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/admin/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.admin.settings',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/theme/admin/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'theme.admin.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/leads/([^/]++)(?|(*:25)|/edit(*:37)|(*:44))|/storage/(.*)(?|(*:68)))/?$}sDu',
    ),
    3 => 
    array (
      25 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'leads.show',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      37 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'leads.edit',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      44 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'leads.update',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'leads.destroy',
          ),
          1 => 
          array (
            0 => 'lead',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      68 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local.upload',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::42RarEMU1yrBf4MP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:830:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'C:\\\\xampp\\\\htdocs\\\\kktechsale\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"00000000000008220000000000000000";}}',
        'as' => 'generated::42RarEMU1yrBf4MP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AuthController@showLogin',
        'controller' => 'App\\Http\\Controllers\\AuthController@showLogin',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\AuthController@login',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\AuthController@logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'coordinator.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'coordinator/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Coordinator\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Coordinator\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'coordinator.dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'vp.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'vp/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:51:"function () {
    return \\view(\'vp.dashboard\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000008300000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'vp.dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'leads.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'leads',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'as' => 'leads.index',
        'uses' => 'App\\Http\\Controllers\\LeadController@index',
        'controller' => 'App\\Http\\Controllers\\LeadController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'leads.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'leads/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'as' => 'leads.create',
        'uses' => 'App\\Http\\Controllers\\LeadController@create',
        'controller' => 'App\\Http\\Controllers\\LeadController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'leads.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'leads',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'as' => 'leads.store',
        'uses' => 'App\\Http\\Controllers\\LeadController@store',
        'controller' => 'App\\Http\\Controllers\\LeadController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'leads.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'leads/{lead}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'as' => 'leads.show',
        'uses' => 'App\\Http\\Controllers\\LeadController@show',
        'controller' => 'App\\Http\\Controllers\\LeadController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'leads.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'leads/{lead}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'as' => 'leads.edit',
        'uses' => 'App\\Http\\Controllers\\LeadController@edit',
        'controller' => 'App\\Http\\Controllers\\LeadController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'leads.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'leads/{lead}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'as' => 'leads.update',
        'uses' => 'App\\Http\\Controllers\\LeadController@update',
        'controller' => 'App\\Http\\Controllers\\LeadController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'leads.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'leads/{lead}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'as' => 'leads.destroy',
        'uses' => 'App\\Http\\Controllers\\LeadController@destroy',
        'controller' => 'App\\Http\\Controllers\\LeadController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.coordinator' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/coordinator',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\EnsureAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CoordinatorController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CoordinatorController@index',
        'as' => 'admin.coordinator',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.vp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/v-p',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\EnsureAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\VPController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\VPController@index',
        'as' => 'admin.vp',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.sales-executive-manager' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/sales-executive-manager',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\EnsureAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SalesExecutiveManagerController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\SalesExecutiveManagerController@index',
        'as' => 'admin.sales-executive-manager',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.designation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/designation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\EnsureAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DesignationController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DesignationController@index',
        'as' => 'admin.designation',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.office-team' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/office-team',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\EnsureAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\OfficeTeamController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\OfficeTeamController@index',
        'as' => 'admin.office-team',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.inventory.products' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/inventory/products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\InventoryController@products',
        'controller' => 'App\\Http\\Controllers\\Theme\\InventoryController@products',
        'as' => 'theme.inventory.products',
        'namespace' => NULL,
        'prefix' => 'theme/inventory',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.inventory.categories' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/inventory/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\InventoryController@categories',
        'controller' => 'App\\Http\\Controllers\\Theme\\InventoryController@categories',
        'as' => 'theme.inventory.categories',
        'namespace' => NULL,
        'prefix' => 'theme/inventory',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.inventory.stock' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/inventory/stock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\InventoryController@stock',
        'controller' => 'App\\Http\\Controllers\\Theme\\InventoryController@stock',
        'as' => 'theme.inventory.stock',
        'namespace' => NULL,
        'prefix' => 'theme/inventory',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.sales.customers' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/sales/customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\SalesController@customers',
        'controller' => 'App\\Http\\Controllers\\Theme\\SalesController@customers',
        'as' => 'theme.sales.customers',
        'namespace' => NULL,
        'prefix' => 'theme/sales',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.sales.quotations' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/sales/quotations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\SalesController@quotations',
        'controller' => 'App\\Http\\Controllers\\Theme\\SalesController@quotations',
        'as' => 'theme.sales.quotations',
        'namespace' => NULL,
        'prefix' => 'theme/sales',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.sales.sales-orders' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/sales/sales-orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\SalesController@salesOrders',
        'controller' => 'App\\Http\\Controllers\\Theme\\SalesController@salesOrders',
        'as' => 'theme.sales.sales-orders',
        'namespace' => NULL,
        'prefix' => 'theme/sales',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.sales.invoices' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/sales/invoices',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\SalesController@invoices',
        'controller' => 'App\\Http\\Controllers\\Theme\\SalesController@invoices',
        'as' => 'theme.sales.invoices',
        'namespace' => NULL,
        'prefix' => 'theme/sales',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.sales.suppliers' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/sales/suppliers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\SalesController@suppliers',
        'controller' => 'App\\Http\\Controllers\\Theme\\SalesController@suppliers',
        'as' => 'theme.sales.suppliers',
        'namespace' => NULL,
        'prefix' => 'theme/sales',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.reports.sales-report' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/reports/sales-report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\ReportsController@salesReport',
        'controller' => 'App\\Http\\Controllers\\Theme\\ReportsController@salesReport',
        'as' => 'theme.reports.sales-report',
        'namespace' => NULL,
        'prefix' => 'theme/reports',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.reports.analytics' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/reports/analytics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\ReportsController@analytics',
        'controller' => 'App\\Http\\Controllers\\Theme\\ReportsController@analytics',
        'as' => 'theme.reports.analytics',
        'namespace' => NULL,
        'prefix' => 'theme/reports',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.admin.users' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
          3 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\AdminController@users',
        'controller' => 'App\\Http\\Controllers\\Theme\\AdminController@users',
        'as' => 'theme.admin.users',
        'namespace' => NULL,
        'prefix' => 'theme/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.admin.roles-permissions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/admin/roles-permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
          3 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\AdminController@rolesPermissions',
        'controller' => 'App\\Http\\Controllers\\Theme\\AdminController@rolesPermissions',
        'as' => 'theme.admin.roles-permissions',
        'namespace' => NULL,
        'prefix' => 'theme/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.admin.settings' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/admin/settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
          3 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\AdminController@settings',
        'controller' => 'App\\Http\\Controllers\\Theme\\AdminController@settings',
        'as' => 'theme.admin.settings',
        'namespace' => NULL,
        'prefix' => 'theme/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'theme.admin.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'theme/admin/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'App\\Http\\Middleware\\SuperAdmin',
          2 => 'App\\Http\\Middleware\\SuperAdmin',
          3 => 'admin',
        ),
        'uses' => 'App\\Http\\Controllers\\Theme\\AdminController@profile',
        'controller' => 'App\\Http\\Controllers\\Theme\\AdminController@profile',
        'as' => 'theme.admin.profile',
        'namespace' => NULL,
        'prefix' => 'theme/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:46:"C:\\xampp\\htdocs\\kktechsale\\storage\\app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"000000000000082b0000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local.upload' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:46:"C:\\xampp\\htdocs\\kktechsale\\storage\\app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:325:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ReceiveFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000008330000000000000000";}}',
        'as' => 'storage.local.upload',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
