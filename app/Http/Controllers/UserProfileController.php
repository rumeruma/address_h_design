<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\UserProfile;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Imagix;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
  

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
//        dd(Auth::guard());

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profile = $this->checkInit();
        $subscriptions = new Subscription();
        $packages = $subscriptions->getMyPacks(auth()->user()->id);
        return view('user-profile/showSaveImage', compact('profile', 'packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userProfile)
    {
        $userPro = UserProfile::find($userProfile);
        $userPro->first_name = $request->input('first_name');
        $userPro->last_name = $request->input('last_name');
        $userPro->organization = $request->input('organization');
        $userPro->designation = $request->input('designation');
        $userPro->cell_numbers = $request->input('cell_numbers');
        $userPro->links = $request->input('links');
        $userPro->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }

    public function avatar(Request $request, UserProfile $userProfile)
    {
          $user_id = auth()->user()->id;
          $user_id_en = base64_encode($user_id);
          $filename_path = 'storage/avatar_'.$user_id_en.'.jpg';
          $img = Imagix::make($request->media);
          $img->save($filename_path);
          $userProfile->where('user_id', auth()->user()->id)->update(['avatar' => $filename_path]);

//        if($mediarequest->hasFile('media')){
//                $filename = $mediarequest->media->getClientOriginalName();
//                $mediarequest->media->StoreAs('public', $filename);
//                $userProfile->where('user_id', auth()->user()->id)->update(['avatar' => 'storage/'.$filename]);
//                return 'true';
//            }
//        return 'done';

    }

    private function checkInit(){
        $user_id = auth()->user()->id;
        $profile = UserProfile::where('user_id', $user_id)->exists();
        if(!$profile){
            $userPro = new UserProfile();
            $userPro->user_id = $user_id;
            $userPro->first_name = "FirstName";
            $userPro->last_name = "LastName";
            $userPro->organization = "Organization";
            $userPro->designation = "Designation";
            $userPro->cell_numbers = array(array('type'=>'office', 'number'=>'01234567890'), array('type'=>'other', 'number'=>'01234567890'));
            $userPro->links = array(array('type'=>'facebook', 'url'=>'http://facebook.com'));
            $userPro->avatar = "images/user-profile.png";
            $userPro->save();
        }

       return $userData = UserProfile::where('user_id', $user_id)->first();
    }

}
