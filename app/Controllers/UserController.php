<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomentarModel;
use App\Models\PostinganModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public $postinganModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->postinganModel = new PostinganModel();
    }
    public function index()
    {
        //
    }

    public function login()
    {
        return view('loginUser');
    }

    public function register()
    {
        return view('registerUser');
    }

    public function home()
    {
        $postingan = $this->postinganModel->getPostingan();
        $komenModel = new KomentarModel();

        foreach ($postingan as &$post) {
            $post['jumlah_komentar'] = count($komenModel->where('id_post', $post['id_post'])->findAll());
        }

        $data = [
            'postingan' => $postingan
        ];

        return view('homePage', $data);
    }

    public function createPost()
    {

        $auth = service('authentication');

        if ($auth->check()) {
            $userId = $auth->id();
            $postinganModel = new PostinganModel();

            $path = 'assets/uploads/img/';
            $foto = $this->request->getFile('foto');
            $name = $foto->getRandomName();
            if ($foto->move($path, $name)) {
                $foto = base_url($path . $name);
            }

            $postinganModel->savePostingan([
                'id_user' => $userId,
                'caption' => $this->request->getPost('caption'),
                'pict_post' => $foto
            ]);
            return redirect()->to('/');
        }
    }

    public function createKomen()
    {
        $auth = service('authentication');

        if ($auth->check()) {
            $userId = $auth->id();
            $komenModel = new KomentarModel();

            $komenModel->saveKomentar([
                'id_post' => $this->request->getPost('id_post'),
                'id_user' => $userId,
                'komentar' => $this->request->getPost('komentar')
            ]);
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $auth = service('authentication');
        $auth->logout();
        return redirect()->to('/');
    }

    public function deletePost($id_post)
    {
        $this->postinganModel->delete($id_post);
        return redirect()->to('/profile');
    }

    public function deleteKomen($id_komentar)
    {
        $komenModel = new KomentarModel();
        $komenModel->delete($id_komentar);
        return redirect()->to('/');
    }

    public function editPost($id_post)
    {
        $data = [
            'postingan' => $this->postinganModel->find($id_post)
        ];
        return view('editPost', $data);
    }

    public function updatePost($id_post)
    {
        $path = 'assets/uploads/img/';
        $foto = $this->request->getFile('foto');
        $name = $foto->getRandomName();
        if ($foto->move($path, $name)) {
            $foto = base_url($path . $name);
        }

        $this->postinganModel->save([
            'id_post' => $id_post,
            'caption' => $this->request->getPost('caption'),
            'pict_post' => $foto
        ]);
        return redirect()->to('/');
    }

    public function editKomen($id_komentar)
    {
        $komenModel = new KomentarModel();
        $data = [
            'komentar' => $komenModel->find($id_komentar)
        ];
        return view('editKomen', $data);
    }

    public function updateKomen($id_komentar)
    {
        $komenModel = new KomentarModel();
        $komenModel->save([
            'id_komentar' => $id_komentar,
            'komentar' => $this->request->getPost('komentar')
        ]);
        return redirect()->to('/');
    }

    public function profile()
    {
        $auth = service('authentication');
        $userId = $auth->id();
        $data = [
            'user' => $auth->user(),
            'postingan' => $this->postinganModel->where('id_user', $userId)->findAll()
        ];
        return view('profile', $data);
    }

    public function showDetail($id)
    {
        $postingan = $this->postinganModel->getPostinganById($id);
        $komenModel = new KomentarModel();
        $komentar = $komenModel->where('id_post', $id)->findAll();
        $data = [
            'postingan' => $postingan,
            'komentar' => $komentar
        ];
        // dd($data);
        return view('detail_post', $data);
    }
}
