<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\PropertyFormRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;






class PropertyController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    
    //     $this->authorizeResource(Property::class, 'property');
    //  }
     public function index()
    {
        return view('admin.properties.index',[
            'properties' => Property::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();
        $property-> fill([
            'surface' => 40,
            'bedrooms' => 1,
            'rooms' => 2,
            'floor' => 0,
            'city' => 'Montpellier',
            'postal_code' => 34000,
            'sold' => false,
        ]);
        return view('admin.properties.form', [
            'property' => $property,
             'options' => Option::pluck('name','id')

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = new Property();
       $property = Property::create($this->extracData($property, $request));
       $property->options()->sync($request->validated('options'));
       return to_route('admin.property.index')->with('success', 'le bien a été bien créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, Property $property)
    {
       
    }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name','id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        
        
        $property->update($this->extracData($property, $request));
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'le bien a été bien modifié');
    }
    public function extracData(Property $property , PropertyFormRequest $request): array {
        $data = $request->validated();
        /**  @var UploadedFile|null $image */
        $image = $request->validated('image');
        if($image === null || $image->getError()){
            return $data;
        }
        if($property->image){
            Storage::disk('public')->delete($property->image);
        }
        $data['image'] = $image->store('blog','public');
            return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return back()->with('success', 'le bien a été bien supprimé');
    }
}
