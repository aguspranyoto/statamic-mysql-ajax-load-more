<?php

use Illuminate\Support\Facades\Route;
use Statamic\Facades\Entry;


Route::get('/load-more-posts', function () {
    $offset = request('offset', 0);
    $limit = request('limit', 3);
    $posts = Entry::query()
        ->where('collection', 'blog_posts')
        ->orderBy('created_at', 'asc') // Urutkan berdasarkan tanggal pembuatan
        ->offset($offset)
        ->limit($limit)
        ->get();

    $data = $posts->map(function ($entry) {
        return [
            'title' => $entry->get('title'),
            'content' => $entry->get('content')
        ];
    });

    return response()->json($data);
});