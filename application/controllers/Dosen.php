  <?php 
  class Dosen extends CI_Controller {
    public function __construct()
    {
      parent:: __construct();
      $this->load->model('Dosen_model');
    }

      public function index()
      {
      $data['judul'] = 'Halaman Dosen';
      $data['dosen'] = $this->Dosen_model->getAllDosen();
      if($this->input->post('keyword')){
        $data['dosen'] = $this->Dosen_model->cariDataDosen();
      }
      $this->load->view('templates/header', $data); 
      $this->load->view('Dosen/index',$data);
      $this->load->view('templates/footer',);
    }
      public function tambah()
      {
        $data['judul'] = 'From Tambah Data Dosen';
        $this->form_validation->set_rules('nip','Nip','required|is_unique[Dosen.nip]');
        $this->form_validation->set_rules('namadosen','Namadosen','required|is_unique[Dosen.namadosen]'); 
        if($this->form_validation->run()==False){
          $this->load->view('templates/header', $data); 
          $this->load->view('dosen/tambah',$data);
          $this->load->view('templates/footer',);
        }else{
          $this->Dosen_model->tambahDataDosen();
          $this->session->set_flashdata('flash','ditambahkan');
          redirect('dosen');

        }
      }
     
    public function ubah()
    {
      $data['judul'] = 'From Ubah Data Dosen';
      $this->form_validation->set_rules('nip','Nip','required|is_unique[Dosen.nip]');
      $this->form_validation->set_rules('namadosen','Namadosen','required|is_unique[Dosen.namadosen]'); 
      if($this->form_validation->run()==False){
        $this->load->view('templates/header', $data); 
        $this->load->view('dosen/ubah',$data);
        $this->load->view('templates/footer',);
      }else{
        $this->Dosen_model->tambahDataDosen();
        $this->session->set_flashdata('flash','ditambahkan');
        redirect('dosen');

      }
    }
    public function detail($id)
    {
      $data['judul'] = 'Detail Data Dosen';
      $data['Dosen'] = $this->Dosen_model->getAllDosenById($id);
      $this->load->view('templates/header', $data); 
      $this->load->view('dosen/detail',$data);
      $this->load->view('templates/footer',);
      
    }
    public function hapus($id)
    {
      $this->Dosen_model->hapusDataDosen($id);
      $this->session->set_flashdata('flash','dihapus');
      redirect('dosen');

    }
  } 