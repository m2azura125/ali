import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import LoginPage from './pages/LoginPage';
import ResidentDashboard from './pages/ResidentDashboard';
import AdminDashboard from './pages/AdminDashboard';
import HouseDetail from './pages/HouseDetail';
import Settings from './pages/Settings';

export default function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<LoginPage />} />
        <Route path="/resident" element={<ResidentDashboard />} />
        <Route path="/resident/*" element={<ResidentDashboard />} />
        
        <Route path="/admin" element={<AdminDashboard />} />
        <Route path="/admin/grid" element={<AdminDashboard />} />
        <Route path="/admin/alerts" element={<AdminDashboard />} />
        <Route path="/admin/house/:id" element={<HouseDetail />} />
        <Route path="/admin/settings" element={<Settings />} />
        
        <Route path="*" element={<Navigate to="/" replace />} />
      </Routes>
    </BrowserRouter>
  );
}
