<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller
{
    //menampilkan data keseluruhan
    public function index()
    {
        $book = Book::all(); //untuk melihat semua data yang ada di dalam tabel
        return response()->json(['book' => $book], 200);
        //json adalah format untuk menyimpan dan mentranfer data
    }
   
    //menampilkan data berdasarkan id
    public function show($id)
    {
        //untuk melihat semua data berdasarkan id yang ada di dalam tabel
        $book = Book::find($id); 
        if($book){
            return response()->json(['book' => $book], 200);
        }else{
            return response()->json(['error' => 'Data Not Found'], 404);
        }
      
        //json adalah format untuk menyimpan dan mentranfer data
    }
    public function add(Request $request)
    {
        //untuk menvalidasi data
        $request->validate([
            'nama' => 'required|max:100',
            'jenis_buku' => 'required|max:100',
            'deskripsi' => 'required|max:100',
            'penerbit' => 'required|max:100',
        ]);
        $book = new Book; //hubungkan ke model
        //diisi sesuai dengan nama yng ada di database = diisi sesuai validation data diatas
        $book->nama = $request->nama;
        $book->jenis_buku = $request->jenis_buku;
        $book->deskripsi = $request->deskripsi;
        $book->penerbit = $request->penerbit;
        $book->save();
        return response()->json(['message' => 'Data Added Successfuly'], 200);
    }
    public function update(Request $request ,$id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jenis_buku' => 'required|max:100',
            'deskripsi' => 'required|max:100',
            'penerbit' => 'required|max:100',
        ]);
        $book = Book::find($id); 
        if($book)
        {
            $book->nama = $request->nama;
            $book->jenis_buku = $request->jenis_buku;
            $book->deskripsi = $request->deskripsi;
            $book->penerbit = $request->penerbit;
            $book->update();
            return response()->json(['message' => 'Data Updated Successfuly'], 200);
        }else
        {
            return response()->json(['error' => 'Data Not Found'], 404);
        }
   
    }
    public function delete($id)
    {
        $book = Book::find($id);
        if($book)
        {
            return response()->json(['message' => 'Data Deleted Successfuly'], 200);
        }else
        {
            return response()->json(['error' => 'Data Not Found'], 404);
        }
    }
}
