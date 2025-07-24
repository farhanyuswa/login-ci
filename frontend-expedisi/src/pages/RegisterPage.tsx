import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const RegisterPage: React.FC = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [message, setMessage] = useState('');
  const navigate = useNavigate();

  const handleRegister = async (e: React.FormEvent) => {
    e.preventDefault();

    if (!email || !password) {
      setMessage('❗ Email dan password tidak boleh kosong.');
      return;
    }

    try {
      const res = await axios.post(
        'https://kuliahkaryawan.site/api/auth/register', // ✅ tanpa index.php
        { email, password },
        { headers: { 'Content-Type': 'application/json' } }
      );

      if (res.data.status === 'success') {
        setMessage('✅ Registrasi berhasil. Mengarahkan ke login...');
        setTimeout(() => navigate('/'), 2000);
      } else {
        setMessage(`❌ ${res.data.message || 'Registrasi gagal'}`);
      }
    } catch (error: any) {
      if (error.response?.data?.message) {
        setMessage(`❌ ${error.response.data.message}`);
      } else {
        setMessage('❌ Gagal registrasi. Server tidak merespon atau bermasalah.');
      }
    }
  };

  return (
    <div className="d-flex align-items-center justify-content-center vh-100 bg-light">
      <div className="card shadow p-4" style={{ maxWidth: '400px', width: '100%' }}>
        <h2 className="text-center mb-4 text-success">Daftar Akun</h2>
        {message && (
          <div className="alert alert-info text-center py-2 mb-4">
            {message}
          </div>
        )}
        <form onSubmit={handleRegister}>
          <div className="mb-3">
            <label className="form-label">Email</label>
            <input
              type="email"
              className="form-control"
              placeholder="Masukkan email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
          </div>
          <div className="mb-3">
            <label className="form-label">Password</label>
            <input
              type="password"
              className="form-control"
              placeholder="Masukkan password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />
          </div>
          <button type="submit" className="btn btn-success w-100">
            Daftar
          </button>
        </form>
        <p className="text-center mt-3 text-muted">
          Sudah punya akun? <a href="/">Login di sini</a>
        </p>
      </div>
    </div>
  );
};

export default RegisterPage;
