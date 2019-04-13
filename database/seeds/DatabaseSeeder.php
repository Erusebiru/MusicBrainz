<?php

use Illuminate\Database\Seeder;
use App\Artista;
use App\Cancion;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //SONGS
        $url = "http://musicbrainz.org/ws/2/recording?query=Ice%20Queen";
        $c = curl_init( $url );

        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Accept:application/json','User-Agent:Laravel/5.7'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($c);

        $dades = json_decode($res,true);
        
        foreach($dades['recordings'] as $key => $value){
            $title = $value['title'];
            $artist = $value['artist-credit'][0]['artist']['name'];
            $release = $value['releases'][0]['title'];

            if(isset($value['releases'][0]['date'])){
                $year = $value['releases'][0]['date'];
            }else{
                $year = null;
            }

            $record = new Cancion;
            $record->Nombre = $title;
            $record->Artista = $artist;
            $record->Disco = $release;
            $record->Lanzamiento = $year;
            $record->save();
            
        }

        //ARTISTS
        $url = "http://musicbrainz.org/ws/2/artist?query=Whitin%20Temptation" ;
        $c = curl_init( $url );

        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Accept:application/json','User-Agent:Laravel/5.7'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($c);
        $dades = json_decode($res,true);
        
        foreach($dades as $key => $value){
            if(is_array($value)){
                foreach($value as $keys => $item){
                    $name = $item["name"];
                    if(isset($item["area"])){
                        $country = $item["area"]["name"];
                    }else{
                        $country = null;
                    }
                    if(isset($item["type"])){
                        $type = $item["type"];
                    }else{
                        $type = null;
                    }
                    
                    $artista = new Artista;
                    $artista->Nombre = $name;
                    $artista->Country = $country;
                    $artista->Type = $type;
                    $artista->save();
                }
            }
        }
    }
}
