<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\DBModel;

class CommentModel extends DBModel
{
    public function __construct()
    {
        parent::__construct('comments');
    }

    public function getCommentsForPostId(int $postId): array
    {
        $result = $this->db->query("
        SELECT comments.content, comments.id, comments.author_id, comments.post_id, users.username
        FROM comments
        INNER JOIN users
        ON comments.author_id = users.id
        WHERE comments.post_id = :postId
    ", ['postId' => $postId]);

        return $result->findAll();
    }
}