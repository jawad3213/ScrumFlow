//import { useState } from 'react'
//import reactLogo from './assets/react.svg'
//import viteLogo from '/vite.svg'
import { BrowserRouter as Router, Routes, Route, BrowserRouter } from "react-router-dom";
import './App.css'
import ForgotPassword from "./pages/ForgotPassword";
import ConfirmNewPass from "./pages/ConfirmNewPass";

function App() {
  //const [count, setCount] = useState(0)

  return (
    <Router>
      <Routes>
        <Route path="/ForgotPassword" element={<ForgotPassword />} />
        <Route path="/ConfirmNewPassword" element={<ConfirmNewPass />} />
      </Routes>
    </Router>
  )
}

export default App
