<?php
namespace App\Model;

class News extends \Aqua\Db\Model
{
    /**
     * messages on page
     */
    const PAGE_COUNT = 3;

    public $sortListAllow = [
        'name',
        'created_at',
    ];

    public $orderListAllow = [
        'DESC',
        'ASC',
    ];

    /**
     * Get list comment
     * @param $page - page id
     * @param string $field
     * @param string $order
     * @return array
     * @throws \Exception
     */
    public function newsList($page, $field = 'created_at', $order = 'DESC')
    {

        $orderSql = $field . ' ' . strtolower($order);
        $sql = 'SELECT
                    "id",
                    "name",
                    "author",
                    "tags",
                    "text",
                    "created_at"
                FROM "news"
                ORDER BY ' .$orderSql.'
                OFFSET ?offset
                LIMIT ?limit;
                ';

        $query = (new \Aqua\Db\Query)->instances($sql, [
            'limit' => self::PAGE_COUNT,
            'offset'    => $this->getOffset($page),
        ]);


        return  \Aqua\Db\Connection::query($query)->asArray();
    }

    public function search($field_name = null, $search = null)
    {
        $likes = "%{$search}%";
        $sql = 'SELECT
                    *
                FROM "news"
                WHERE '.$field_name.' LIKE ?likes
                ';

        $query = (new \Aqua\Db\Query)->instances($sql, [
            'likes'    => $likes,
        ]);


        return  \Aqua\Db\Connection::query($query)->asArray();
    }

    public function view($id)
    {
        $sql = 'SELECT
                   *
                FROM "news"
                WHERE "id"=?id
                ';

        $query = (new \Aqua\Db\Query)->instances($sql, [
            'id' => $id,
        ]);


        return  \Aqua\Db\Connection::query($query)->asArray();
    }

    public function save(array $params)
    {
        $sql = 'BEGIN;
                INSERT INTO "news"
                (
                  "name",
                  "author",
                  "tags",
                  "text",
                  "created_at"
                )
                VALUES
                (
                  ?name,
                  ?author,
                  ?tags,
                  ?text,
                  ?created_at
                );
                COMMIT;';

        $query = (new \Aqua\Db\Query)->instances($sql, $params);

        return  \Aqua\Db\Connection::query($query);
    }

    public function getCount()
    {
        $sql = 'SELECT count(1) "count"
                FROM "news"';

        $query = (new \Aqua\Db\Query)->instances($sql, []);

        return \Aqua\Db\Connection::query($query)->asArray()[0];
    }


    protected function getOffset($page)
    {
        $page = ($page <=0) ? 1: $page;

        return  (self::PAGE_COUNT * ($page - 1));
    }


  }
