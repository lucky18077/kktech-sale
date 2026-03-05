<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Lead statistics by status
        $stats = DB::table('leads')
            ->selectRaw('
                SUM(CASE WHEN status = "NEW LEAD" THEN 1 ELSE 0 END) as new_leads,
                SUM(CASE WHEN status = "PENDING" THEN 1 ELSE 0 END) as pending_leads,
                SUM(CASE WHEN status = "PROCESSING" THEN 1 ELSE 0 END) as processing_leads,
                SUM(CASE WHEN status = "CALL SCHEDULED" THEN 1 ELSE 0 END) as call_scheduled,
                SUM(CASE WHEN status = "VISIT SCHEDULED" THEN 1 ELSE 0 END) as visit_scheduled,
                SUM(CASE WHEN status = "VISIT DONE" THEN 1 ELSE 0 END) as visit_done,
                SUM(CASE WHEN status = "CONVERTED" THEN 1 ELSE 0 END) as converted_leads,
                SUM(CASE WHEN status = "LOST" THEN 1 ELSE 0 END) as lost_leads
            ')
            ->first();

        // Today's leads
        $today_leads = DB::table('leads')->whereDate('lead_date', today())->count();
        
        // This month's leads
        $month_leads = DB::table('leads')->whereMonth('lead_date', now()->month)->count();
        
        // All leads
        $total_leads = DB::table('leads')->count();
        
        // Today's attendance
        $today_attendance = DB::table('attendance')->whereDate('attendance_date', today())->count();
        
        // Quote statistics
        $requested_quotes = DB::table('quotes_mst')->where('status', 'DRAFT')->count();
        $generated_quotes = DB::table('quotes_mst')->where('status', 'SENT')->count();
        $requested_pi = DB::table('quotes_mst')->where('status', 'PENDING')->count();
        $generated_pi = DB::table('quotes_mst')->where('status', 'APPROVED')->count();

        // Weekly lead statistics for chart
        $weekStartDate = now()->startOfWeek();
        $weekData = [];
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        $weeklyStats = DB::table('leads')
            ->selectRaw('DAYNAME(lead_date) as day_of_week,
                SUM(CASE WHEN status = "NEW LEAD" THEN 1 ELSE 0 END) as new_lead_count,
                SUM(CASE WHEN status = "PENDING" THEN 1 ELSE 0 END) as pending_lead_count,
                SUM(CASE WHEN status = "PROCESSING" THEN 1 ELSE 0 END) as processing_lead_count,
                SUM(CASE WHEN status = "CALL SCHEDULED" THEN 1 ELSE 0 END) as call_scheduled_lead_count,
                SUM(CASE WHEN status = "VISIT SCHEDULED" THEN 1 ELSE 0 END) as visit_scheduled_lead_count,
                SUM(CASE WHEN status = "CONVERTED" THEN 1 ELSE 0 END) as converted_lead_count')
            ->whereBetween('lead_date', [$weekStartDate, $weekStartDate->copy()->endOfWeek()])
            ->groupBy('day_of_week')
            ->get()
            ->keyBy('day_of_week');

        // Build arrays for each status
        $newLeads = [];
        $pendingLeads = [];
        $processingLeads = [];
        $callScheduledLeads = [];
        $visitScheduledLeads = [];
        $convertedLeads = [];

        foreach ($days as $day) {
            $data = $weeklyStats->get($day) ?? (object)[
                'new_lead_count' => 0,
                'pending_lead_count' => 0,
                'processing_lead_count' => 0,
                'call_scheduled_lead_count' => 0,
                'visit_scheduled_lead_count' => 0,
                'converted_lead_count' => 0
            ];

            $newLeads[] = $data->new_lead_count ?? 0;
            $pendingLeads[] = $data->pending_lead_count ?? 0;
            $processingLeads[] = $data->processing_lead_count ?? 0;
            $callScheduledLeads[] = $data->call_scheduled_lead_count ?? 0;
            $visitScheduledLeads[] = $data->visit_scheduled_lead_count ?? 0;
            $convertedLeads[] = $data->converted_lead_count ?? 0;
        }

        $chartData = json_encode([
            ['name' => 'New Leads', 'data' => $newLeads],
            ['name' => 'Pending Leads', 'data' => $pendingLeads],
            ['name' => 'Processing Leads', 'data' => $processingLeads],
            ['name' => 'Call Scheduled', 'data' => $callScheduledLeads],
            ['name' => 'Visit Scheduled', 'data' => $visitScheduledLeads],
            ['name' => 'Converted Leads', 'data' => $convertedLeads],
        ]);

        return view('admin.dashboard', [
            'stats' => (array)$stats,
            'today_leads' => $today_leads,
            'month_leads' => $month_leads,
            'total_leads' => $total_leads,
            'today_attendance' => $today_attendance,
            'requested_quotes' => $requested_quotes,
            'generated_quotes' => $generated_quotes,
            'requested_pi' => $requested_pi,
            'generated_pi' => $generated_pi,
            'chartData' => $chartData,
        ]);
    }

    // Preview route to view admin dashboard with Dreams theme
    public function theme()
    {
        // reuse index data by calling index and extracting view data
        $response = $this->index();
        $data = $response->getData();
        return view('admin.theme-dashboard', (array)$data);
    }
}
