<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRole = auth()->user()->roles; // Assuming `roles` is a column in `users` table

        // Check if user role matches any of the given roles
        foreach ($roles as $role) {
            if ($role == $userRole) {
                return $next($request);
            }
        }

        // Redirect based on user role if not authorized
        return $this->redirectToRoleBase($userRole);
    }

    /**
     * Redirect user based on their role.
     *
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function redirectToRoleBase($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('home');
            case 'user':
                return redirect()->route('service-mahasiswa.upload-berkas');
            default:
                return abort(403);
        }
    }
}
