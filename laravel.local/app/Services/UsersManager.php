<?php
/**
 * Created by : alex
 * Date: 23.09.2019
 * Time: 19:45
 */

namespace App\Services;


use App\Models\Group;
use App\Models\MyUser;

class UsersManager
{
    /**
     * @param MyUser $user
     * @param Group $group
     * @param string $validBefore*
     */
    public function addUserToGroup(MyUser $user, Group $group, string $validBefore)
    {
        $group->users()->attach($user, ['added_to_group' => date('Y-m-d'),
                                           'valid_before'   => $validBefore]);

    }

    public function deleteExpired()
    {
        $users = MyUser::usersValidBefore()->get();
        foreach($users as $user) {
            foreach ($user->groups as $g) {
                $validBefore = $g->pivot->valid_before;
                if(strtotime($validBefore) < time()) {
                    $user->groups()->detach($g);
                }
            }
        }
    }

}
