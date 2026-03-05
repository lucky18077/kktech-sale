<?php

/**
 * Role and Permission Helper Functions
 * 
 * These helper functions can be used throughout the application
 * for quick role checks and permission validation.
 * 
 * Usage in blade:
 * @if(userHasRole('admin'))
 *     <!-- Admin content -->
 * @endif
 * 
 * Usage in controllers:
 * if (userHasRole('sales_executive')) {
 *     // Do something
 * }
 */

if (!function_exists('userHasRole')) {
    /**
     * Check if authenticated user has the specified role
     * 
     * @param string|array $roles
     * @return bool
     */
    function userHasRole($roles)
    {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        $userType = $user->user_type;

        if (is_array($roles)) {
            return in_array($userType, $roles);
        }

        return $userType === $roles;
    }
}

if (!function_exists('userHasAnyRole')) {
    /**
     * Check if authenticated user has any of the specified roles
     * 
     * @param array $roles
     * @return bool
     */
    function userHasAnyRole($roles)
    {
        return userHasRole($roles);
    }
}

if (!function_exists('isAdmin')) {
    /**
     * Check if authenticated user is admin
     * 
     * @return bool
     */
    function isAdmin()
    {
        return userHasRole(['admin', 'super_admin']);
    }
}

if (!function_exists('isSalesRole')) {
    /**
     * Check if authenticated user has sales-related role
     * 
     * @return bool
     */
    function isSalesRole()
    {
        return userHasRole(['sales_executive', 'coordinator', 'sales_manager']);
    }
}

if (!function_exists('isManagerRole')) {
    /**
     * Check if authenticated user is manager/executive
     * 
     * @return bool
     */
    function isManagerRole()
    {
        return userHasRole(['vp', 'manager', 'director', 'sales_manager']);
    }
}

if (!function_exists('isInventoryRole')) {
    /**
     * Check if authenticated user manages inventory
     * 
     * @return bool
     */
    function isInventoryRole()
    {
        return userHasRole('inventory_manager');
    }
}

if (!function_exists('getUserType')) {
    /**
     * Get current user's role/type
     * 
     * @return string|null
     */
    function getUserType()
    {
        return auth()->user()?->user_type ?? 'guest';
    }
}

if (!function_exists('canAccessPage')) {
    /**
     * Check if user can access a specific page
     * 
     * @param string $page
     * @return bool
     */
    function canAccessPage($page)
    {
        $userType = getUserType();

        $pageAccess = [
            'inventory.products' => ['admin', 'inventory_manager'],
            'inventory.categories' => ['admin', 'inventory_manager'],
            'inventory.stock' => ['admin', 'inventory_manager'],
            
            'sales.customers' => ['admin', 'sales_executive', 'coordinator'],
            'sales.quotations' => ['admin', 'sales_executive', 'coordinator'],
            'sales.sales-orders' => ['admin', 'sales_executive', 'coordinator'],
            'sales.invoices' => ['admin', 'sales_executive', 'coordinator'],
            'sales.suppliers' => ['admin', 'sales_executive', 'coordinator'],
            
            'reports.sales-report' => ['admin', 'manager', 'vp', 'sales_manager'],
            'reports.analytics' => ['admin', 'manager', 'vp', 'sales_manager'],
            
            'admin.users' => ['admin', 'super_admin'],
            'admin.roles-permissions' => ['admin', 'super_admin'],
            'admin.settings' => ['admin', 'super_admin'],
            'admin.profile' => ['admin', 'sales_executive', 'coordinator', 'sales_manager', 'manager', 'vp', 'inventory_manager'],
        ];

        if (!isset($pageAccess[$page])) {
            return false;
        }

        return in_array($userType, $pageAccess[$page]);
    }
}

if (!function_exists('getMenuVisibility')) {
    /**
     * Get menu items visibility for current user
     * 
     * @return array
     */
    function getMenuVisibility()
    {
        $userType = getUserType();

        $visibility = [
            'inventory' => false,
            'sales' => false,
            'reports' => false,
            'admin' => false,
            'profile' => true, // Always visible
        ];

        switch ($userType) {
            case 'admin':
            case 'super_admin':
                $visibility = array_fill_keys(array_keys($visibility), true);
                break;

            case 'sales_executive':
            case 'coordinator':
                $visibility['sales'] = true;
                break;

            case 'inventory_manager':
                $visibility['inventory'] = true;
                break;

            case 'sales_manager':
            case 'manager':
            case 'vp':
            case 'director':
                $visibility['sales'] = true;
                $visibility['reports'] = true;
                break;
        }

        return $visibility;
    }
}

if (!function_exists('getRoleDescription')) {
    /**
     * Get human-readable description for a role
     * 
     * @param string $role
     * @return string
     */
    function getRoleDescription($role)
    {
        $descriptions = [
            'admin' => 'Administrator',
            'super_admin' => 'Super Administrator',
            'sales_executive' => 'Sales Executive',
            'coordinator' => 'Coordinator',
            'sales_manager' => 'Sales Manager',
            'manager' => 'Manager',
            'vp' => 'Vice President',
            'director' => 'Director',
            'inventory_manager' => 'Inventory Manager',
        ];

        return $descriptions[$role] ?? ucfirst(str_replace('_', ' ', $role));
    }
}
