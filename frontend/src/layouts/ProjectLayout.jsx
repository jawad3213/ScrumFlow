import React from 'react';
import { Outlet, NavLink, useParams } from 'react-router-dom';

const ProjectLayout = () => {
    const { id } = useParams();
    const userRole = localStorage.getItem('user_role');

    return (
        <div className="flex flex-col gap-6">
            <div className="bg-white p-4 rounded-xl border border-neutral-200 shadow-sm">
                <h1 className="text-2xl font-bold mb-4">Project {id}</h1> {/* Placeholder for Project Name */}
                <div className="flex gap-1 overflow-x-auto pb-2">
                    <NavLink to="." end className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                        Dashboard
                    </NavLink>
                    <NavLink to="board" className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                        Board
                    </NavLink>
                    <NavLink to="backlog" className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                        Backlog
                    </NavLink>
                    <NavLink to="my-space" className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                        My Space
                    </NavLink>

                    {userRole === 'chef' && (
                        <>
                            <NavLink to="analysis" className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                                Analysis
                            </NavLink>
                            <NavLink to="team" className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                                Team
                            </NavLink>
                            <NavLink to="financials" className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                                Financials
                            </NavLink>
                            <NavLink to="settings" className={({ isActive }) => `px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap ${isActive ? 'bg-brand-primary text-white' : 'text-neutral-600 hover:bg-neutral-50'}`}>
                                Settings
                            </NavLink>
                        </>
                    )}
                </div>
            </div>
            <Outlet />
        </div>
    );
};

export default ProjectLayout;
