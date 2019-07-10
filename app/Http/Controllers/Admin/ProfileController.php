<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use Auth;
use App\Phistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
  public function add()
  {
      //既にプロフィール登録済みかを確認(同一ユーザーで複数個プロフィールが登録されることを防止する)
      $profile = Profile::where('email', Auth::user()->email)->first();
      
      //未登録の場合
      if (empty($profile)) {
        // createメソッドへ
        return view('admin.profile.create');
      }
      //登録済みの場合
      else{
        // editページへリダイレクト
        return redirect('admin/profile/edit');
      }
  }

  public function create(Request $request)
  {
      // バリデーションの実行
      $this->validate($request, Profile::$rules);
      
      $profile = new Profile;
      $form = $request->all();

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $profile->fill($form);
      $profile->save();
      
      return redirect('admin/profile/create');
  }

  public function edit()
  {
      //既にプロフィール登録済みかを確認
      $profile = Profile::where('email', Auth::user()->email)->first();
      // 該当なしデータの場合
      if (empty($profile)) {
        // HTTPエラー:404のページを表示
        abort(404);
      }
      return view('admin.profile.edit', ['profile_form' => $profile]);
  }

  public function update(Request $request)
  {
      // バリデーションの実行
      $this->validate($request, Profile::$rules);
      
      //既にプロフィール登録済みかを確認
      $profile = Profile::where('email', $request->email)->first();
      // 該当なしデータの場合
      if (empty($profile)) {
        // HTTPエラー:404のページを表示
        abort(404);
      }
      $form = $request->all();
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $profile->fill($form)->save();
      
      $history = new Phistory;
      $history->profile_id = $profile->id;
      $history->edited_at = Carbon::now();
      $history->save();
      
      return redirect('admin/profile/edit');
  }

}
