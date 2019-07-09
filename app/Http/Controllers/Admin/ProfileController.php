<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use Auth;

class ProfileController extends Controller
{
  public function add()
  {
      //既にプロフィール登録済みかを確認(同一ユーザーで複数個プロフィールが登録されることを防止する)
      $profile = Profile::where('user', Auth::user()->name)->first();
      
      //未登録の場合
      if (empty($profile)) {
        // createメソッドへ
        return view('admin.profile.create');
      }
      //登録済みの場合
      else{
        // editメソッドへ
        return view('admin.profile.edit', ['profile_form' => $profile]);
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
      $profile = Profile::where('user', Auth::user()->name)->first();
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
      $profile = Profile::where('user', $request->user)->first();
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
      
      return redirect('admin/profile/edit');
  }

}
