<?php

namespace Nepbaycloudservices\PackageBridge\Controllers;


use App\Http\Controllers\Controller;
use Nepbaycloudservices\PackageBridge\Mail\ActivationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Packagebridge;
use Carbon\Carbon;
use App\User;
use DB;


class ActivationController extends Controller
{   
    
    protected $table = 'user_activations';
    protected $resendAfter = 24;


    
    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }
    
    private function regenerateToken($user)
    {

        $token = $this->getToken();
        DB::table($this->table)->where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function createToken($user)
    {
        $token = $this->getToken();
        DB::table($this->table)->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon()
        ]);
        return $token;
    }

    public function getActivation($user)
    {
        return DB::table($this->table)->where('user_id', $user->id)->first();
    }

    public function getActivationByToken($token)
    {
        return DB::table($this->table)->where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        DB::table($this->table)->where('token', $token)->delete();
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->createActivation($user);

        $link = route('frontend.user.activate', $token);
        
        Mail::to($user)->send(new ActivationMail($link,$user));

    }


    public function activateUser($token)
    {
        $activation = $this->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->deleteActivation($token);

        return $user;

    }


    private function shouldSend($user)
    {
        $activation = $this->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}
