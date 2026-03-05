<?php

namespace App\Services;


/**
 * Service class for managing role-based dashboard data and configurations
 * 
 * This service provides methods to fetch and organize data based on user roles,
 * making it easy to customize dashboard content for different user types.
 */
class DashboardRoleService
{
    /**
     * Get dashboard configuration for current user role
     */
    public function getDashboardConfig()
    {
        $user = session('user');
        if (empty($user)) {
            return [];
        }

        return $this->getConfigByRole($user->user_type);
    }

    /**
     * Get configuration for specific role
     */
    public function getConfigByRole($role)
    {
        $configs = [
            'admin' => $this->getAdminConfig(),
            'super_admin' => $this->getSuperAdminConfig(),
            'sales_executive' => $this->getSalesExecutiveConfig(),
            'coordinator' => $this->getCoordinatorConfig(),
            'sales_manager' => $this->getSalesManagerConfig(),
            'manager' => $this->getManagerConfig(),
            'vp' => $this->getVPConfig(),
            'director' => $this->getDirectorConfig(),
            'inventory_manager' => $this->getInventoryManagerConfig(),
        ];

        return $configs[$role] ?? $this->getDefaultConfig();
    }

    /**
     * Admin configuration
     */
    private function getAdminConfig()
    {
        return [
            'dashboardTitle' => 'Admin Dashboard',
            'sections' => [
                'system_stats' => true,
                'user_management' => true,
                'all_reports' => true,
                'inventory' => true,
                'sales' => true,
                'financial' => true,
            ],
            'reports' => ['all'],
            'dataScope' => 'all',
            'canEditSettings' => true,
            'canManageUsers' => true,
            'canViewAnalytics' => true,
            'cardsToShow' => [
                'total_revenue',
                'total_sales',
                'active_customers',
                'total_products',
                'system_users',
                'orders_pending'
            ]
        ];
    }

    /**
     * Super Admin configuration
     */
    private function getSuperAdminConfig()
    {
        return array_merge($this->getAdminConfig(), [
            'dashboardTitle' => 'System Administration',
            'canManageCompanies' => true,
            'canManageRoles' => true,
        ]);
    }

    /**
     * Sales Executive configuration
     */
    private function getSalesExecutiveConfig()
    {
        return [
            'dashboardTitle' => 'My Sales Dashboard',
            'sections' => [
                'my_leads' => true,
                'my_quotations' => true,
                'my_orders' => true,
            ],
            'reports' => ['my_performance', 'my_sales'],
            'dataScope' => 'self',
            'restrictToOwnData' => true,
            'canEditSettings' => false,
            'canManageUsers' => false,
            'canViewAnalytics' => false,
            'cardsToShow' => [
                'my_total_sales',
                'my_leads_count',
                'my_conversion_rate',
                'my_pending_quotations'
            ]
        ];
    }

    /**
     * Coordinator configuration
     */
    private function getCoordinatorConfig()
    {
        return [
            'dashboardTitle' => 'Coordination Dashboard',
            'sections' => [
                'team_leads' => true,
                'team_quotations' => true,
                'team_orders' => true,
                'team_performance' => true,
            ],
            'reports' => ['team_performance', 'sales_report'],
            'dataScope' => 'team',
            'canEditSettings' => false,
            'canManageUsers' => false,
            'canViewAnalytics' => true,
            'cardsToShow' => [
                'team_total_sales',
                'team_leads_count',
                'team_conversion_rate',
                'team_top_performers'
            ]
        ];
    }

    /**
     * Sales Manager configuration
     */
    private function getSalesManagerConfig()
    {
        return [
            'dashboardTitle' => 'Sales Manager Dashboard',
            'sections' => [
                'team_stats' => true,
                'team_reports' => true,
                'performance_metrics' => true,
            ],
            'reports' => ['sales_report', 'team_performance', 'analytics'],
            'dataScope' => 'team_and_reports',
            'canEditSettings' => false,
            'canManageUsers' => false,
            'canViewAnalytics' => true,
            'cardsToShow' => [
                'team_revenue',
                'team_orders',
                'average_order_value',
                'conversion_rate',
                'top_performers'
            ]
        ];
    }

