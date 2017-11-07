<?php

class userController extends Controller {

	public function index(){
		$examples=$this->model->load();		// просим у модели все записи
		$this->setResponce($examples);		// возвращаем ответ 
	}

	public function view($data){
		$example=$this->model->load($data['id']); // просим у модели конкретную запись
		$this->setResponce($example);
	}

	public function add(){
		if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])){
			// мы передаем в модель массив с данными
			// модель должна вернуть boolean
			$dataToSave=array('id'=>$_POST['id'], 'name'=>$_POST['name'], 'score'=>$_POST['score']);
			$addedItem=$this->model->create($dataToSave);
			$this->setResponce($addedItem);
		}
	}

	
	public function edit(array $data)
	{
		$post=json_decode(file_get_contents('php://input'), true);
		if(isset($post['id']) && isset($post['name']) && isset($post['score']))
		{
			$dataToUpd = array('id' => $post['id'],
								'name' => $post['name'],
								'score' => $post['score'],);
			$updItem=$this->model->save($data['id'], $dataToUpd);
			return $this->setResponce($updItem);
		}
	}	
	public function delete($data){
		$deleteItem = $this->model->delete($data[$id]);
		$this->setResponce($deleteItem);
	}

}