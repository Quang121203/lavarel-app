<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getList()
    {
        $songs = Song::orderBy("name", "asc")
            ->get(['id', 'name', 'singer', 'image', 'music']);
        return $songs;
    }

    public function index()
    {
        return view("home");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $aInput = $request->all();
        $id = $aInput['id'] ?? 0;
        $song = $id == 0 ? new Song() : Song::find($id);
        if (($request->hasFile('image') && $request->hasFile('music'))) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $music = $request->file('music');
            $musicName = $music->getClientOriginalName();
            $image->storeAs('/public/image', $imageName);
            $music->storeAs('/public/music', $musicName);
            $song->music = $musicName;
            $song->image = $imageName;
        } else if ($id == 0) {
            return "Thiếu dữ liệu";
        }


        $song->fill($aInput);
        $song->save();
        return "Thêm thành công";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $song = Song::find($id);
        return $song;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $song = Song::find($id);
        if (isset($song)) {
            $song->delete();
            if (Storage::exists("public/image/" . $song->image)) {
                Storage::delete("public/image/" . $song->image);
            }
            if (Storage::exists("public/music/" . $song->music)) {
                Storage::delete("public/music/" . $song->music);
            }
            return "Xóa nhạc thành công";
        } else {
            return "Đơn vị không tồn tại";
        }

    }
}
