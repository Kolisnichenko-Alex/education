<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use Illuminate\Http\Request;
use App\Category;
use App\Article;
use App\User;
use App\MenuItem;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\SamplingHandler;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Session;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = MenuItem::all();

        return view('menu.index', [
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuItemRequest $request)
    {
        $validated = $request->validated();

        /** @var MenuItem $input */
        $input = MenuItem::create(array(
            MenuItem::FIELD_TITLE => $validated[MenuItem::FIELD_TITLE],
            MenuItem::FIELD_URL => $validated[MenuItem::FIELD_URL]
        ));

        $input->save();
        $request->session()->flash('success','Menu item successfully created');

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var MenuItem $item */
        $item = MenuItem::findOrFail($id);

        return view('menu.view', [
            'menuItem' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = MenuItem::findOrFail($id);

        return view('menu.edit', [
            'menuItem' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuItemRequest $request, $id)
    {
        $validated = $request->validated();

        /** @var MenuItem $input */
        $input = MenuItem::findOrFail($id);
        $input->title = $validated[MenuItem::FIELD_TITLE];
        $input->url = $validated[MenuItem::FIELD_URL];
        $input->save();

        $request->session()->flash('success', 'Menu item successfully updated');

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var MenuItem $item */
        $item = MenuItem::findOrFail($id);
        $item->delete();

        return redirect()->route('menu.index');
    }
}
