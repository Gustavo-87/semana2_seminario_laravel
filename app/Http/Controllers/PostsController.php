<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PostsController extends Controller
{
    public function index()
    {
        $response = Http::timeout(10)
            ->get('https://jsonplaceholder.typicode.com/posts');

        if (! $response->successful()) {
            return view('posts.index', [
                'posts' => [],
                'error' => 'No fue posible obtener los posts desde la API externa.',
            ]);
        }

        return view('posts.index', [
            'posts' => $response->json(),
            'error' => null,
        ]);
    }
}
