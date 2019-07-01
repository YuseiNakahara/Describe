<?php

namespace App\Http\Controllers\API;

use Goutte\Client;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DescribeController;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{

    public function index(Request $request)
    {
        $client = new Client();
        $crawler = $client->request('GET', $request->url);
        $contentList = $crawler->filter('meta')->each(function ($node) {
            if ($node->attr('property') === 'og:image') {
                return $node->attr('content');
            }
            return null;
        });

        foreach ($contentList as $key => $item) {
            if ($item === null) {
                continue;
            }
            return $contentList[$key];
        }

        return 'nothing';
    }
}