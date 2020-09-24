<?php

namespace App\Http\Controllers;

use App\Account;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    /**
     * We consider fixed amount for transaction fee
     *
     * @var $bank_fees
     */
    protected $bank_fee = 0;

    /**
     * Display Account info
     * Note: We don't put ID directly into raw database query! :D
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // If we have a cache system, we find item by CacheController and if not exist, abort(404)

        // Then we have to Authorize the user, account info are private and they should not be allowed to be
        // seen by everybody, so we use Laravel Policies but here we skip it as we have no authentication.

        $item = Account::find($id);

        $response = [
            'status' => !$item ? false:true,
            'model' => !$item ? null:$item->load('user'),
        ];
        return response()->json($response, 200);
    }

    /**
     * Show transactions
     * Note: We don't put ID directly into raw database query! :D
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function showTransactions($id)
    {
        // First authorization (but we don't have)

        // We dont need to check $id here because if its a fake number, no transactions will be retrieved
        $transactions = Transaction::where('from_id', $id)->orWhere('to_id', $id)->get();

        $response = [
            'status' => true,
            'model' => $transactions->load('from.user', 'to.user'),
        ];
        return response()->json($response, 200);
    }

    /**
     * Create transaction
     * Note: We don't put ID directly into raw database query! :D
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createTransactions(Request $request, $id)
    {
        // First authorization (but we don't have)

        // Validation of user data
        $rules = [
            'to_id'                => 'required|integer|min:0',
            'amount'               => 'required|numeric|min:0.01',
            'details'              => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'errors' => $validator->errors()->all(),
            ];
            return response()->json($response, 200);
        }

        // People can't have transaction to themselves (by editing front-end code)
        if($request->to_id == $id){
            $response = [
                'status' => false,
                'errors' => [__('validation.selfTransaction')],
            ];
            return response()->json($response, 200);
        }

        // From Account
        $from_account = Account::findOrFail($id);

        // Checking balance | Bank doesn't allow less than zero for balance number.
        if($from_account->balance < ($request->amount + $this->bank_fee)){
            $response = [
                'status' => false,
                'errors' => [__('validation.notEnoughBalance')],
            ];
            return response()->json($response, 200);
        }

        // Checking destination account
        $to_account = Account::find($request->to_id);
        if(!$to_account){
            $response = [
                'status' => false,
                'errors' => [__('validation.destAccountNotFound')],
            ];
            return response()->json($response, 200);
        }

        // Process
        $from_account->balance = $from_account->balance - ($request->amount + $this->bank_fee);
        $from_account->save();
        $to_account->balance = $to_account->balance + $request->amount;
        $to_account->save();
            // App\Observers\AccountObserver will handle post {action} tasks

        // Inserting transaction
        $transaction = new Transaction;
        $transaction->from_id = $from_account->id;
        $transaction->to_id = $to_account->id;
        $transaction->amount = $request->amount;
        $transaction->details = $request->details;
        $transaction->save();
            // App\Observers\TransactionObserver will handle post {action} tasks

        // Now we can send Notifications

        // At last...
        $response = [
            'status' => true,
            'model' => $transaction->load('from.user', 'to.user'),
            'new_balance' => $from_account->balance,
        ];
        return response()->json($response, 200);
    }
}
