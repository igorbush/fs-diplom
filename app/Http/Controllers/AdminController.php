<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Ticket;
class AdminController extends Controller
{

    public function getClient() {
        $client = DB::table('oauth_clients')->find(1);
        return view('welcome', ['client'=> $client]);
    }

    public function addHall(Request $request) {
        $hall = new Hall;
        $hall->name = $request->name;
        $hall->save();
        return $hall;
    }

    public function deleteHall(Request $request) {
        Hall::where('id', $request->id)->delete();
    }
    
    public function getHall(Request $request) {
        return Hall::find($request->id);
    }

    public function updateHall(Request $request) {
        Hall::where('id', $request->id)->update(['rows' => $request->rows, 'chairs' => $request->chairs, 'map'=> $request->map]);
    }

    public function updatePrices(Request $request) {
        Hall::where('id', $request->id)->update(['price' => $request->price, 'price_vip' => $request->vip]);
    }

    public function addFilm(Request $request) {
        $film = new Film;
        $film->title = $request->title;
        $film->duration = $request->duration;
        $film->poster = $request->poster;
        $film->description = $request->description;
        $film->country = $request->country;
        $film->save();
        return $film;
    }

    public function deleteFilm(Request $request) {
        Film::where('id', $request->id)->delete();
    }

    public function addSeance(Request $request) {
        $seance = new Seance;
        $seance->time = $request->time;
        $seance->film_id = $request->filmId;
        $seance->hall_id = $request->hallId;
        $seance->save();
        return $seance;
    }

    public function deleteSeance(Request $request) {
        Seance::where('id', $request->id)->delete();
    }

    public function getSeances() {
        return Seance::all();
    }

    public function showAdminPanel() {
        $halls = Hall::all();
        $films = Film::all();
        $seances = Seance::all();
        return view('admin', ['halls'=> $halls, 'films'=> $films]);
    }
    
    public function showReceptionPanel() {
        return view('reception');
    }
    public function findTicket(Request $request) {
        $ticket = Ticket::find($request->ticket_id);
        $seance = Seance::find($ticket->seance_id);
        $film = Film::find($seance->film_id);
        $hall = Hall::find($seance->hall_id);
        $result = ['map'=> $ticket->reserved_map, 'film'=> $film->title, 'hall'=> $hall->name];
        return $result;
    }
    
}
