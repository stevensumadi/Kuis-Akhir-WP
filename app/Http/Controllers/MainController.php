<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(){
        $user = Auth::user();
        $genderPartner = ($user->gender == '1') ? '2' : '1';
        $partner = User::where('datingCode', Auth::user()->datingCode)->where('gender', $genderPartner)->first();
        
        if($user->isBanned == '1'){
            return view('banpage');
        }

        if($partner != NULL && $user->isMet == '1'){
            $image = $partner->image;
            return view('index', [
                'venues' => Venue::all(),
                'image' => $image,
            ]);
        }

        if(Game::where('player_1', Auth::user()->id)->exists()){
            if(Game::where('player_1', Auth::user()->id)->where('player_2', null)->exists()){
                Game::where('player_1', Auth::user()->id)->where('player_2', null)->delete();
            }
        } else if(Game::where('player_2', Auth::user()->id)->exists()){
            DB::table('games')->where('player_2', Auth::user()->id)->update(['player_2' =>   null]);
        }

        if(Game::where('player_2', null)->whereNot('player_1', Auth::user()->id)->exists()){
            $game = Game::where('player_2', null)->whereNot('player_1', Auth::user()->id)->first();
            if($game->player1->gender != Auth::user()->gender){
                $game->player_2 = Auth::user()->id;
                $game->save();
                $roomID = $game->roomID;
                if((substr($game->player1->datingID, 0, strlen($game->player1->datingID) - 2) == substr($game->player2->datingID, 0, strlen($game->player2->datingID) - 2)) ){
                    $user = Auth::user();
                    $genderPartner = ($user->gender == '1') ? '2' : '1';
                    $partner = User::where('datingCode', Auth::user()->datingCode)->where('gender', $genderPartner)->first();
                    $image = $partner->image;
                    $user->isMet = 1;
                    $user->save();
                    $partner->isMet = 1;
                    $partner->save();
                    $game->delete();

                    return view('index', [
                        'venues' => Venue::all(),
                        'image' => $image,
                    ]);
                }
                return view('tictactoe', compact('roomID'));
            } else {
                $game = new Game();
                $game->player_1 = Auth::user()->id;
                $roomID = uniqid();
                $game->roomID = $roomID;
                $game->save();
                
                return view('tictactoe', compact('roomID'));
            }
        } else {
            $game = new Game();
            $game->player_1 = Auth::user()->id;
            $roomID = uniqid();
            $game->roomID = $roomID;
            $game->save();
            
            return view('tictactoe', compact('roomID'));
        }
    }

    public function admin(){
        return view('admin', [
            'users' => User::where('isAdmin', '0')->get(),
        ]);
    }

    public function banned($id)
    {
        $user = User::find($id);
        $user->isBanned = '1';
        $user->save();
        return redirect('/admin');
    }

    public function unbanned($id)
    {
        $user = User::find($id);
        $user->isBanned = '0';
        $user->save();
        return redirect('/admin');
    }
    
    public function filter(Request $request){
        $location = $request->id_loc;
        
        if($location == 0) {
            $venues = Venue::all();
        } else {
            $venues = Venue::where('location_id', $location)->get();
            $location = Location::where('id', $location)->first();
            $location = $location->name;
        }

        foreach($venues as $venue) {
            if($request->id_loc == 0) {
                $location = $venue->regency->name;
            }
            echo "
            <div class='card col-lg-12 mb-3'>
                <div class='row g-0'>
                    <div class='col-md-5'>
                        <img src='https://source.unsplash.com/450x250/?$location' class='img-fluid rounded-start'>
                    </div>
                    <div class='col-md-7 d-flex flex-column align-content-center'>
                        <div class='card-body ps-0 pb-0'>
                            <h5 class='card-title'>$venue->name</h5>
                            <p class='text-justify'>$venue->description</p>
                            <div class='d-flex flex-row align-items-center'>
                                <i class='bi bi-geo-alt-fill' style='color: cornflowerblue;'></i>
                                <p class='m-0 pt-1' style='padding-left: 1.5px'>Jl. $venue->location, $location</p>
                            </div>
                            <div class='d-flex align-items-center'>
                                <p class='fw-bold m-0 pe-1' style='color: cornflowerblue; font-size: 18px; padding-left: 1.5px'>$</p>
                                <p class='m-0' style='padding-left: 1px'>$venue->price</p>
                            </div>
                        </div>
                        <div class='card-footer d-flex justify-content-end border-0 bg-white'>
                            <a href='/book/$venue->id' role='button' class='fw-bold btn btn-primary'>Book Now</a>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }

    public function reconnect(){
        if(Game::where('player_1', Auth::user()->id)->exists()){
            if(Game::where('player_1', Auth::user()->id)->where('player_2', null)->exists()){
                Game::where('player_1', Auth::user()->id)->delete();
            }
            $game = Game::where('player_1', Auth::user()->id)->first();
            $game->player_1 = $game->player_2;
            $game->player_2 = null;
            $game->save();
        } else if(Game::where('player_2', Auth::user()->id)->exists()){
            DB::table('games')->where('player_2', Auth::user()->id)->update(['player_2' => null]);
        }
    }
}
