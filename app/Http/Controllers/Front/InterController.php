<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Item;
use App\Models\Movement;
use Illuminate\Http\Request;
use App\Services\MailGunService;

class InterController extends Controller
{

    public function __construct(
        MailGunService $mailgunService,
    ){
        $this->mailgunService = $mailgunService;
    }
    public function index(Request $request){
        $items = Item::all()->sortBy("name");

        return view('front.inter', compact('items'  ));
    }

    public function validate(Request $request){
        $validated = $request->validate([
            'comment' => 'nullable|string',
        ]);

        $firstname = $request->session()->get('firstname');

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
                            $admins = Admin::all();
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
                'firstname' => $firstname,
                'comment' => $validated['comment'],
            ]);

            $movement->items()->attach($movementsData);
        }

        return redirect()->route("front.return-inter.index")->withSuccess("Changement du stock pris en compte !");
    }
}
