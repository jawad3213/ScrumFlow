import React from 'react';
import { Navigate, useLocation } from 'react-router-dom';

const RoleGuard = ({ children, role }) => {
    const userRole = localStorage.getItem('user_role');
    const authToken = localStorage.getItem('auth_token');
    const location = useLocation();

    if (!authToken) {
        return <Navigate to="/login" state={{ from: location }} replace />;
    }

    // If a specific role is required
    if (role) {
        // Mapping 'admin' requirement to 'chef' role
        const requiredRole = role === 'admin' ? 'chef' : role;

        if (userRole !== requiredRole) {
            // Unauthorized access, redirect to dashboard or home
            return <Navigate to="/dashboard" replace />;
        }
    }

    return children;
};

export default RoleGuard;
