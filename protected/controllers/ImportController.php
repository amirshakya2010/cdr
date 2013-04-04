<?php

class ImportController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionImport()
        {
            $model=new Import;

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='import-_import-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['Import']))
            {
                $model->status = 1;
                $model->created_date = date('Y-M-d');
                //$model->attributes=$_POST['Import'];
                $file_name=CUploadedFile::getInstance($model,'name');
                $rand = rand(0, 9999);
                $model->name = "{$rand}"."-"."{$file_name}";
                if($model->validate())
                {
                    if(!is_dir(Yii::app()->basePath.'/../uploades/')){
                        mkdir(Yii::app()->basePath.'/../uploades/',0777);
                    }
                    $file_name->saveAs(Yii::app()->basePath.'/../uploades/'.$model->name);
                    // form inputs are valid, do something here
                    $model->save();
                    
                }
            }
            $this->render('_import',array('model'=>$model));
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}