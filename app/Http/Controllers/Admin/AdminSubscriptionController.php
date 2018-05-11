<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Helpers\Poster;
use Carbon\Carbon;

class AdminSubscriptionController extends Controller
{
    protected $type = 'c-profile';
    public function __construct()
    {
        $this->middleware('auth:admin');
//        $this->middleware('admin');

    }

    public function subscriptionInactive()
    {
        return view('admin.subscription.request');
    }
    public function subscriptionActive()
    {
        return view('admin.subscription.active');
    }

    public function activate(Request $request){
        $subscription = Subscription::find($request->input('subId'));

        $id = Poster::createPost(array(
            'userid' => auth()->user()->id,
            'title' => $subscription->business,
            'name' => str_slug($subscription->business),
            'content' => "",
            'excerpt' => "",
            'type' => $this->type,
            'status' => 'draft'
        ));
        $subscription->post_id = $id;
        $subscription->active = true;
        $subscription->save();
        return array('success'=>$subscription->business);
    }

    public function getAll($active)
    {
        $subscription = Subscription::getInfo($active)->orderBy('created_at', 'desc')->get();
        return DataTables::of($subscription)
            ->addIndexColumn()
            ->editColumn('expiry', function ($subscription) {
                return $subscription->expiry ? with(new Carbon($subscription->expiry))->format('d M Y') : '';
            })
//            ->filterColumn('expiry', function ($query, $keyword) {
//                $query->whereRaw("DATE_FORMAT(expiry,'%d %M %Y') like ?", ["%$keyword%"]);
//            })
            ->addColumn('operations','<button type="button" class="btn btn-xs btn-info {{ $active == true ? \'hide-btn\' : \'do-ss\' }}" data-id="{{ $id }}" ><i class="fa fa-pencil-square-o"></i></button>
                    <a class="btn btn-xs btn-danger" href="{{ route( \'package.destroy\', [$id]) }}"><i class="fa fa-trash-o"></i></a>')
            ->rawColumns(['operations'])
            ->make(true);
    }

}
