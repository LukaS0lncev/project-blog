<?php

namespace App\Articles;

use Elasticsearch\Client;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Blog\Post as BlogPost;
use App\Models\News\Post as NewsPost;
use phpDocumentor\Reflection\Types\String_;

class ElasticsearchRepository implements ArticlesRepository
{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = ''): Array
    {
        $items = $this->searchOnElasticsearch($query);

        $blog_posts = $this->buildCollection($items['blog_posts'], 'BlogPost') ?? '';
        $news_posts = $this->buildCollection($items['news_posts'], 'NewsPost') ?? '';
        return  array(
            'blog_posts' => $blog_posts,
            'news_posts' => $news_posts,
        );
    }

    private function searchOnElasticsearch(string $query = ''): Array
    {
        $model_blog_post = new BlogPost;
        $model_news_post = new NewsPost;


        $blog_posts = $this->elasticsearch->search([
            'index' => $model_blog_post->getSearchIndex(),
            'type' => $model_blog_post->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'post'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        $news_posts = $this->elasticsearch->search([
            'index' => $model_news_post->getSearchIndex(),
            'type' => $model_news_post->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'post'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return array(
            'blog_posts' => $blog_posts,
            'news_posts' => $news_posts,
        );
    }

    private function buildCollection(array $items, $model_name = false): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        if ($model_name == 'BlogPost') {
            return BlogPost::findMany($ids)
                ->sortBy(function ($article) use ($ids) {
                    return array_search($article->getKey(), $ids);
                });
        }
        if ($model_name == 'NewsPost') {
            return NewsPost::findMany($ids)
                ->sortBy(function ($article) use ($ids) {
                    return array_search($article->getKey(), $ids);
                });
        }
    }
}
