<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Monolog\Handler\SamplingHandler;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create(array(
            User::FIELD_NAME => $validated[User::FIELD_NAME],
            User::FIELD_EMAIL => $validated[User::FIELD_EMAIL],
            User::FIELD_ACCOUNT_TYPE => $validated[User::FIELD_ACCOUNT_TYPE],
            User::FIELD_PASSWORD => bcrypt($validated[User::FIELD_PASSWORD])
        ));
        $user->save();

        $request->session()->flash('success', 'User successfully created');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $articles = Article::where(Article::FIELD_USER_ID, $user->id)->count();

        return view('users.view', [
            'user' => $user,
            'articles' => $articles
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
        $user = User::findOrFail($id);

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::findOrFail($id);
        $user->email = $validated[User::FIELD_EMAIL];
        $user->name = $validated[User::FIELD_NAME];
        $user->account_type = $validated[User::FIELD_ACCOUNT_TYPE];

        $user->save();

        $request->session()->flash('success', 'User successfully updated');

        return redirect()->route('users.index');
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
        /** @var User $user */
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index');
    }

    /**
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function banUnban(Request $request, $id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        if ($user->baned_at) {
            $user->baned_at = null;
            $user->save();
            $request->session()->flash('success', 'User successfully unbanned');

            return redirect()->route('users.index', $request->query());
        }

        $user->baned_at = Carbon::now();
        $user->save();
        $request->session()->flash('success', 'User successfully banned');

        return redirect()->route('users.index', $request->query());
    }
}
