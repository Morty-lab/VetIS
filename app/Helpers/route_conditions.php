<?php

if (!function_exists('getAccessibleRoutes')) {
    function getAccessibleRoutes($role, $position = null) {
        switch ($role) {
            case 'admin':
                return [
                    'dashboard', 'owners.index', 'pet.index', 'doctor.index', 'appointments.index',
                    'schedule.index', 'billing', 'pos', 'products.index', 'suppliers.index',
                    'categories.index', 'units.index', 'admin.manage', 'staffs.index'
                ];
            case 'veterinary':
                return ['appointments.index', 'managepet'];
            case 'secretary':
                return ['appointments.index', 'owners.index', 'managepet'];
            case 'cashier':
                return ['billing', 'pos'];
            case 'staff':
                return ['products.index', 'suppliers.index', 'categories.index', 'units.index'];
        }
        return [];
    }
}
