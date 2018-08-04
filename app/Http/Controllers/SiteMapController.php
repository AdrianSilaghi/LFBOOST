<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sitemap;
use App\Post;
use App\User;
use Spatie\Sitemap\SitemapGenerator;

class SiteMapController extends Controller
{
    public function posts()
    {
        SitemapGenerator::create('https://lfboost.com')->writeToFile(public_path('sitemap.xml'));
    }
}
