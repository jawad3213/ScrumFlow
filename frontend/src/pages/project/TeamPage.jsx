import React from 'react';
import { useParams } from 'react-router-dom';

const TeamPage = () => {
    const { id } = useParams();
    return (
        <div className="page-container">
            <h1>Project {id} - Team Management</h1>
            <p>Add members, define roles and daily rates.</p>
        </div>
    );
};

export default TeamPage;
