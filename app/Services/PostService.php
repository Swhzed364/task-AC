<?php

namespace App\Services;

use App\Http\Resources\PostResouce;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public static function filter ($filters, $posts)
    {

        foreach ($filters as $column => $value) {

            $posts = $posts->where($column, $value);
        }

        return $posts;
    }

    public static function sort ($sort, $posts)
    {

        if (!$sort['inverted']) {
            $sortedPosts = $posts->sortBy($sort['column']);
        }else{
            $sortedPosts = $posts->sortByDesc($sort['column']);
        }

        return $sortedPosts;
    }
}