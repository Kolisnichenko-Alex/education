<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Http\Request;
use App\Category;
use App\Article;
use App\User;
use App\SavedPage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\SamplingHandler;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = SavedPage::all();

        return view('pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $validated = $request->validated();

        /** @var SavedPage $input */
        $input = SavedPage::create(array(
            SavedPage::FIELD_TITLE => $validated[SavedPage::FIELD_TITLE],
            SavedPage::FIELD_HTML => $validated[SavedPage::FIELD_HTML],
        ));

        $input->save();

        $request->session()->flash('success', 'Page successfully created');

        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var SavedPage $page */
        $page = SavedPage::findOrFail($id);

        return view('pages.view', [
            'page' => $page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = SavedPage::findOrFail($id);

        return view('pages.edit', [
            'page' => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, $id)
    {
        $validated = $request->validated();

        /** @var SavedPage $input */
        $input = SavedPage::findOrFail($id);
        $input->title = $validated[SavedPage::FIELD_TITLE];
        $input->html = $validated[SavedPage::FIELD_HTML];

        $input->save();

        $request->session()->flash('success', 'Page successfully updated');
        return redirect()->route('pages.index');
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
        /** @var SavedPage $page */
        $page = SavedPage::findOrFail($id);
        $page->delete();

        return redirect()->route('pages.index');
    }
}
