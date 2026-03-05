<?php

namespace App\Traits;


/**
 * Trait for handling role-based access and permissions
 * 
 * Usage:
 * class YourController extends Controller
 * {
 *     use HasRoleAccess;
 * 
 *     public function yourMethod()
 *     {
 *         if ($this->userHasRole('admin')) {
 *             // Admin specific code
 *         }
 *     }
 * }
 */
trait HasRoleAccess
{
    /**
     * Check if current user has a specific role
     */
    public function userHasRole($role)
    {
        $userType = optional(session('user'))->user_type;
        
        if (is_array($role)) {
            return in_array($userType, $role);
        }
        
        return $userType === $role;
    }

    /**
     * Check if current user has any of the specified roles
     */
    public function userHasAnyRole($roles)
    {
        $userType = optional(session('user'))->user_type;
        return in_array($userType, (array)$roles);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->userHasRole(['admin', 'super_admin']);
    }

    /**
     * Check if user is sales role
     */
    public function isSalesRole()
    {
        return $this->userHasRole(['sales_executive', 'coordinator', 'sales_manager']);
    }

    /**
     * Check if user is manager/vp
     */
    public function isManagerRole()
    {
        return $this->userHasRole(['vp', 'manager', 'director', 'sales_manager']);
    }

    /**
     * Get role-specific data (example implementation)
     */
    public function getRoleSpecificData($dataType = 'dashboard')
    {
        $userType = optional(session('user'))->user_type;

        switch ($dataType) {
            case 'dashboard':
                return $this->getDashboardData($userType);
            case 'reports':
                return $this->getReportData($userType);
            case 'menus':
                return $this->getMenuItems($userType);
            default:
                return [];
        }
    }

    /**
     * Get dashboard data based on user role
     */
    protected function getDashboardData($userType)
    {
        $data = [];

        switch ($userType) {
            case 'admin':
            case 'super_admin':
                $data = [
                    'showSystemStats' => true,
                    'showUserManagement' => true,
                    'showAllReports' => true,
                ];
                break;

            case 'sales_executive':
            case 'coordinator':
                $data = [
                    'showMyLeads' => true,
                    'showMyQuotations' => true,
                    'showMyOrders' => true,
                    'restrictToMyData' => true,
                ];
                break;

            case 'sales_manager':
            case 'manager':
                $data = [
                    'showTeamStats' => true,
                    'showTeamReports' => true,
                    'showPerformanceMetrics' => true,
                ];
                break;

            case 'vp':
            case 'director':
                $data = [
                    'showExecutiveDashboard' => true,
                    'showAllCompanyMetrics' => true,
                    'showStrategyData' => true,
                ];
                break;

            default:
                $data = [
                    'showLimitedDashboard' => true,
                ];
        }

        return $data;
    }

    /**
     * Get report data based on user role
     */
    protected function getReportData($userType)
    {
        $reports = [];

        switch ($userType) {
            case 'admin':
            case 'super_admin':
                $reports = ['all_reports'];
                break;

            case 'sales_manager':
            case 'manager':
                $reports = ['sales_reports', 'team_performance', 'analytics'];
                break;

            case 'sales_executive':
            case 'coordinator':
                $reports = ['my_sales', 'my_performance'];
                break;

            default:
                $reports = ['basic_reports'];
        }

        return $reports;
    }

    /**
     * Get menu visibility based on user role
     */
    protected function getMenuItems($userType)
    {
        $menus = [
            'inventory' => false,
            'sales' => false,
            'reports' => false,
            'admin' => false,
        ];

        switch ($userType) {
            case 'admin':
            case 'super_admin':
                $menus = array_fill_keys(array_keys($menus), true);
                break;

            case 'sales_executive':
            case 'coordinator':
                $menus['sales'] = true;
                break;

            case 'inventory_manager':
                $menus['inventory'] = true;
                break;

            case 'sales_manager':
            case 'manager':
            case 'vp':
            case 'director':
                $menus['sales'] = true;
                $menus['reports'] = true;
                break;
        }

        return $menus;
    }
}
