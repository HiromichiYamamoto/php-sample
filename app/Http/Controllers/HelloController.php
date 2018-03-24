<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

use App\Http\Requests\HelloRequest;

use Illuminate\Support\Facades\DB;

use Validator;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Person;

global $head, $style, $body, $end;
$head = '<html><head>';
$style = <<<EOF
<style>
body { font-size:16pt; color:#999; }
ht { font-size:100pt; text-align:right; color:#eee;
  margin:-40px 0px -50px 0px; }
</style>
EOF;
$body = '</head><body>';
$end = '</body></head>';

function tag($tag, $txt) {
  return "<{$tag}>" . $txt . "</{$tag}>";
}

class HelloController extends Controller
{
  public function index(Request $request) {

    if ($request->hasCookie('msg')) {
      $msg = 'Cookie: ' . $request->cookie('msg');
    } else {
      $msg = 'no';
    }
    return view('hello.index', ['msg'=>$msg]);
  }

  public function post(Request $request)
  {
    $validate_rule = [
      'msg' => 'required',
    ];
    $this->validate($request, $validate_rule);
    $msg = $request->msg;
    $response = new Response(view('hello.index', ['msg'=>'{' . $msg . '}をクッキーに保存しました。']));
    $response->cookie('msg', $msg, 100);
    return $response;
  }

  // public function other() {
  //   global $head, $style, $body, $end;

  //   $html = $head . tag('title','Hello/other') . $style . $body
  //                 . tag('h1', 'Other') . tag('p','this is Other page')
  //                 . $end;
  //               return $html;
  // }
}
