<?php

namespace App\Http\Controllers\Site\Front;

use App\Http\Controllers\Site\Controller;
use App\Models\Containing;
use App\Models\Firestation;
use App\Models\Item;
use App\Models\Movement;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\MailGunService;
use Inertia\Inertia;

class VerifController extends Controller
{
    public function __construct(
        MailGunService $mailgunService,
    ){
        $this->mailgunService = $mailgunService;
    }
    
    public function index(Request $request){

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        // dd($request->sucess);
        if($request->success){
            dd("pAse");
        }

        $sources = Source::where("firestation_id", $user->firestation_id)->where("firestation_id", $user->firestation_id)->get();

        return Inertia::render('Front/verif/Index', [
            'sources' => $sources,
        ]);

    }

    public function show(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();


        $contenants = Containing::where('source_id', $id)->where("firestation_id",$user->firestation_id)->with('items')->get();

        $source = Source::where("firestation_id", $user->firestation_id)->where("id", $id)->first();

        return Inertia::render('Front/verif/Show', [
            'contenants' => $contenants,
            'source' => $source
        ]);
    }

    public function updateQty(Request $request, $id){
        $validated = $request->validate([
            'qty' => 'required|integer',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $movementsData = [];

        $item = Item::where("id",$id)->where("firestation_id",$user->firestation_id)->first();

        $movementsData[$item->id] = ['operation' => $validated['qty']];


        $total_qty = $item->total_qty + $validated['qty'];

        // On check si la quantité total est inférieur au seuil
        if($total_qty <= $item->seuil){
            // On envoi un mail
            //On récupère l'adresse mail des admins
            $admins = User::where('isAdmin', 1)->where('firestation_id', $caserne->id)->get();
            $emails = [];

            // On génère le message
            $object = $item->name." en rupture !";
            $message = "Bonjour,<br><br>";
            $message .= "Nous vous informons que le produit <strong>" . $item->name . "</strong> est en rupture de stock ou sur le point de l'être.<br>";
            $message .= "<strong>Quantité actuelle :</strong> " . $item->total_qty . "<br>";
            $message .= "<strong>Seuil critique :</strong> " . $item->seuil . "<br><br>";
            $message .= "Bonne journée";

            foreach($admins as $admin){
                $emails[] = $admin->email;
                $to = $admin->firstname." ".$admin->lastname." <".$admin->email.">";
                $result = $this->mailgunService->send($admin->email, $object,$message);
            }
        }

        // Logique pour mettre à jour la quantité
        $item->update(['total_qty' => $total_qty]);

        if(!empty($movementsData)){
            $movement = Movement::create([
                'user_id' => $user->id,
                'comment' => null,
            ]);

            $movement->items()->attach($movementsData);
        }

        return response()->json([
            'message' => 'Quantité mise à jour avec succès !',
            'new_qty' => $validated['qty'],
        ]);
    }

    public function validate(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $source = Source::where('firestation_id',$caserne->id)->where("id",$id)->first();
        $sourceName = $source->name;
        $message =  "$sourceName vérifié(e) !";
        return redirect()->route('front.verif.index')->withSuccess($message);
    }
}
