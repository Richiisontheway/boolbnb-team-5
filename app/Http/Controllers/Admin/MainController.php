<?php

namespace App\Http\Controllers\Admin;

// Models
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsor;

// Helpers
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MainController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();

        $userApartments = Apartment::where('user_id', auth()->id())->get();
        $totalUserApartments = $userApartments->count();
        $user = auth()->user();

        // Controllo quante volte sono state visualizzati in totale gli appartamenti
        $userViews = DB::table('views')
                        ->join('apartments', 'views.apartment_id', '=', 'apartments.id')
                        ->where('apartments.user_id', auth()->id())
                        ->count();
        // Controllo quali sono gli appartamenti con più visualizzazioni
        $userTopApartments = DB::table('apartments')
                                        ->join('views', 'apartments.id', '=', 'views.apartment_id')
                                        ->where('apartments.user_id', auth()->id())
                                        ->select('apartments.*', DB::raw('COUNT(views.id) as views_count'))
                                        ->groupBy('apartments.id')
                                        ->orderByDesc('views_count')
                                        ->take(3)
                                        ->get();
        // Controllo quanti messaggi sono stati mandati in totale
        $userMessages = DB::table('contacts')
                        ->join('apartments', 'contacts.apartment_id', '=', 'apartments.id')
                        ->where('apartments.user_id', auth()->id())
                        ->count();
        // Controllo quali sono gli appartamenti con più messaggi   
        $userApartmentsWithMostMessages = DB::table('apartments')
                                            ->join('contacts', 'apartments.id', '=', 'contacts.apartment_id')
                                            ->where('apartments.user_id', auth()->id())
                                            ->select('apartments.*', DB::raw('COUNT(contacts.id) as messages_count'))
                                            ->groupBy('apartments.id')
                                            ->orderByDesc('messages_count')
                                            ->take(3)
                                            ->get();

        $apartments = Apartment::where('user_id', $user->id)->get();
        
        return view('admin.dashboard', compact('user','totalUserApartments', 'userApartments', 'userViews', 'userTopApartments', 'userMessages', 'userApartmentsWithMostMessages'));
    }
    
    public function trash()
    {
        $apartment = Apartment::onlyTrashed()->get();
        return view('admin.trash', compact('apartment'));
    }
    

}
