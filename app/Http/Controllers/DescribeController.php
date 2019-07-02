<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Describe;
use App\Models\Comment;
use JD\Cloudder\Facades\Cloudder;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DescribesRequest;
use App\Http\Requests\User\CommentRequest;
use App\Http\Controllers\API\ScrapeController;
use Goutte\Client;
use App\Http\Requests\User\Describe1Request;

class DescribeController extends Controller
{
    protected $describes;
    protected $comments;

    public function __construct(
        Describe $describes,
        Comment $comments
    ){
        $this->middleware('auth')->except(['index']);
        $this->describe = $describes;
        $this->comment = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $describes = $this->describe->all();
        // dd($describes);

        return view('user.describe.index',
                compact(
                    'describes'
                ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.describe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        // $this->describe->create($inputs);
        $client = new Client();
        $crawler = $client->request('GET', $inputs['url']);
        // dd($crawler);
        $contentList = $crawler->filter('meta')->each(function ($node) {
            if ($node->attr('property') === 'og:image') { //metaタグを取得して、og:imageのものを返す
                return $node->attr('content');
            }
            return null;
        });

        foreach ($contentList as $key => $item) {
            if ($item === null) { //og:imageが見つかるまで繰り返し処理を実行
                continue;
            }
            // var_dump($contentList[$key]);
            // return $contentList[$key]; //画像のURLが返ってきている
            $describeImage = $contentList[$key]; //画像のURLを変数に格納
            // var_dump($describeImage);
            $this->describe->createImage($inputs, $describeImage); //describeモデルの中のメソッドで作成
            return redirect()->route('describe.index');
        }

        return 'Nothing';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $describe = $this->describe->find($id);
        $comments = $describe->comments->all();
        // dd($comments);
        return view('user.describe.show', compact('describe', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $describe = $this->describe->find($id);
        return view('user.describe.edit', compact('describe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DescribesRequest $request, $id)
    {
        $inputs = $request->all();
        $this->describe->find($id)->fill($inputs)->save();
        return redirect()->route('describe.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->describe->find($id)->delete();
        return redirect()->route('describe.index');
    }

    public function confirm(Describe1Request $request)
    {
        $inputs = $request->all();
        $describes = $this->describe->fill($inputs);
        $client = new Client();
        $crawler = $client->request('GET', $inputs['url']);
        // dd($crawler);
        $contentList = $crawler->filter('meta')->each(function ($node) {
            if ($node->attr('property') === 'og:image') { //metaタグを取得して、og:imageのものを返す
                return $node->attr('content');
            }
            return null;
        });

        foreach ($contentList as $key => $item) {
            if ($item === null) { //og:imageが見つかるまで繰り返し処理を実行
                continue;
            }
        }
            $describeImage = $contentList[$key];
        return view('user.describe.confirm', compact('inputs', 'describes', 'describeImage'));
    }

    public function mypage()
    {
        return view(user.describe.mypage);
    }

    public function upload()
    {
        Cloudder::upload('https://pbs.twimg.com/media/Dz_OgCHUYAAPWOf.jpg', '');
        // dd(Cloudder::getResult());
    }

    public function comment(CommentRequest $request)
    {
        $inputs = $request->all();
        $this->comment->create($inputs);
        return redirect()->back();
    }
}