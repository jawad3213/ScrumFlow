import { useState } from "react";
import loginImage from '../assets/login-image.jpg';
import logoImage from '../assets/Logo.png';
import './style.css';
import { useNavigate } from "react-router-dom";

export default function ForgotPassword() {

    const [inputemail, setInputEmail] = useState('');
    const [message, setMessage] = useState('');
    const navigate = useNavigate();

    const handleSearch = async (e) => {
        e.preventDefault();
        
        const response = await fetch("http://localhost:8000/api/forgot-password",{
            method:"POST",
            headers: { "Content-Type": "application/json"},
            body: JSON.stringify({email: inputemail})
        });
        if(response.ok){
            setMessage("Un email de réinitialisation a été envoyé !");
        } else {
            setMessage("Cet email n'existe pas !");
        }
       
    };

    const handleReset = (e) => {
        e.preventDefault();
        setInputEmail('');
        setMessage('');
        navigate('/')
    };

    return (
        <div className="container">

            {/* --- LEFT COLUMN --- */}
            <div className="leftColumn">
                <img src={loginImage} alt="Workflow" className="leftImage" />

                <h2 className="headline">Streamline Your Workflow</h2>

                <p className="description">
                    Organize tasks, collaborate with your team, and boost productivity with our comprehensive task management platform.
                </p>

                <ul className="featureList">
                    <li className="featureItem">Real-time collaboration</li>
                    <li className="featureItem">Advanced project tracking</li>
                    <li className="featureItem">Intelligent task prioritization</li>
                </ul>
            </div>

            {/* --- RIGHT COLUMN --- */}
            <div className="rightColumn">
                 {/* --- LOGO --- */}
                <div className="rightHeader">
                    <img src={logoImage} alt="Logo" className="appLogo" />
                    <span className="appName">TaskFlow</span>
                </div>


                <h1>Trouver votre compte</h1>
                <p className="subtitle">Veuillez entrer votre email pour réinitialiser votre mot de passe</p>

                <form onSubmit={handleSearch}>

                    <label className="loginTitle">Email Address</label>

                    <div className="inputGroup">
                        <input 
                            type="email"
                            className="inputField"
                            placeholder="user@company.com"
                            value={inputemail}
                            onChange={(e) => setInputEmail(e.target.value)}
                        />
                    </div>

                    {message && (
                        <p style={{ color: "#2563eb", marginBottom: "1.5vh" }}>
                            {message}
                        </p>
                    )}

                    <button 
                        className="loginButton" 
                        type="submit"
                        disabled={!inputemail}
                        style={{ opacity: !inputemail ? 0.5 : 1 }}
                    >
                        Réinitialiser le mot de passe
                    </button>

                    <button 
                        className="loginButton" 
                        type="button"
                        style={{ background: "#6b7280" }}
                        onClick={handleReset}
                    >
                        Annuler
                    </button>

                </form>

            </div>

        </div>
    );
}
