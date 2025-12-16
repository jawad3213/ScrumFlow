import { useState } from "react";
import { useSearchParams } from "react-router-dom";
import loginImage from '../assets/login-image.jpg';
import logoImage from '../assets/Logo.png';


export default function ConfirmNewPass() {
    const [searchParams] = useSearchParams();
    const token = searchParams.get("token");

    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [message, setMessage] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();
        console.log("Formulaire soumis", { email, password, confirmPassword, token });

        if(!token){
            setMessage("Lien invalide ou token manquant.");
            return;
        }
        if (!email) {
        setMessage("Veuillez entrer votre email.");
        return;
        }

        if (password.length < 6) {
            setMessage("Le mot de passe doit contenir au moins 6 caractères.");
            return;
        }

        if (password !== confirmPassword) {
            setMessage("Les mots de passe ne correspondent pas.");
            return;
        }
        const response = await fetch("http://localhost:8000/api/reset-password", {
            method: "POST",
            headers: {"Content-Type": "application/json" },
            body: JSON.stringify({
                token: token,
                email: email,
                password: password,
                password_confirmation: confirmPassword
            })
        });
        if(response.ok){
            setMessage("Mot de passe réinitialisé avec succès !");
        } else {
            setMessage("Le lien est invalide ou expiré.");
        }
        console.log(response);

    };

    const handleCancel = () => {
        window.history.back();
    };

    return (
        <div className="container">

            {/* LEFT COLUMN */}
            <div className="leftColumn">
                <img src={loginImage} alt="Security" className="leftImage" />

                <h2 className="headline">Reset Your Password</h2>

                <p className="description">
                    Renforcez la sécurité de votre compte en choisissant un nouveau mot de passe.
                    Toutes vos informations resteront protégées avec nos standards modernes.
                </p>

                <ul className="featureList">
                    <li className="featureItem">Cryptage avancé AES-256</li>
                    <li className="featureItem">Gestion intelligente de session</li>
                    <li className="featureItem">Contrôles de sécurité renforcés</li>
                </ul>
            </div>

            {/* RIGHT COLUMN */}
            <div className="rightColumn">
                {/* --- LOGO --- */}
                <div className="rightHeader">
                    <img src={logoImage} alt="Logo" className="appLogo" />
                    <span className="appName">TaskFlow</span>
                </div>
                <h1>Créer un nouveau mot de passe</h1>

                <p className="subtitle">
                    Entrez un mot de passe fort afin de garder votre compte sécurisé
                </p>

                <form onSubmit={handleSubmit}>
                    <label htmlFor="email" className="loginTitle">Entrer votre email</label>
                    <div className="inputGroup">
                        <input
                            id="email"
                            type="email"
                            className="inputField"
                            placeholder="ex: user@company.com"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                        />
                    </div>
                    {/* NEW PASSWORD */}
                    <label htmlFor="password" className="loginTitle">Nouveau mot de passe</label>
                    <div className="inputGroup">
                        <input
                            id="password"
                            type="password"
                            className="inputField"
                            placeholder="••••••••••"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                        />
                    </div>

                    {/* CONFIRM PASSWORD */}
                    <label htmlFor="confirmPassword" className="loginTitle">Confirmer le mot de passe</label>
                    <div className="inputGroup">
                        <input
                            id="confirmPassword"
                            type="password"
                            className="inputField"
                            placeholder="••••••••••"
                            value={confirmPassword}
                            onChange={(e) => setConfirmPassword(e.target.value)}
                        />
                    </div>

                    {message && (
                        <p style={{ color: "#2563eb", marginBottom: "1.5vh", fontWeight: 500 }}>
                            {message}
                        </p>
                    )}

                    {/* SUBMIT BUTTON */}
                    <button
                        className="loginButton"
                        type="submit"
                        disabled={!password || !confirmPassword}
                        style={{ opacity: (!password || !confirmPassword) ? 0.6 : 1 }}
                        
                    >
                        Réinitialiser le mot de passe
                    </button>

                    {/* CANCEL BUTTON */}
                    <button
                        className="loginButton"
                        type="button"
                        style={{ backgroundColor: "#6b7280" }}
                        onClick={handleCancel}
                    >
                        Annuler
                    </button>
                </form>
            </div>
        </div>
    );
}
