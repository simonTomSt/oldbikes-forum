<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\PostModel;

class PostsController extends Controller
{
    private readonly PostModel $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function viewCreatePost(): void
    {
        $this->render('create-post', [], 'forum');
    }

    public function createPost(Request $req): void
    {
        $postData = $req->getBody();
        $postData['author_id'] = Session::get('user');

        $this->postModel->create($postData);

        redirectTo('/my-posts');
    }

    public function viewPosts(Request $req): void
    {
        $posts = $this->getPostsForView($req);

        $this->render('posts', ['posts' => $posts], 'forum');
    }

    public function viewUserPosts(Request $req): void
    {
        $posts = $this->getPostsForView($req, true);

        $this->render('posts', ['posts' => $posts], 'forum');
    }

    private function getPostsForView(Request $req, bool $userPosts = false): array
    {
        $userId = Session::get('user');
        $urlParams = $req->getUrlParams();
        $limit = $urlParams['limit'] ?? 25;
        $offset = $urlParams['offset'] ?? 0;

        return $this->postModel->findMany($userPosts ? ['author_id' => $userId] : [], '*', $limit, $offset);
    }
}