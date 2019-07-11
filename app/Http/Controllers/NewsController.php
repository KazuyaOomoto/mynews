<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\News;
use App\Profile;
use Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        // $cond_title が空白でない場合は、記事を検索して取得する
        if ($cond_title != '') {
            $posts = News::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
        } else {
            /* 「投稿日時順に新しい方から並べる」 */
            $posts = News::all()->sortByDesc('updated_at');
        }
        
        if (count($posts) > 0) {
            $headline = $posts->shift();
            /*
                shift()メソッドは、配列の最初のデータを削除し、その値を返すメソッド。
                配列を左にシフトする動作をするので、shiftメソッドと呼ばれている。
                一番最新の記事を変数$headlineに代入し、
                $postsは代入された最新の記事以外の記事が格納されている。
                なんでわざわざこんなことをしているのかというと、最新の記事とそれ以外の記事とで表記を変えたいために行なっている。
            */
        } else {
            $headline = null;
        }
        
        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、posts、cond_titleという変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function profile()
    {
      //既にプロフィール登録済みかを確認
      $profile = Profile::where('email', Auth::user()->email)->first();
      // 該当なしデータの場合
      if (empty($profile)) {
        // HTTPエラー:404のページを表示
        abort(404);
      }
      return view('news.profile', ['profile_form' => $profile]);        
    }
}
