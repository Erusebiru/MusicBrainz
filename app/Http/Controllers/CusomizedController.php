<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artista;
use App\Cancion;

class CusomizedController extends Controller
{
    public function index(){
        return view('search');
    }

    public function showArtists(){
        $dades = Artista::all();
        $title = "Artistas";
        return view('show',compact('dades','title'));
    }

    public function showSongs(){
        $dades = Cancion::all();
        $title = "Canciones";
        return view('show',compact('dades','title'));
    }

    public function search(Request $request){
        $url = "http://musicbrainz.org/ws/2/artist?query=" . $request->searched;
        $c = curl_init( $url );

        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Accept:application/json','User-Agent:Laravel/5.7'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($c);

        $dades = json_decode($res,true);
        $dades = $dades['artists'];
        $title = "Búsqueda de artistas";
        
        return view('show',compact('dades','title'));
    }
}
