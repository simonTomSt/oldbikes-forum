<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\CommentModel;

class CommentsController extends Controller
{

    private readonly CommentModel $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function addComment(Request $req): void
    {
        $params = $req->getUrlParams();
        $formData = $req->getBody();
        $postId = $params['post'];
        $authorId = Session::get('user');

        $commentData = [
            ...$formData,
            'post_id' => $postId,
            'author_id' => $authorId
        ];

        $this->commentModel->create($commentData);

        redirectTo("/posts/$postId");
    }

    public function deleteComment(Request $req): void
    {
        $params = $req->getUrlParams();
        $query = $req->getQuery();
        $commentId = $params['id'];
        $postId = $query['postId'];

        $this->commentModel->delete($commentId);

        redirectTo("/posts/$postId");
    }
}