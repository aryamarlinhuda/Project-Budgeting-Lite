<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function home() {
        $id = session('user');
        $data = User::find($id);

        $number = number_format($data->balance);
        $data->value = str_replace(',', '.', $number);
        return view('home')->with('data',$data);
    }
    
    public function transaction() {
        return view('transaction');
    }

    public function transaction_process(Request $request) {
        $id = session('user');
        $user = User::find($id);

        $request->validate([
            "value" => "required | numeric",
            "flow" => "required",
        ],[
            "value.required" => "Value is required!",
            "value.numeric" => "Value must be a number!",
            "flow.required" => "Flow is required!",
        ]);

        if($request->input('flow') === "income") {
            $user->balance = $user->balance + $request->input('value');
            $user->save();

            Transaction::create([
                "value" => $request->input('value'),
                "flow" => $request->input('flow'),
                "note" => $request->input('note'),
                "created_by" => $id
            ]);

            return redirect('home')->with('success','Transaction Successfully!');
        } else {
            $user->balance = $user->balance - $request->input('value');
            $user->save();

            Transaction::create([
                "value" => $request->input('value'),
                "flow" => $request->input('flow'),
                "note" => $request->input('note'),
                "created_by" => $id
            ]);

            $request->session()->flash('balance',$user->balance);
            return redirect('home')->with('success','Transaction Successfully!');
        }
    }

    public function history() {
        $id = session('user');
        $data = Transaction::where('created_by',$id)->orderBy('created_at', 'DESC')->paginate(10);
        foreach ($data as $x => $item) {
            $number = number_format($item->value);
            $data[$x]->balance = str_replace(',', '.', $number);
        }

        return view('history')->with('data',$data);
    }
}
