<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Group;
use App\Models\MyUser;
use App\Models\UserGroup;
use App\Services\HelloSeviceInterface;
use App\Services\UsersManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    protected $userManager;

    public function __construct(UsersManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function index(Request $request)
    {
      //  $ug = UserGroup::where('valid_before', '<', '2019-09-25')->delete();
        $users = MyUser::usersValidBefore()->get();
        foreach($users as $user) {
            foreach ($user->groups as $group) {
                $validBefore = $group->pivot->valid_before;
                if(strtotime($validBefore) < time()) {
                    $user->groups()->detach($group);
                }
            }
        }
        echo 'Deleted!';



     /*   $user = MyUser::find($request->input('uid'));
        $group = Group::find($request->input('gid'));
        $validBefore = $request->input('validBefore');
        $this->userManager->addUserToGroup($user, $group, $validBefore);
        echo 'Added to group' . $group->id;
        die();  */
      //  return view('test', ['name' => 'Ivan']);
    }

}
