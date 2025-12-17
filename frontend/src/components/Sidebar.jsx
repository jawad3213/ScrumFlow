import React, { useState, useEffect } from 'react';
import { NavLink, useNavigate } from 'react-router-dom';
import { LayoutDashboard, CheckSquare, Briefcase, PlusCircle, LogOut, Settings, Bell, Calendar, User as UserIcon } from 'lucide-react';

const Sidebar = () => {
    const userRole = localStorage.getItem('user_role');
    const navigate = useNavigate();
    const [user, setUser] = useState({ first_name: 'User', last_name: '', role: '' });

    useEffect(() => {
        try {
            const storedUser = JSON.parse(localStorage.getItem('user'));
            if (storedUser) {
                setUser(storedUser);
            }
        } catch (e) {
            console.error("Failed to parse user", e);
        }
    }, []);

    const handleLogout = () => {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_role');
        localStorage.removeItem('user');
        navigate('/login');
    };

    const navLinkClass = ({ isActive }) =>
        `group flex items-center gap-4 px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-base ${isActive
            ? 'bg-brand-primary/10 text-brand-primary'
            : 'text-neutral-400 hover:text-brand-primary hover:bg-brand-primary/5'
        }`;

    return (
        <aside className="fixed left-0 top-0 h-screen w-[280px] bg-white border-r border-neutral-100 flex flex-col z-30 shadow-sm font-plus-jakarta">
            {/* Logo Section */}
            <div className="p-6 pb-6 flex items-center justify-center">
                <img src="/login/Gemini_Generated_Image_8jllqr8jllqr8jll-removebg-preview.png" alt="TaskFlow Logo" className="w-56 h-20 object-cover" />
            </div>

            {/* Navigation */}
            <nav className="flex-1 px-4 space-y-2 overflow-y-auto custom-scrollbar">
                <div className="px-4 mb-2">
                    <p className="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4 pl-2">Menu</p>
                </div>

                <NavLink to="/dashboard" className={navLinkClass}>
                    <LayoutDashboard size={22} className="stroke-[2.5]" />
                    Dashboard
                </NavLink>
                <NavLink to="/my-tasks" className={navLinkClass}>
                    <CheckSquare size={22} className="stroke-[2.5]" />
                    My Tasks
                </NavLink>

                {/* Additional Placeholder Items to Match Aesthetic */}
                <div className="pt-6 px-4 mb-2">
                    <p className="text-xs font-bold text-neutral-400 uppercase tracking-wider mb-4 pl-2">Management</p>
                </div>

                {userRole === 'chef' && (
                    <NavLink to="/projects/new" className={navLinkClass}>
                        <PlusCircle size={22} className="stroke-[2.5]" />
                        New Project
                    </NavLink>
                )}
                <NavLink to="/calendar" className={navLinkClass}>
                    <Calendar size={22} className="stroke-[2.5]" />
                    Calendar
                </NavLink>
                <NavLink to="/notifications" className={navLinkClass}>
                    <div className="relative">
                        <Bell size={22} className="stroke-[2.5]" />
                        <span className="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </div>
                    Notification
                </NavLink>
                <NavLink to="/settings" className={navLinkClass}>
                    <Settings size={22} className="stroke-[2.5]" />
                    Settings
                </NavLink>
            </nav>

            {/* User Profile Section at Bottom */}
            <div className="p-6 border-t border-neutral-100">
                <div className="bg-neutral-50 p-4 rounded-2xl flex items-center gap-4 group hover:bg-neutral-100 transition-colors cursor-pointer relative">
                    <div className="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600 overflow-hidden border-2 border-white shadow-sm">
                        {/* Placeholder Avatar */}
                        <img
                            src={`https://api.dicebear.com/7.x/notionists/svg?seed=${user.first_name}`}
                            alt="Avatar"
                            className="w-full h-full object-cover"
                        />
                    </div>
                    <div className="flex-1 min-w-0">
                        <h4 className="font-bold text-sm text-neutral-900 truncate">
                            {user.first_name} {user.last_name}
                        </h4>
                        <p className="text-xs font-medium text-neutral-500 truncate capitalize">
                            {userRole === 'chef' ? 'Project Manager' : 'Team Member'}
                        </p>
                    </div>
                    <button
                        onClick={handleLogout}
                        className="p-2 rounded-lg text-neutral-400 hover:text-red-600 hover:bg-white transition-all shadow-sm opacity-0 group-hover:opacity-100 absolute right-2"
                        title="Logout"
                    >
                        <LogOut size={18} />
                    </button>
                </div>
            </div>
        </aside>
    );
};

export default Sidebar;
