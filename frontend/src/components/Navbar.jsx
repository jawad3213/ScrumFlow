import React, { useState, useEffect } from 'react';
import { User } from 'lucide-react';

const Navbar = () => {
    const [user, setUser] = useState(null);

    useEffect(() => {
        const storedUser = localStorage.getItem('user');
        if (storedUser) {
            setUser(JSON.parse(storedUser));
        }
    }, []);

    return (
        <header className="h-16 bg-white border-b border-neutral-200 flex items-center justify-between px-8 sticky top-0 z-10 w-full">
            <h2 className="text-lg font-semibold text-neutral-800">
                Welcome back, {user ? user.first_name : 'User'}
            </h2>
            <div className="flex items-center gap-4">
                <div className="w-10 h-10 bg-neutral-100 rounded-full flex items-center justify-center text-neutral-600">
                    <User size={20} />
                </div>
            </div>
        </header>
    );
};

export default Navbar;
