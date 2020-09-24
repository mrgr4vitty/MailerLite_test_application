<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Dashboard: This method returns first and only View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        // I have ignored Authorization

        $accounts = Account::with('user')->get();
        $list = [];
        foreach($accounts as $account){
            array_push($list,
            [
                'value' => $account->id,
                'text' => $account->user->name .' Account',
            ]);
        }
        return view('app')->with(['accounts' => $list]);
    }

    /**
     * Login user and return a token
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Codes here
    }

    /**
     * Get user info for users who are loggedIn and refresh the page
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function userInfo(Request $request)
    {
        // Codes here
    }

    /**
     * Logout User
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Codes here
    }

    /**
     * Refresh JWT token
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        // Codes here
    }
}
