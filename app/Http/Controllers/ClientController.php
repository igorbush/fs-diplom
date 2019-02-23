<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Seance;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function showMainClient() {
        $halls = Hall::all();
        $films = Film::all();
        $seances = Seance::all();
        return view('client', ['films'=> $films,'halls'=> $halls,'seances'=> $seances]);
    } 

    public function showHallClient(Request $request) {
        $seance = Seance::find($request->seance_id);
        $film = Film::find($seance->film_id);
        $hall = Hall::find($seance->hall_id);
        $hallMap = json_decode($hall->map, true);
        $tickets = Ticket::where('seance_id', $request->seance_id)->get();
        return view('hall', ['film'=> $film,'hall'=> $hall,'seance'=> $seance, 'map'=>$hallMap, 'tickets'=>$tickets]);
    }

    public function addTicket(Request $request) {
        $ticket = new Ticket;
        $ticket->seance_id = $request->seance_id;
        $ticket->reserved_map = $request->reserved_map;
        $ticket->total_price = $request->total_price;
        $ticket->save();
        return $ticket;
    }

    public function getReservedChars (Request $request) {
        return $tickets = Ticket::where('seance_id', $request->seance_id)->get();
    }

    public function showTicketClient (Request $request) {
        $ticket = Ticket::find($request->ticket_id);
        $seance = Seance::find($ticket->seance_id);
        $film = Film::find($seance->film_id);
        $hall = Hall::find($seance->hall_id);
        $map = json_decode($ticket->reserved_map, true);
        return view('payment', ['ticket'=> $ticket, 'seance'=>$seance,'film'=>$film, 'map'=>$map, 'hall'=>$hall]);
    }
    public function addQrCode (Request $request) {
        $base64_str = substr($request->src, strpos($request->src, ",")+1);
        $image = base64_decode($base64_str);
        $safeName = str_random(10).'.'.'png';
        Storage::disk('local')->put($safeName, $image);
        Ticket::where('id', $request->id)->update(['qr_code' => $safeName]);
        $response = array(
            'status' => 'success',
            'name' => $safeName
        );
        return $response;
    }
}
