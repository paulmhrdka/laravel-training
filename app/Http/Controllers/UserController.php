<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function show()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(15);

        return view('welcome', [
            'data' => $users,
            'title' => 'Home',
            'active' => 'Home'
        ]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // $file = ;
        Excel::import(new UsersImport, $request->file('file')->store('dataexcel'));
        return back()->with('success', 'Berhasil Import Data');
    }
}
