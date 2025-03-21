<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Property;
use App\Http\Requests\SearchPropertiesFormRequest;
use App\Http\Requests\PropertyContactRequest;
use App\Jobs\DemoJob;
use Illuminate\Support\Facades\Notification;
use App\Mail\PropertyContactMail;
use Illuminate\Support\Facades\Mail; 
use App\Models\User;
use App\Notifications\ContactRequestNotification;



class PropertysController extends Controller
{
   public function index(SearchPropertiesFormRequest $request){
        //   Commence par créer la requête de base
        $query = Property::query()->OrderBy('created_at','desc');

        //  Vérifie si le paramètre 'price' existe et l'applique à la requête
        if($request -> validated('price')){
            $query->where('price', '<=', $request->validated('price'));
        }
        //  Vérifie si le paramètre 'surface' existe et l'applique à la requête
        if($request -> validated('surface')){
            $query->where('surface', '>=', $request->validated('surface'));
        }
         //  Vérifie si le paramètre 'rooms' existe et l'applique à la requête
         if($request -> validated('rooms')){
            $query->where('rooms', '>=', $request->validated('rooms'));
        }
         //  Vérifie si le paramètre 'title' existe et l'applique à la requête
         if($request -> validated('title')){
            $query->where('title', 'like', "%{$request->validated('title')}%");
        }

        return view('property.index', [
          
            'properties' => $query->paginate(16),
            'input' => $request->validated()
          
        ]);

   }
   public function show(String $slug, Property $property){

        DemoJob::dispatch($property)->delay(now()->addSeconds(10));
        if($slug !== $property->getSlug()){
            return to_route('property.show',[
                'slug' => $property->getSlug(),
                'property' => $property
            ]);
        }
        return view('property.show', [
            'property' => $property
           
        ]);
   }
   public function contact(Property $property, PropertyContactRequest $request){

        // event(new ContactRequestEvent($property, $request->validated()));
        // Mail::send(new PropertyContactMail($property, $request->validated()));
        /** @var User $user */
        $user = User::first();
        $user -> notify(new ContactRequestNotification($property, $request->validated()));
        return back()->with('success', 'Votre demande de contact a bien été envoyé');
}

  
}
