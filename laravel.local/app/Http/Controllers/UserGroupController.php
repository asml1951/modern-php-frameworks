<?php
/**
 * Created by : alex
 * Date: 17.09.2019
 * Time: 14:55
 */

namespace App\Http\Controllers;

use App\Services\UsersManager;
use Illuminate\Database\Query\Builder;
use App\Models\Group;
use App\Models\MyUser;
use Illuminate\Http\Request;

/**
 * Class UserGroupController
 * @package App\Http\Controllers
 */
class UserGroupController extends Controller
{
    protected $usersManager;

    public function __construct(UsersManager $usersManager)
    {
        $this->usersManager = $usersManager;
    }

    public function addUserToGroup(Request $request)
    {
        $validBefore = $request->input('validBefore');
        $user = MyUser::find($request->input('uid'));
        $group = Group::find($request->input('gid'));
        if (isset($user, $group, $validBefore)) {
            $this->usersManager->addUserToGroup($user, $group, $validBefore);
            return response(
                'Пользователь ' . $user->name .
                       ' добавлен в группу ' . $group->name);
        } else {
            return response('Неправильно заданы get-параметры');
        }
    }

    public function deleteExpiredUsers()
    {
        $this->usersManager->deleteExpired();
        return response('Пользователи с истекшим сроком пребывания
         в группах  удалены');
    }
}
