<?php
/*****************************************************************************************
 * EduSec is a college management program developed by
 * Rudra Softech, Inc. Copyright (C) 2013-2014.
 ****************************************************************************************/

class EmployeeAcademicRecordTransController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'employeeTransaction/employeeAcademicRecords' page.
	 */
	public function actionCreate()
	{
		$model=new EmployeeAcademicRecordTrans;
		$this->performAjaxValidation($model);

		if(isset($_POST['EmployeeAcademicRecordTrans']))
		{
			$model->attributes=$_POST['EmployeeAcademicRecordTrans'];
			$model->employee_academic_record_trans_oraganization_id = Yii::app()->user->getState('org_id');
			$model->employee_academic_record_trans_user_id=$_REQUEST['id'];
			
			if($model->save())
				$this->redirect(array('employeeTransaction/employeeAcademicRecords','id'=>$model->employee_academic_record_trans_user_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'employeeTransaction/employeeAcademicRecords' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->performAjaxValidation($model);

		if(isset($_POST['EmployeeAcademicRecordTrans']))
		{
			$model->attributes=$_POST['EmployeeAcademicRecordTrans'];
			if($model->save())
				$this->redirect(array('employeeTransaction/employeeAcademicRecords','id'=>$model->employee_academic_record_trans_user_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new EmployeeAcademicRecordTrans('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmployeeAcademicRecordTrans']))
			$model->attributes=$_GET['EmployeeAcademicRecordTrans'];

		$this->render('admin',array(
			'model'=>$model,
		));


	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmployeeAcademicRecordTrans('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmployeeAcademicRecordTrans']))
			$model->attributes=$_GET['EmployeeAcademicRecordTrans'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Return list of Employee Academic Records List
	 */
	public function actionEmployeeAcademicRecords()
	{
		$model=new EmployeeAcademicRecordTrans('mysearch');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmployeeAcademicRecordTrans']))
			$model->attributes=$_GET['EmployeeAcademicRecordTrans'];

		$this->render('employeerecords',array(
			'employeerecords'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=EmployeeAcademicRecordTrans::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employee-academic-record-trans-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
