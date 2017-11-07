<?php

class flashController extends Controller {

	public function index(){
		$examples=$this->model->load();		// просим у модели все записи
		$this->setResponce($examples);		// возвращаем ответ 
	}

	public function view($data){
		$example=$this->model->load($data['id']); // просим у модели конкретную запись
		$this->setResponce($example);
	}

	public function add(){
		if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['image']) && isset($_POST['power']) && isset($_POST['speed'])){
			$dataToSave=array('id'=>$_POST['id'], 'name'=>$_POST['name'], 'image'=>$_POST['image'], 'power'=>$_POST['power'], 'speed'=>$_POST['speed']);
			$addedItem=$this->model->create($dataToSave);
			$this->setResponce($addedItem);
		}
	}

	public function edit($data){
		$post=json_decode(file_get_contents('php://input'), true);
		if((isset($post['id'])) && (isset($post['name'])) && (isset($post['image'])) && (isset($post['power'])) && (isset($post['speed']))){
			$dataToUpd=array('id'=>$post['id'], 'name'=>$post['name'], 'image'=>$post['image'], 'power'=>$post['power'], 'speed'=>$post['speed']);
			$updItem=$this->model->save($data['id'], $dataToUpd);
			$this->setResponce($updItem);
		}	
	}



	public function delete($data){
		$deleteItem = $this->model->delete($data[$id]);
		$this->setResponce($deleteItem);
	}
}