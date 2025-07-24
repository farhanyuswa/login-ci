import React from 'react';
import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer
} from 'recharts';

const data = [
  { name: 'Jan', ekspor: 400, impor: 240 },
  { name: 'Feb', ekspor: 300, impor: 139 },
  { name: 'Mar', ekspor: 200, impor: 980 },
  { name: 'Apr', ekspor: 278, impor: 390 },
];

const DashboardPage: React.FC = () => {
  return (
    <div className="container py-5">
      <div className="mb-4 text-center">
        <h2 className="fw-bold text-primary">Dashboard Ekspor-Impor</h2>
        <p className="text-muted">Statistik kegiatan ekspor dan impor per bulan</p>
      </div>

      <div className="card shadow-sm">
        <div className="card-body">
          <ResponsiveContainer width="100%" height={300}>
            <BarChart data={data}>
              <CartesianGrid strokeDasharray="3 3" />
              <XAxis dataKey="name" />
              <YAxis />
              <Tooltip />
              <Bar dataKey="ekspor" fill="#0d6efd" name="Ekspor" />
              <Bar dataKey="impor" fill="#198754" name="Impor" />
            </BarChart>
          </ResponsiveContainer>
        </div>
      </div>
    </div>
  );
};

export default DashboardPage;
