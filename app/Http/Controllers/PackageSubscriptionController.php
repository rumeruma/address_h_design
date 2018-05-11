<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Package;
use App\Subscription;
use Carbon\Carbon;
class PackageSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showPackage','ShowMemberOf']);
    }

    public function showPackage($slug)
    {
        $package = Package::whereName($slug)->get()->first();
        return view('single-package', compact('package'));
    }

    public function subscribeCreate($slug)
    {
        $package = Package::whereName($slug)->get()->first();
        return view('single-package-create', compact('package'));
    }

    public function subscribeStore(SubscriptionRequest $request)
    {
        $today = Carbon::now();

        $subscription = new Subscription();
        $subscription->user_id = auth()->user()->id;
        $subscription->package_id = decrypt($request->input('packageid'));
        $subscription->business = $request->input('business_name');
        $subscription->type = $request->input('business_type');
        $subscription->expiry = $today->addYears(1)->toDateString();;
        $subscription->paymentid = $request->input('bkash_token');
        $subscription->active = false;
        $subscription->save();

        return redirect(route('my-profile.index'));

    }

    public function ShowMemberOf($type){
        $featuredpackages = Package::getActive();
        $packagename = Package::byName($type);
        $subscriptions = $packagename->active_subscription()->paginate(12);

        return view('member-type.index', compact('packagename', 'subscriptions', 'featuredpackages'));
    }
}
