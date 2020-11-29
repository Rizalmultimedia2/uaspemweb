<?php namespace App\Controllers;
use App\Models\User_GoPromote;
use App\Models\JadwalModel;
class Dashboard extends BaseController
{
	
	public function index()
    {
        $username = session()->get('username');
        $model = new User_GoPromote();
        $data['user'] = $model->getUser($username)->getRow();

        if ($data['user']->nama === "") {
            return redirect()->to("edit/$username");
        } else {
            return view('dashboard',  $data);
        }
    }

    public function edit($id)
    {
        $username = session()->get('username');

        if($id == $username){
            $model = new User_GoPromote();
            $data['user'] = $model->getUser($username)->getRow();
            echo view('edit', $data);
        } else {
            session()->destroy();
            return redirect()->to('/')->deleteCookie('username');	
        }
    }

    public function profile()
    {
        $username = session()->get('username');
            $model = new User_GoPromote();
            $data['user'] = $model->getUser($username)->getRow();
            echo view('profile', $data);
    }

    public function foto(){
        $session = session();
        $namaFile = $_FILES["foto-profile"]["name"];
        $sizeFile = $_FILES["foto-profile"]["size"];
        $error = $_FILES["foto-profile"]["error"];
        $tmpName = $_FILES["foto-profile"]["tmp_name"];

        $extensiFileAllowed = ["jpg", "jpeg", "png"];
        $extensiFile = explode('.', $namaFile);
        $extensiFile = strtolower(end($extensiFile));
        
        if($error === 4){
            $session->setFlashdata('error', 'Tidak ada foto yang diupload!');
            return redirect()->to('/profile');
        }else{
            if(!in_array($extensiFile, $extensiFileAllowed)){            
                $session->setFlashdata('error', 'Extensi File Salah!');
                return redirect()->to('/profile');
            }
            else{
                if($sizeFile > 2000000){
                    $session->setFlashdata('error', 'File yang diupload lebih dari 2mb!');
                    return redirect()->to('/profile');
                }
            }
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.' . $extensiFile;
        echo $namaFileBaru;

        $session = session()->get('username');

        $dir = "img/$session";
        if(!is_dir($dir)){
            mkdir("img/" . session()->get('username'));
        }
        move_uploaded_file($tmpName, 'img/' . session()->get('username') . '/' . $namaFileBaru);

        $model = new User_GoPromote();
        $username = session()->get('username');
        $data = $namaFileBaru;
        $model->saveGambar($data, $username);
        return redirect()->to('/profile');
    }

    public function update()
    {
        $model = new User_GoPromote();
        $username = $this->request->getPost('username');
        $data = array(
            'nama' => $this->request->getPost('name'),
            'no_hp' => $this->request->getPost('nohp'),
            'email' => $this->request->getPost('email'),
            'instagram' => $this->request->getPost('instagram'),
            'foto' => " ",
        );
        $model->updateUser($data, $username);
        return redirect()->to('/dashboard');
    }

    public function beliPage(){
        return view ('beli');
    }
}
