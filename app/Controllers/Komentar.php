<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KomentarModel;
use App\Models\PertemuanModel;

class Komentar extends ResourceController
{
    use ResponseTrait;
    // get all Komentar
    public function index()
    {
        $model = new KomentarModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    // create a komentar
    public function create()
    {
        $model = new KomentarModel();
        $data = [
            'pesan' => $this->request->getPost('pesan'),
            'id_pertemuan' => $this->request->getPost('id_pertemuan')
        ];
        $data = json_decode(file_get_contents("php://input"));
        //$data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);
    }

    // delete komentar
    public function delete($id = null)
    {
        $model = new KomentarModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
        
    }

    //truncate data komentar
    public function deleteall(){
        $model = new KomentarModel();
        $data = $model->emptyTable();
        if($data){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            
            return $this->respondDeleted($response);
        }
    }

      // update Komentar
      public function update($id = null)
      {
          $model = new KomentarModel();
          $json = $this->request->getJSON();
          if($json){
              $data = [
                  'judul' => $json->judul,
                  'pesan' => $json->pesan,
                  'id_pertemuan' => $json->id_pertemuan
                  
              ];
          }else{
              $input = $this->request->getRawInput();
              $data = [
                  'judul' => $input['judul'],
                  'pesan' => $input['pesan'],
                  'id_pertemuan' => $input['id_pertemuan']
              ];
          }
          // Insert to Database
          $model->update($id, $data);
          $response = [
              'status'   => 200,
              'error'    => null,
              'messages' => [
                  'success' => 'Data Updated'
              ]
          ];
          return $this->respond($response);
      }

}