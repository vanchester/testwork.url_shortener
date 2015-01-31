<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $urlModel = new Url;

        if (Yii::app()->request->isPostRequest) {
            $urlModel->setAttributes(Yii::app()->request->getPost('Url'));
            $ajaxRequest = Yii::app()->request->isAjaxRequest;

            if ($urlModel->validate()) {
                $urlModel->save();
            } else if ($ajaxRequest) {
                echo CActiveForm::validate($urlModel);
                Yii::app()->end();
            }

            if ($ajaxRequest) {
                echo json_encode([
                    'status' => 'success',
                    'link' => Yii::app()->getBaseUrl(true) . '/' . $urlModel->code
                ]);
                Yii::app()->end();
            }
        }

        $this->render('index', [
            'urlModel' => $urlModel,
            'link' => !$urlModel->code || $urlModel->hasErrors()
                ? null
                : Yii::app()->getBaseUrl(true) . '/' . $urlModel->code
        ]);
    }

    public function actionRedirect()
    {
        $code = Yii::app()->request->getParam('code');
        if ($code && ($url = Url::model()->findByPk($code))) {
            $this->redirect($url->link, true);
        }

        throw new CHttpException(404, Yii::t('app', 'Page not found'));
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            $this->render('error', $error);
        }
    }
}
