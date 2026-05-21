<?php

namespace App\Http\Controllers\Site\Front;

use App\Http\Controllers\Site\Controller;
use App\Models\Firestation;
use App\Models\Item;
use App\Models\Movement;
use App\Models\User;
use App\Services\MailGunService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InterController extends Controller
{

    public function __construct(
        MailGunService $mailgunService,
    ){
        $this->mailgunService = $mailgunService;
    }
    public function index(Request $request){
        // On récupère l'utiliseur

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $items = Item::where('firestation_id', $user->firestation_id)->get()->sortBy("name")->values();

        return Inertia::render('Front/ReturnInter', [
            'items' => $items,
        ]);
    }

    public function validate(Request $request){
        $validated = $request->validate([
            'comment' => 'nullable|string',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $movementsData = [];
        foreach($request->all() as $key => $value){
            if(str_starts_with($key, 'id')){
                $id = substr($key, 2);
                $qty = intval($value);

                if($qty != 0){
                    $item = Item::find($id);
                    if ($item) {
                        $item->update([
                            "total_qty" => $item->total_qty + $qty,
                        ]);

                        // On check si la quantité total est inférieur au seuil
                        if($item->total_qty <= $item->seuil){
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

                        $movementsData[$item->id] = ['operation' => $qty];
                    }
                }
            }
        }

        if(!empty($movementsData)){
            $movement = Movement::create([
                'user_id' => $user->id,
                'comment' => $validated['comment'],
            ]);

            $movement->items()->attach($movementsData);
        }

        return redirect()->route("front.return-inter.index")->withSuccess("Changement du stock pris en compte !");
    }
}
