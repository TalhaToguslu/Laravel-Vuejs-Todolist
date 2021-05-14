<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;

class ContentController extends Controller
{
    public function index(){//Bekleyen
      $array = Content::where("status",0)->orderBy("date","asc")->orderBy("hour","asc")->orderBy("minute","asc")->get();
      return response()->json($array);
    }

    public function complete(){//Tamamlanan
      $array = Content::where("status",1)->orderBy("date","asc")->orderBy("hour","asc")->orderBy("minute","asc")->get();
      return response()->json($array);
    }

    public function cancel(){//İptal Edilen
      $array = Content::where("status",2)->orderBy("date","asc")->orderBy("hour","asc")->orderBy("minute","asc")->get();
      return response()->json($array);
    }

    public function create(Request $request){
      try {

        $request->validate([
            'title' => 'required | unique:contents',
            'date' => 'required'
        ]);

        $new = new Content;
        $new->title = $request->title;
        $new->content = $request->content;
        $new->date = $request->date;
        $new->hour = $request->hour;
        $new->minute = $request->minute;
        $new->status = 0;
        $new->save();
        return response()->json("Başarılı");
      } catch (\Exception $e) {
        return response()->json($e->getMessage());
      }
    }

    public function completed(Request $request){
      try {
        $new = Content::findOrFail($request->id);
        $new->status = 1;
        $new->save();
        return response()->json("Başarılı");
      } catch (\Exception $e) {
        return response()->json($e->getMessage());
      }
    }

    public function canceled(Request $request){
      try {
        $new = Content::findOrFail($request->id);
        $new->status = 2;
        $new->save();
        return response()->json("Başarılı");
      } catch (\Exception $e) {
        return response()->json($e->getMessage());
      }
    }
}