    /**
     * Manager configuration
     */
    private function getManagerConfig()
    {
        return [
            'dashboardTitle' => 'Manager Dashboard',
            'sections' => [
                'inventory' => true,
                'sales' => true,
                'team_reports' => true,
                'financial' => true,
            ],
            'reports' => ['all_reports'],
            'dataScope' => 'company',
            'canEditSettings' => false,
            'canManageUsers' => false,
            'canViewAnalytics' => true,
            'cardsToShow' => [
                'total_revenue',
                'total_sales',
                'inventory_status',
                'team_performance',
                'financial_summary'
            ]
        ];
    }

    /**
     * Vice President configuration
     */
    private function getVPConfig()
    {
        return [
            'dashboardTitle' => 'Executive Dashboard',
            'sections' => [
                'all_departments' => true,
                'strategic_metrics' => true,
                'company_performance' => true,
                'financial_overview' => true,
            ],
            'reports' => ['executive_reports', 'strategic_analysis'],
            'dataScope' => 'company',
            'canEditSettings' => false,
            'canManageUsers' => false,
            'canViewAnalytics' => true,
            'cardsToShow' => [
                'profit_loss',
                'year_over_year_growth',
                'market_share',
                'department_performance',
                'strategic_initiatives'
            ]
        ];
    }

    /**
     * Director configuration
     */
    private function getDirectorConfig()
    {
        return array_merge($this->getVPConfig(), [
            'dashboardTitle' => 'Director Dashboard',
            'sections' => array_merge($this->getVPConfig()['sections'], [
                'board_reports' => true,
            ]),
        ]);
    }

    /**
     * Inventory Manager configuration
     */
    private function getInventoryManagerConfig()
    {
        return [
            'dashboardTitle' => 'Inventory Management',
            'sections' => [
                'stock_levels' => true,
                'inventory_alerts' => true,
                'warehouse_management' => true,
            ],
            'reports' => ['inventory_report', 'stock_report'],
            'dataScope' => 'inventory',
            'canEditSettings' => false,
            'canManageUsers' => false,
            'canViewAnalytics' => false,
            'cardsToShow' => [
                'total_products',
                'low_stock_items',
                'inventory_value',
                'recent_transactions'
            ]
        ];
    }

    /**
     * Default configuration for unrecognized roles
     */
    private function getDefaultConfig()
    {
        return [
            'dashboardTitle' => 'Dashboard',
            'sections' => [
                'my_data' => true,
            ],
            'reports' => [],
            'dataScope' => 'self',
            'canEditSettings' => false,
            'canManageUsers' => false,
            'canViewAnalytics' => false,
            'cardsToShow' => []
        ];
    }

    /**
     * Generate menu items based on role
     */
    public function getMenuItems()
    {
        $user = session('user');
        if (empty($user)) {
            return [];
        }

        return $this->getMenuItemsByRole($user->user_type);
    }

    /**
     * Get menu items for specific role
     */
    public function getMenuItemsByRole($role)
    {
        $baseMenus = [];

        switch ($role) {
            case 'admin':
            case 'super_admin':
                $baseMenus = [
                    'dashboard',
                    'inventory',
                    'sales',
                    'reports',
                    'admin'
                ];
                break;

            case 'sales_executive':
            case 'coordinator':
                $baseMenus = [
                    'dashboard',
                    'sales',
                ];
                break;

            case 'sales_manager':
            case 'manager':
                $baseMenus = [
                    'dashboard',
                    'sales',
                    'reports',
                    'inventory'
                ];
                break;

            case 'vp':
            case 'director':
                $baseMenus = [
                    'dashboard',
                    'reports',
                ];
                break;

            case 'inventory_manager':
                $baseMenus = [
                    'dashboard',
                    'inventory',
                ];
                break;

            default:
                $baseMenus = [
                    'dashboard',
                ];
        }

        return $baseMenus;
    }
}
