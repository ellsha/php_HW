<?php

namespace BlogApi\Controllers;

use BlogApi\Container;
use BlogApi\HttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostsController
{
    private $connection;
    private $tableName;

    public function __construct()
    {
        $this->connection = Container::instance()->connection;
        $this->tableName = Container::instance()->config['mysql_table'];
    }

    public function index(Request $request)
    {
        $sql = 'SELECT * FROM :table';
        $sth = $this->connection->prepare($sql);
        $sth->execute([':table' => $this->tableName]);
        $result = $sth->fetchAll();

        return new JsonResponse($result);
    }

    public function show(Request $request, $id)
    {
        $sql = 'SELECT * FROM :table WHERE id = :id';
        $sth = $this->connection->prepare($sql);
        $sth->execute([':table' => $this->tableName, ':id' => $id]);
        $result = $sth->fetchAll();

        return new JsonResponse($result);
    }

    public function delete(Request $request, $id)
    {
        $sql = 'DELETE FROM :table WHERE id = :id';
        $sth = $this->connection->prepare($sql);
        $sth->execute([':table' => $this->tableName, ':id' => $id]);

        return new JsonResponse(null, 204);
    }

    public function create(Request $request)
    {
        $title = $request->request->get('title');
        $content = $request->request->get('content');

        if(empty($title) || empty($content)) {
            throw new HttpException(400);
        }

        $sql = 'INSERT INTO :table (title, content) VALUES (:title, :content)';
        $sth = $this->connection->prepare($sql);
        $sth->execute([
            ':table' => $this->tableName,
            ':title' => $title,
            ':content' => $content
        ]);

        $sql = "SELECT * FROM :table WHERE id = LAST_INSERT_ID()";
        $sth = $this->connection->prepare($sql);
        $sth->execute([':table' => $this->tableName]);
        $result = $sth->fetchAll();

        return new JsonResponse($result, 201);
    }

    public function update(Request $request, $id)
    {
        var_dump($request->getContent());
        parse_str($request->getContent());

        if(empty($title) || empty($content)) {
            throw new HttpException(400);
        }

        $sql = 'UPDATE :table SET title = :title, content = :content WHERE id = :id';
        $sth = $this->connection->prepare($sql);
        $sth->execute([
            ':table' => $this->tableName,
            ':title' => $title,
            ':content' => $content,
            ':id' => $id
        ]);

        $sql = 'SELECT * FROM :table WHERE id = :id';
        $sth = $this->connection->prepare($sql);
        $sth->execute([':table' => $this->tableName, ':id' => $id]);
        $result = $sth->fetchAll();

        return new JsonResponse($result, 200);
    }
}