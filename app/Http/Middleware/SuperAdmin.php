<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(session('token'))) {
            session()->flash('error', 'Session expired');
            return redirect('/');
        } else {

            // allow any user type that has a valid token in session
            $user = User::where('token', session('token'))->first();
            if (empty($user)) {
                session()->flush();
                session()->flash('error', 'Session expired or someone login your account');
                return redirect('/');
            } else {
                // store user in session and share with views
                session()->put('user', $user);
                View::share('user', $user);

                // also set the Laravel Auth user so legacy Auth::user() calls continue to work
                try {
                    Auth::setUser($user);
                } catch (\Throwable $e) {
                }

                $child_ids = $iterable = [];
                array_push($iterable, $user->id);
                
                while (is_countable($iterable) && sizeof($iterable) > 0) {
                    $child_ids = array_merge($child_ids, $iterable);
                    try {
                        $users = User::whereIn("parent_id", $iterable)->get();
                        $iterable = [];
                        foreach ($users as $value) {
                            array_push($iterable, $value->id);
                        }
                    } catch (\Throwable $th) {
                        // Skip silently if parent_id column doesn't exist
                        break;
                    }
                }
                
                // Clean up child_ids and trim whitespace
                $child_id = array_map('trim', $child_ids);
                
                // Fetch role permissions if tables exist and user has a role
                $rolePermissions = [];
                try {
                    if (!empty($user->role_id)) {
                        $rolePermissions = DB::table("role_permission as a")
                            ->select("a.*", "b.name")
                            ->join("permission_mst as b", "a.permission_id", "b.id")
                            ->where("role_id", $user->role_id)
                            ->get();
                    }
                } catch (\Throwable $e) {
                    // Table might not exist, continue without permissions
                }
                
                View::share('rolePermissions', $rolePermissions);
                $request->merge(["user" => $user, "userIds" => $child_id]);

                return $next($request);
            }
        }
    }
}
