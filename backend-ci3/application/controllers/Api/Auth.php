<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Allow CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

        // Load database and model
        $this->load->database();
        $this->load->model('User_model');
    }

    public function register()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['email']) || !isset($input['password'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email dan password wajib diisi']);
            return;
        }

        $email = $input['email'];
        $password = password_hash($input['password'], PASSWORD_BCRYPT);

        // Cek apakah user sudah ada
        $existingUser = $this->User_model->get_by_email($email);
        if ($existingUser) {
            http_response_code(409); // Conflict
            echo json_encode(['status' => 'error', 'message' => 'Email sudah terdaftar']);
            return;
        }

        // Insert user baru
        $this->db->insert('users', [
            'email' => $email,
            'password' => $password
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Registrasi berhasil']);
    }

    public function login()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!isset($input['email']) || !isset($input['password'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email dan password wajib diisi']);
            return;
        }

        $email = $input['email'];
        $password = $input['password'];

        $user = $this->User_model->get_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Login berhasil',
                'data' => [
                    'email' => $user->email
                    // kamu bisa tambahkan 'id' => $user->id, atau token di sini
                ]
            ]);
        } else {
            http_response_code(401); // Unauthorized
            echo json_encode(['status' => 'error', 'message' => 'Email atau password salah']);
        }
    }

    // Untuk testing API
    public function ping()
    {
        echo json_encode(['status' => 'ok', 'message' => 'API Auth aktif']);
    }
}
