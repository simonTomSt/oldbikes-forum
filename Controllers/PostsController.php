<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\{Controller, Request, Session};
use App\Models\{PostModel, UserModel};

class PostsController extends Controller
{
    private readonly PostModel $postModel;
    private UserModel $userModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->userModel = new UserModel();
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
        $this->getPostsForView($req);

        $pageParams = $this->getPostsForView($req);

        $this->render('posts', $pageParams, 'forum');
    }

    public function viewUserPosts(Request $req): void
    {
        $this->getPostsForView($req, true);

        $pageParams = $this->getPostsForView($req, true);

        $this->render('posts', $pageParams, 'forum');
    }

    public function viewSinglePost(Request $req): void
    {
        $urlParams = $req->getUrlParams();

        $postId = $urlParams['id'];

        $post = $this->postModel->findById($postId);
        $author = $this->userModel->findById($post['author_id']);

        $pageParams = ['post' => $post, 'author' => $author['username']];

        $this->render('post', $pageParams, 'forum');
    }

    private function getPostsForView(Request $req, bool $userPosts = false): array
    {
        $userId = Session::get('user');
        $query = $req->getQuery();
        $limit = $query['limit'] ?? 25;
        $offset = $query['offset'] ?? 0;

        $posts = $this->postModel->findMany($userPosts ? ['author_id' => $userId] : [], '*', $limit, $offset);
        $totalCount = $this->postModel->getCount($userPosts ? ['author_id' => $userId] : []);

        return [
            'posts' => $posts,
            'totalCount' => $totalCount,
            'offset' => $offset,
            'limit' => $limit,
            'baseUrl' => $userPosts ? '/my-posts' : '/posts',
        ];
    }
}