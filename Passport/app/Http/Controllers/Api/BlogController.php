<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    protected $cacheTtl;

    public function __construct()
    {
        $this->cacheTtl = now()->addDays(30);
    }

    public function index()
    {
        $key = 'api:blogs:all:v2';

        $data = Cache::remember($key, $this->cacheTtl, function () {
            $blogs = Blog::query()
                ->with('category')
                ->whereIn('audience_scope', ['all', 'school', 'schools'])
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->get(['*'])
                ->map(function ($blog) {
                    $item = $blog->toArray();
                    $item['category'] = $blog->category?->toArray();
                    if (isset($item['featured_image']) && $item['featured_image'] && !str_starts_with(trim($item['featured_image']), 'http')) {
                        $item['featured_image'] = asset('storage/' . $item['featured_image']);
                    }
                    return $item;
                });

            return [
                'total' => $blogs->count(),
                'items' => $blogs,
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function categories()
    {
        $key = 'api:blogs:categories:v2';

        $data = Cache::remember($key, $this->cacheTtl, function () {
            $categories = BlogCategory::withCount([
                'blogs' => function ($q) {
                    $q->whereIn('audience_scope', ['all', 'school', 'schools']);
                }
            ])
                ->orderBy('name')
                ->get()
                ->map(function ($cat) {
                    $item = $cat->toArray();
                    $item['blogs_count'] = $cat->blogs_count;
                    return $item;
                });

            return [
                'total' => $categories->count(),
                'items' => $categories,
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function universityBlogs()
    {
        $key = 'api:blogs:university:v2';

        $data = Cache::remember($key, $this->cacheTtl, function () {
            $blogs = Blog::query()
                ->with('category')
                ->whereIn('audience_scope', ['all', 'university'])
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->get(['*'])
                ->map(function ($blog) {
                    $item = $blog->toArray();
                    $item['category'] = $blog->category?->toArray();
                    if (isset($item['featured_image']) && $item['featured_image'] && !str_starts_with(trim($item['featured_image']), 'http')) {
                        $item['featured_image'] = asset('storage/' . $item['featured_image']);
                    }
                    return $item;
                });

            return [
                'total' => $blogs->count(),
                'items' => $blogs,
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function universityShow(string $slug)
    {
        $key = "api:blogs:university:{$slug}:v2";

        $data = Cache::remember($key, $this->cacheTtl, function () use ($slug) {
            $blog = Blog::query()
                ->with('category')
                ->whereIn('audience_scope', ['all', 'university'])
                ->where('slug', $slug)
                ->first();

            if (!$blog) {
                return null;
            }

            $item = $blog->toArray();
            $item['category'] = $blog->category?->toArray();
            if (isset($item['featured_image']) && $item['featured_image'] && !str_starts_with(trim($item['featured_image']), 'http')) {
                $item['featured_image'] = asset('storage/' . $item['featured_image']);
            }
            return $item;
        });

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Blog not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function universityCategories()
    {
        $key = 'api:blogs:university:categories:v2';

        $data = Cache::remember($key, $this->cacheTtl, function () {
            $categories = BlogCategory::withCount([
                'blogs' => function ($q) {
                    $q->whereIn('audience_scope', ['all', 'university']);
                }
            ])
                ->orderBy('name')
                ->get()
                ->map(function ($cat) {
                    $item = $cat->toArray();
                    $item['blogs_count'] = $cat->blogs_count;
                    return $item;
                });

            return [
                'total' => $categories->count(),
                'items' => $categories,
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
    }
}
