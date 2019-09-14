<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use app\models\News;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\base\Exception;

class NewsController extends Controller
{

    /**
     * Get all News
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = News::find()->all();

        // return response
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['result' => $result];
    }

    /**
     * Create News
     *
     * @return mixed
     */
    public function actionCreate() {

        try{
            // Set request
            $request = Yii::$app->request;


            // Check for post
            if ( $request->isPost ) {

                // Create new News
                $model = new News();

                // Load post data into news model and try to save
                if ( $model->load(Yii::$app->request->post()) && $model->save()) {

                    // image upload
                    $path = Yii::getAlias( '@app' ) . '/web/uploads/';
                    $image = UploadedFile::getInstance( $model, 'image' );
                    @mkdir( $path, 0777, true );
                    $image_name = uniqid().''.time().'.'.$image->extension;
                    $image->saveAs( $path . '/' . $image_name);

                    $model->image = '/uploads/'. $image_name;

                    $result = $model->save();

                    // return response
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['result' => $result];

                } else {

                    throw new Exception('News could not be created');
                }

            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Get News from id
     *
     * @return mixed
     */
    public function actionEdit()
    {
        try {
            // Set request
            $request = Yii::$app->request;

            // Check for post
            if ($request->isPost) {

                // find news record from id
                if ($result = News::findOne($request->post('id'))) {

                    // return response
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['result' => $result];

                } else {

                    throw new Exception('not found');
                }
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Update News from id
     *
     * @return mixed
     */
    public function actionUpdate()
    {
        try {
            // Set request
            $request = Yii::$app->request;

            // Check for post
            if ($request->isPost) {

                // find news record from id
                if ($model = News::findOne($request->post('id'))) {

                    $current_image = $model->image;
                    // Load post data into profile model and try to save
                    if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {

                        // Upload image
                        $path = Yii::getAlias( '@app' ) . '/web/uploads/';
                        $image = UploadedFile::getInstance( $model, 'image' );

                        // check image
                        if ( ! empty( $image ) && $image->size !== 0 ) {
                            @mkdir( $path, 0777, true );
                            $image_name = uniqid().''.time().'.'.$image->extension;
                            $image->saveAs( $path . '/' . $image_name);
                            $model->image ='/uploads/'. $image_name;

                            //delete image from folder
                            unlink(Yii::$app->basePath . '/web/' . $current_image);
                        }else{
                            $model->image = $current_image;
                        }

                       $result = $model->save();

                        // return response
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return ['result' => $result];
                    }else{

                        throw new Exception('News could not be updated');
                    }

                } else {

                    throw new Exception('not found');
                }
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }



    /**
     * Delete News
     *
     * @return mixed
     */
    public function actionDelete()
    {
        try {
            // Set request
            $request = Yii::$app->request;

            // Check for post
            if ($request->isPost) {

                // find news record from id
                if ($model = News::findOne($request->post('id'))) {

                    // delete image from folder
                    unlink(Yii::$app->basePath . '/web/' . $model->image);

                    // delete record
                    $result = $model->delete();

                    // return response
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['result' => $result];

                } else {

                    throw new Exception('News could not be deleted');
                }
            }

        } catch (Exception $ex) {
                return $ex->getMessage();
        }

    }


}
