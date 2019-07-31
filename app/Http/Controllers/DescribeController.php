<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Describe;
use App\Models\Comment;
use App\Models\Like;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use Goutte\Client;
use App\Http\Requests\User\Describe1Request;
use Illuminate\Support\Facades\Auth;

class DescribeController extends Controller
{
    protected $describes;
    protected $comments;
    protected $likes;

    public function __construct(
        Describe $describes,
        Comment $comments,
        Like $likes
    ){
        $this->middleware('auth')->except(['index']);
        $this->describe = $describes;
        $this->comment = $comments;
        $this->like = $likes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();

        $paginate = Describe::orderby('created_at', 'desc')->paginate(10);
        // dd($describes);
        if (array_key_exists('searchword', $inputs)) {
            // dd($inputs);
            $describes = $this->describe->SearchingWord($inputs)->get();
        } else {
            $describes = $this->describe->orderby('created_at', 'desc')->get();
        }

        return view('user.describe.index',
                compact(
                    'inputs',
                    'describes',
                    'paginate'
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

        $client = new Client();
        $crawler = $client->request('GET', $inputs['url']);
        // dd($crawler);
        $contentList = $crawler->filter('meta')->each(function ($node) {
            if ($node->attr('property') === 'og:image') { //metaタグを取得して、og:imageがあれば返す
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

        $notImage = 'https://nenjudo.ocnk.net/data/nenjudo/product/20180622_9b559e.png';
        // dd($notImage);
        $this->describe->createImage($inputs, $notImage);
        return redirect()->route('describe.index');
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
        // dd($describe);
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
        $describes = $this->describe->find($id);
        // dd($describe);
        return view('user.describe.edit', compact('describes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Describe1Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        $this->describe->find($id)->fill($inputs)->save();
        return redirect()->route('describe.mypage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $this->describe->find($id)->delete();
        return redirect()->route('describe.mypage');
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
        $describes = $this->describe->orderBy('created_at', 'desc')->get();
        // dd($describes);

        return view('user.describe.mypage',
                compact(
                    'describes'
                ));
    }

    public function upload()
    {
        // Cloudder::upload('https://pbs.twimg.com/media/Dz_OgCHUYAAPWOf.jpg', '');
        // dd(Cloudder::getResult());
    }

    public function comment(CommentRequest $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        $this->comment->create($inputs);
        return redirect()->back();
    }

    public function deletecomment($id)
    {
        $this->comment->find($id)->delete();
        return redirect()->back();
    }

    public function like($id)
    {
        $describeId = $this->describe->find($id)->id; //Describeオブジェクトの中のIDだけを取得している
        // dd($describeId);
        $userId = Auth::id();

        $like = $this->like->userLike($userId, $describeId)->first(); //Likeモデルの中のUserIdとDescribeIdが一致するものをfiirstで１レコードのみ取得

        if ($like) { //likeテーブルにlikedataがあった場合
            $like->delete();
        } else {
            $this->like->create([ //そうでなかった場合に、describe_idとuser_idを作成し、保存
                'describe_id' => $describeId,
                'user_id' => $userId,
            ]);
        }

        return redirect()->back();
    }

    public function search()
    {
        // 検索するテキスト取得
        $search = Request::get('s');
        $query = Describe::query();
        // 検索するテキストが入力されている場合のみ
        if(!empty($search)) {
            $query->where('title', 'like', '%'.$search.'%');
        }
        $data = $query->get();
        return view('user.describe.index', compact('data', 'search'));
    }
}
