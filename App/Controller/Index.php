<?php
namespace App\Controller;

use \Aqua\Base\Request;
use \App\Base\Helper\Captcha;
use \App\Base\Helper\Protection;

class Index extends \Aqua\Base\Controller
{

    public function index($page = 1)
    {
        $page = (int) $page;
        $sortField =  Request::get('field', 'created_at');
        $orderMethod  = strtoupper(Request::get('order', 'desc'));
        $notify = ['error' => null, 'message' => null];
        $news =  new \App\Model\News;

        try {
            if (Request::post('news')) {
                $name = Request::post('name');
                $author = Request::post('author');
                $tags = Request::post('tags');
                $text = Request::post('text');

                if (empty($author)) {
                    throw new \Exception('Empty author');
                }

                if (empty($name)) {
                    throw new \Exception('Empty name');
                }

                if (empty($tags)) {
                    throw new \Exception('Empty tags');
                }


                if (empty($text)) {
                    throw new \Exception('Empty text');
                }


                $params = [
                    'name' => $name,
                    'author' => $author,
                    'tags' => $tags,
                    'text' => $text,
                    'created_at' => time(),
                ];

                if (!$news->save($params)) {
                    throw new \Exception('Error save news');
                }

                $notify['message'] = 'News success add';

                unset($_POST);
            }


        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $newsList = [];

        try {
            if (!in_array($sortField, $news->sortListAllow)) {
                throw new \Exception('Error validate field');
            }

            if (!in_array($orderMethod, $news->orderListAllow)) {
                throw new \Exception('Error validate order parametr');
            }

            $newsList = $news->newsList($page, $sortField, $orderMethod);
        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $this->render('index', [
            'newsList' => $newsList,
            'newsCount' => $news->getCount()['count'],
            'pageCount' =>  \App\Model\News::PAGE_COUNT,
            'page' =>  $page,
            'notify' => $notify
        ]);
    }

    public function search()
    {
        $notify = ['error' => null, 'message' => null];
        try {
            $search = Request::post('search');
            $field_name = Request::post('field_name');

            $newsList = (new \App\Model\News)->search($field_name, $search);
        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }

        $this->render('index', [
            'newsList' => $newsList,
            'newsCount' => 10,
            'pageCount' =>  100,
            'page' =>  1,
            'notify' => $notify
        ]);
    }

    public function view($id = 1)
    {
        $id = (int) $id;
        $notify = ['error' => null, 'message' => null];
        try {
            if (!$id) {
                throw new \Exception('Error get id new');
            }

            $model  = (new \App\Model\News)->view($id)[0];
        } catch (\Exception $e) {
            $notify['error']  =  $e->getMessage();
        }


        $this->render('view', [
            'news' => $model,
            'notify' => $notify
        ]);

    }

}
